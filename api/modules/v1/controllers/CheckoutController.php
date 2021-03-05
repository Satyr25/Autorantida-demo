<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\base\Exception;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

use api\modules\v1\models\Pedidos;
use api\modules\v1\models\PedidosSoluciones;

class CheckoutController extends ActiveController
{
    public $modelClass = '';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'except' => ['conekta'],
            'authMethods' => [
                // HttpBasicAuth::className(),
                // HttpBearerAuth::className(),
                // QueryParamAuth::className(),
            ],
        ];
        return $behaviors;
    }

    public function actionConekta(){
        
        $body = @file_get_contents('php://input');
        $data = json_decode($body);
        
	    file_put_contents('test.txt', $body);
        http_response_code(200); // Return 200 OK 
        
        if ($data->type == 'charge.paid'){
            $oxxo_id = $data->data->object->order_id;
            $pedido = Pedidos::find()->where('order_id="'.$oxxo_id.'"')->one();

            if(!$pedido){
                return Array(
                    'exito' => false,
                    'mensaje' => 'ID de pago no encontrado'
                );
            }

            $pedido->estado_pedido_id = 2;

            if(!$pedido->save()) 
            {
                return Array(
                    'exito' => false,
                    'mensaje' => 'Error al actualizar el estado del pedido.'
                );
            }
               
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
            
        }
            
        if ($data->type == 'charge.expired') {
            $oxxo_id = $data->data->object->charge->order_id;
            $pedido = Pedidos::find()->where('order_id="'.$oxxo_id.'"')->one();

            if(!$pedido){
                return Array(
                    'exito' => false,
                    'mensaje' => 'ID de pago no encontrado'
                );
            }

            $pedido->estado_pedido_id = 4;

            if(!$pedido->save()) 
            {
                return Array(
                    'exito' => false,
                    'mensaje' => 'Error al actualizar el estado del pedido.'
                );
            }
               
        }

    }
    
//    public function actionRecepcion(){
//        $datos_pago = file_get_contents("php://input");
//        $pago = json_decode($datos_pago);
//        if($pago->type == 'charge.succeeded' && $pago->transaction->method == 'store'){
//            $pedido = Pedido::find()->where('numero_pedido="'.$pago->transaction->order_id.'"')->one();
//            if($pedido){
//                $estado = EstadoPedido::find()->where('clave="CONF"')->one();
//                $pedido->estado_pedido_id = $estado->id;
//                $pedido->save();
//
//                $envio = EnviaYa::find()->where('pedido_id='.$pedido->id)->one();
//                $productos = $pedido->productos($pedido->id);
//                $cliente = new Cliente();
//                $cliente = $cliente->datos($pedido->cliente_id);
//                $usuario = User::findOne($cliente->user_id);
//                Yii::$app->mailer->compose()
//                    ->setTo($usuario->email)
//                    ->setFrom([Yii::$app->params['email'] => "VocaMX"])
//                    ->setSubject("Confirmación de compra")
//                    ->setHtmlBody(
//                        $this->renderPartial('_correo_confirmacion',[
//                            'envio' => $envio,
//                            'cliente' => $cliente,
//                            'productos' => $productos
//                        ])
//                        )
//                    ->send();
//                Yii::$app->mailer->compose()
//                    ->setTo(Yii::$app->params['email'])
//                    ->setFrom([Yii::$app->params['email'] => "VocaMX"])
//                    ->setSubject("Nuevo Pedido")
//                    ->setHtmlBody(
//                        $this->renderPartial('_correo_pedido',[
//                            'envio' => $envio,
//                            'cliente' => $cliente,
//                            'productos' => $productos
//                        ])
//                        )
//                    ->send();
//            }
//        }
//	//file_put_contents('test.txt',$pago->type);
//    }
}

    



