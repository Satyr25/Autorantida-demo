<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use app\components\CarritoComponent;
use frontend\models\Documentos;
use frontend\models\DocumentosForm;
use frontend\models\PedidosSoluciones;
use frontend\models\Pedidos;
use frontend\models\PedidosSearch;
use kartik\mpdf\Pdf;

class CheckoutController extends Controller
{
    public function actionIndex(){
        $pedido = new Pedidos();

        if ($pedido->load(Yii::$app->request->post()) && $pedido->save()) {
            return $this->redirect(['confirmacion', 'id' => $pedido->id]);
        }
        $productos = Yii::$app->Carrito->getProductosCarrito();
        if (!$productos){
            Yii::$app->session->setFlash('error', 'Debe agregar productos al carrito');
            return $this->redirect(['soluciones/index']);
        }
        $numero_soluciones = Yii::$app->Carrito->contarSoluciones();
        return $this->render('index', [
            'pedido' => $pedido,
            'productos' => $productos,
            'numero_soluciones' => $numero_soluciones,
        ]);
    }
    
    public function actionCorreos($clave){ 
        return true;
    }
    
    public function actionConfirmacion(){
        $clave = Yii::$app->request->get();
    
        $pedido = Pedidos::find()->where(['clave' => $clave])->one();
        $productos = PedidosSoluciones::find()->where(['pedidos_id' => $pedido->id])->all();
        $documentos = Documentos::find()->where(['pedidos_id' => $pedido->id])->all();
        
        $documentosForm = new DocumentosForm();
        
        if(Yii::$app->request->post() && $documentosForm->guardar($pedido->id)){
            Yii::$app->session->setFlash('success', 'Se agregaron los archivos correctamente');
            $this->refresh();
        } 
        
        return $this->render('confirmacion', [
            'pedido' => $pedido,
            'documentos' => $documentos,
            'documentosForm' => $documentosForm,
        ]);
    }
    
    public function actionBorrarSolucion(){
        if (Yii::$app->request->post()){
            $clave = Yii::$app->request->post();
            if (Yii::$app->Carrito->borrarSolucion($clave['clave'])){
                return true;
            }
        } 
        return false;
    }
    public function actionBorrarDocumento(){
        if (Yii::$app->request->post()){
            $documento = Documentos::find()->where(['id' => Yii::$app->request->post('doc')])->one();
            if($documento->delete()){
                return true;
            }
        } 
        return false;
    }
    
    public function actionRealizarPago(){
        
        $respuesta = Yii::$app->Carrito->realizarPago(Yii::$app->request->post());
        if ($respuesta['exito'] == 0){
            return json_encode($respuesta);
        };
        $clave = $respuesta['clave'];
               
        $pedido = Pedidos::find()->where(['clave' => $clave])->one();
        $productos = PedidosSoluciones::find()->where(['pedidos_id' => $pedido->id])->all();
        
        Yii::$app->mailer->compose()
            ->setTo($pedido->clientes->correo)
            ->setFrom([Yii::$app->params['adminEmail']=>"Autorantida"])
            ->setSubject("Detalles de la compra")
            ->setHtmlBody(
                $this->renderPartial('_correo_cliente',[
                    'pedido' => $pedido,
                    'productos' => $productos,
                ])
            )
            ->send();
        Yii::$app->mailer->compose()
            ->setTo(Yii::$app->params['adminEmail'])
            ->setFrom([Yii::$app->params['adminEmail']=>"Autorantida"])
            ->setSubject("Detalles de la compra")
            ->setHtmlBody(
                $this->renderPartial('_correo_autorantida',[
                    'pedido' => $pedido,
                    'productos' => $productos,
                ])
            )
            ->send();
        return json_encode($respuesta);
    }
    
    public function actionPrueba(){
        $clave = Yii::$app->request->get();
        $pedido = Pedidos::find()->where(['clave' => $clave])->one();
        $productos = PedidosSoluciones::find()->where(['pedidos_id' => $pedido->id])->all();
        
        return $this->renderPartial('prueba', [
            'pedido' => $pedido,
            'productos' => $productos,
        ]);
    }
    
    public function actionOxxo() {
        $clave = Yii::$app->request->get();
        $pedido = Pedidos::find()->where(['clave' => $clave])->one();
        $productos = PedidosSoluciones::find()->where(['pedidos_id' => $pedido->id])->all();
        $content = $this->renderPartial('_correo_ficha',[
            'pedido' => $pedido,
        ]);
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@frontend/web/css/ficha-oxxo.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => 'Krajee Report Title'],
            'methods' => [
                'SetHeader'=>0,
                'SetFooter'=>0,
            ]
        ]);
        return $pdf->render();
    }
}
