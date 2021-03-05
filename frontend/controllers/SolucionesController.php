<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use app\components\CarritoComponent;
use frontend\models\Soluciones;
use frontend\models\InteriorPapel;
use frontend\models\InteriorColor;
use frontend\models\PortadaPapel;
use frontend\models\PortadaTipo;
use frontend\models\Tamano;
use frontend\models\Solapas;
use frontend\models\Retractil;
use frontend\models\PapelInterior;
use frontend\models\PapelPortada;

class SolucionesController extends Controller
{
    public function actionIndex(){
        $solucionForm = new Soluciones();
        $soluciones = Soluciones::find()->all();
        
        $papel_interior = ArrayHelper::map(InteriorPapel::find()->all(), 'id', 'papel');
        $papel_portada = ArrayHelper::map(PortadaPapel::find()->where(['activo' => 1])->all(), 'id', 'papel');
        $tipo_portada = ArrayHelper::map(PortadaTipo::find()->all(), 'id', 'tipo');
        $color = ArrayHelper::map(InteriorColor::find()->all(), 'id', 'tipo');
        $tamano = ArrayHelper::map(Tamano::find()->all(), 'id', 'tamano');
        return $this->render('index', [
            'soluciones' => $soluciones,
            'solucionForm' => $solucionForm,
            'papel_interior' => $papel_interior,
            'color' => $color,
            'tamano' => $tamano,
            'papel_portada' => $papel_portada,
            'tipo_portada' => $tipo_portada,
        ]);
    }
    
    public function actionCotizar(){
        if (Yii::$app->request->post()){
            $paginas = Yii::$app->request->post('paginas');
            $solucion_clave = Yii::$app->request->post('solucion_clave');
            if($solucion_clave != 'impr'){
                $solucion = Soluciones::find()->where(['clave' => $solucion_clave])->one();
                $cotizacion = $paginas*$solucion->precio;
            }
            if($solucion_clave == 'impr'){
                $int_papel = Yii::$app->request->post('int_papel');
                $int_color = Yii::$app->request->post('int_color');
                $port_tipo = Yii::$app->request->post('port_tipo');
                $port_papel = Yii::$app->request->post('port_papel');
                $tamano = Yii::$app->request->post('tamano');
                $tiraje = Yii::$app->request->post('tiraje');
                $solapas = Yii::$app->request->post('solapas');
                $retractil = Yii::$app->request->post('retractil');
                $precio_int = PapelInterior::find()
                    ->where([
                        'interior_papel_id' => $int_papel, 
                        'interior_color_id' => $int_color, 
                        'tamano_id' => $tamano
                    ])
                    ->one();
//                var_dump($precio_int);echo '<br>';
                $precio_port = PapelPortada::find()
                    ->where([
                        'portada_tipo_id' => $port_tipo, 
                        'portada_papel_id' => $port_papel, 
                        'tamano_id' => $tamano
                    ])
                    ->one();
                if($solapas === 'true'){
                    $solapa_precio = Solapas::find()->where(['tamano_id' => $tamano])->one();
                }
                if($retractil === 'true'){
                    $retractil_precio = Retractil::find()->where(['tamano_id' => $tamano])->one();
                }
                $cotizacion = ((($paginas*$precio_int->precio)+($precio_port->precio +$solapa_precio->precio +$retractil_precio->precio))*$tiraje)+165;
            }
        
            return $cotizacion;
        } else {
            return false;
        }
    }
    
    public function actionAgregarCarrito(){
        if(Yii::$app->request->post()){
            $solucion = Yii::$app->request->post('Soluciones');
            $respuesta = json_encode(Yii::$app->Carrito->agregarSolucion($solucion));
            return $respuesta;
        }
    }
    public function actionDrop(){
        $datos = Yii::$app->request->post("depdrop_all_params");
        if(!$datos){
            return Json::encode(['output'=>'', 'selected'=>'']);
        }
        $papeles = PortadaPapel::find()->where(['portada_tipo_id' => $datos['portada-tipo-impr']])->all();
        $respuesta = [];
        foreach($papeles as $papel){
            $respuesta[] = [
                'id' => $papel->id,
                'name' => $papel->papel
            ];
        }
        return Json::encode(['output'=>$respuesta, 'selected'=>$respuesta[0]]);
    }
}
