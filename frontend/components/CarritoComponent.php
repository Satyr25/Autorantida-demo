<?php

namespace app\components;

use Yii;
use DateTime;
use yii\base\Component;
use yii\base\InvalidConfigException;

use \Conekta\Conekta;
use yii\web\Cookie;

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\Carritos;
use frontend\models\Soluciones;
use frontend\models\SolucionesCarrito;
use frontend\models\Clientes;
use frontend\models\Pedidos;
use frontend\models\Solapas;
use frontend\models\Retractil;
use frontend\models\PapelPortada;
use frontend\models\PapelInterior;
use frontend\models\PedidosSoluciones;
use frontend\models\FormaPago;

class CarritoComponent extends Component{
    
    private $transaction;

    private function verificarCookie(){
        if(Yii::$app->user->isGuest){
            $cookie_id = Yii::$app->getRequest()->getCookies()->getValue('autorantida_cart');
            if(!$cookie_id){
                $cookie_id = uniqid(rand(10,99));
                $cookie = new Cookie([
                    'name' => 'autorantida_cart',
                    'value' => $cookie_id,
                    'expire' => time() + 86400 * 365,
                ]);
                Yii::$app->getResponse()->getCookies()->add($cookie);
            }
            return $cookie_id;
        }
    }
    
    public function agregarSolucion($solucion){
        $cookie_id = $this->verificarCookie();
        $connection = \Yii::$app->db;
        $this->transaction = $connection->beginTransaction();
        $carrito = Carritos::find()->where(['cookie' => $cookie_id])->one();
        if (!$carrito){
            $carrito = new Carritos();
            $carrito->cookie = $cookie_id;
            if(!$carrito->save()){
                $this->transaction->rollback();
                return [
                    'exito' => 0,
                    'mensaje' => 'Ocurrio un error al agregar el producto al carrito',
                ];
            }
            $carrito = Carritos::find()->where(['cookie' => $cookie_id])->one();
        }
        $solucion_bd = Soluciones::find()->where(['clave' => strtoupper($solucion['clave'])])->one();
        
        $solucion_carrito = SolucionesCarrito::find()->where(['carritos_id' => $carrito->id, 'soluciones_id' => $solucion_bd->id])->one();
        if($solucion_carrito){
            if($solucion_bd->clave == 'IMPR'){
                if($solucion['solapas'] == 1){
                    $solapa = Solapas::find()->where(['tamano_id' => $solucion['tamano']])->one();
                }
                if($solucion['retractil'] == 1){
                    $retractil = Retractil::find()->where(['tamano_id' => $solucion['tamano']])->one();
                }
                
                $precio_int = PapelInterior::find()
                    ->where([
                        'interior_papel_id' => $solucion['interior_papel'], 
                        'interior_color_id' => $solucion['interior_color'],  
                        'tamano_id' => $solucion['tamano'],
                    ])
                    ->one();
                $precio_port = PapelPortada::find()
                    ->where([
                        'portada_tipo_id' => $solucion['portada_tipo'], 
                        'portada_papel_id' => $solucion['portada_papel'], 
                        'tamano_id' => $solucion['tamano']
                    ])
                    ->one();
                
                $solucion_carrito->carritos_id = $carrito->id;
                $solucion_carrito->soluciones_id = $solucion_bd->id;
                $solucion_carrito->cantidad += $solucion['cantidad'];
                $solucion_carrito->tiraje += $solucion['tiraje'];
                $solucion_carrito->retractil_id = $retractil->id;
                $solucion_carrito->solapas_id = $solapa->id;
                
                $solucion_carrito->papel_interior_id = $precio_int->id;
                $solucion_carrito->papel_portada_id = $precio_port->id;

                $solucion_carrito->subtotal = ((($solucion_carrito->cantidad*$precio_int->precio)+($precio_port->precio +$solapa->precio +$retractil->precio))*$solucion_carrito->tiraje)+165;
            } else {
                $solucion_carrito->cantidad += $solucion['cantidad'];
                $solucion_carrito->subtotal = $solucion_carrito->cantidad * $solucion_bd->precio;
            }
        } else {
            $solucion_carrito = new SolucionesCarrito();
            $solucion_carrito->carritos_id = $carrito->id;
            $solucion_carrito->soluciones_id = $solucion_bd->id;
            $solucion_carrito->cantidad = $solucion['cantidad'];
            if ($solucion_bd->clave == 'IMPR'){
                if($solucion['solapas'] == 1){
                    $solapa = Solapas::find()->where(['tamano_id' => $solucion['tamano']])->one();
                }
                if($solucion['retractil'] == 1){
                    $retractil = Retractil::find()->where(['tamano_id' => $solucion['tamano']])->one();
                }
                
                $precio_int = PapelInterior::find()
                    ->where([
                        'interior_papel_id' => $solucion['interior_papel'], 
                        'interior_color_id' => $solucion['interior_color'],  
                        'tamano_id' => $solucion['tamano'],
                    ])
                    ->one();
                $precio_port = PapelPortada::find()
                    ->where([
                        'portada_tipo_id' => $solucion['portada_tipo'], 
                        'portada_papel_id' => $solucion['portada_papel'], 
                        'tamano_id' => $solucion['tamano']
                    ])
                    ->one();
                
                $solucion_carrito->carritos_id = $carrito->id;
                $solucion_carrito->soluciones_id = $solucion_bd->id;
                $solucion_carrito->cantidad = $solucion['cantidad'];
                $solucion_carrito->tiraje = $solucion['tiraje'];
                $solucion_carrito->retractil_id = $retractil->id;
                $solucion_carrito->solapas_id = $solapa->id;
                
                $solucion_carrito->papel_interior_id = $precio_int->id;
                $solucion_carrito->papel_portada_id = $precio_port->id;

                $solucion_carrito->subtotal = ((($solucion_carrito->cantidad*$precio_int->precio)+($precio_port->precio +$solapa->precio +$retractil->precio))*$solucion_carrito->tiraje)+165;
            } else {
                $solucion_carrito->subtotal = $solucion_carrito->cantidad * $solucion_bd->precio;
            }
        }
        if (!$solucion_carrito->save()){
            $this->transaction->rollback();
            var_dump($solucion_carrito->errors);exit;
            return [
                'exito' => 0,
                'mensaje' => 'Ocurrio un error al agregar el producto al carrito',
            ];
        }
        $this->transaction->commit();
        return [
            'exito' => 1,
            'mensaje' => 'Se agrego correctamente el producto al carrito',
        ];
    }
    
    public function contarSoluciones(){
        if (Yii::$app->getRequest()->getCookies()->getValue('autorantida_cart')){
            $cookie_id = Yii::$app->getRequest()->getCookies()->getValue('autorantida_cart');
            $carrito = Carritos::find()->where(['cookie' => $cookie_id])->one();
        } else {
            return false;
        }
        return SolucionesCarrito::find()->where(['carritos_id' => $carrito->id])->count();
    }
    
    public function getProductosCarrito(){
        if (Yii::$app->getRequest()->getCookies()->getValue('autorantida_cart')){
            $cookie_id = Yii::$app->getRequest()->getCookies()->getValue('autorantida_cart');
            $carrito = Carritos::find()->where(['cookie' => $cookie_id])->one();
        } else {
            return false;
        }
        return SolucionesCarrito::find()->where(['carritos_id' => $carrito->id])->all();
    }
    
    public function borrarSolucion($clave){
        if (Yii::$app->getRequest()->getCookies()->getValue('autorantida_cart')){
            $cookie_id = Yii::$app->getRequest()->getCookies()->getValue('autorantida_cart');
            $carrito = Carritos::find()->where(['cookie' => $cookie_id])->one();
        } else {
            return false;
        }
        
        $solucion = Soluciones::find()->where(['clave' => $clave])->one();
        $query_eliminar = SolucionesCarrito::find()->where(['carritos_id' => $carrito->id, 'soluciones_id' => $solucion->id])->one();
        if (!$query_eliminar->delete()){
            return false;
        }  
        return true;
    }
    
    public function realizarPago($params){
        $token = json_decode($params['token']);
//        $productos = json_decode($params['productos'], true);
        $datos_post = $params['Pedidos'];
        $fecha_actual = new DateTime();
        $fecha_expira = strtotime('+7 days', $fecha_actual->getTimestamp());
        
        $productos = $this->getProductosCarrito();
        
        
        foreach($productos as $i => $producto){
            if($producto->soluciones->clave == 'IMPR'){
                $productos_pago[$i]['unit_price'] = intval((((($producto->cantidad * $producto->papelInterior->precio) + ($producto->papelPortada->precio + $producto->retractil->precio + $producto->solapas->precio))* $producto->tiraje)+165)/$producto->tiraje)*100;
                $productos_pago[$i]['quantity'] = $producto->tiraje;
                $productos_pago[$i]['name'] = $producto->soluciones->nombre;
                $venta_total += ($producto->subtotal); 
                
            } else {
                $productos_pago[$i]['unit_price'] = intval($producto->soluciones->precio)*100;
                $productos_pago[$i]['quantity'] = $producto->cantidad;
                $productos_pago[$i]['name'] = $producto->soluciones->nombre;
                $venta_total += $producto->subtotal; 
            }
        }
        
        $tel_conek = str_replace(' ', '', $datos_post['telefono']);
        if($datos_post['pago_clave'] == ('TAR')){
            $forma_pago = 'card';
            $estado_pedido = 2;
            $orden =  array(
                'currency' => 'MXN',
                'customer_info' => array(
                    'name'=> $datos_post['nombre'].' '.$datos_post['apellidos'],
                    'email'=> $datos_post['correo'],
                    'phone' => '+52'.$tel_conek,
                ),
                'line_items' => $productos_pago,
                'charges' => array(
                    array(
                        'payment_method' =>  array(
                            'type' => $forma_pago,
                            'expires_at' => $fecha_expira,
                            'token_id' => $token->id,
                        ),
                    ),
                ),
            );
        } else if ($datos_post['pago_clave'] == ('EFE')){
            $forma_pago = 'oxxo_cash';
            $estado_pedido = 1;
            $orden =  array(
                'payment_status' => 'pending_payment',
                'currency' => 'MXN',
                'customer_info' => array(
                    'name'=> $datos_post['nombre'].' '.$datos_post['apellidos'],
                    'email'=> $datos_post['correo'],
                    'phone' => '+52'.$tel_conek,
                ),
                'line_items' => $productos_pago,
                'charges' => array(
//                    'status' => 'pending_payment',
                    array(
                        'payment_method' =>  array(
                            'type' => $forma_pago,
                            'expires_at' => $fecha_expira,
                        ),
                    ),
                ),
            );
        }        
        
        $connection = \Yii::$app->db;
        $this->transaction = $connection->beginTransaction();
        
        $cliente = new Clientes();
        $cliente->nombre = $datos_post['nombre'];
        $cliente->apellidos = $datos_post['apellidos'];
        $cliente->correo = $datos_post['correo'];
        $cliente->telefono = $datos_post['telefono'];
        $cliente->celular = $datos_post['celular'];
        if (!$cliente->save()){
            $this->transaction->rollback();
            return [
                'exito' => 0,
                'mensaje' => 'Error finalizando compra. Error(CLI)',
            ];
        }
        
        $ini = parse_ini_file("../private.ini");
        \Conekta\Conekta::setApiKey($ini['privateKey']);
        \Conekta\Conekta::setApiVersion("2.0.0");
        \Conekta\Conekta::setLocale('es');
        
        try{
            $order = \Conekta\Order::create($orden);
        }catch (\Conekta\ProcessingError $error){
            var_dump($error->getMessage());exit;
            return [
                'exito' => 0,
                'mensaje' => '1: '.$error->getMessage(),
            ];
        } catch (\Conekta\ParameterValidationError $error){
            var_dump($error->getMessage());exit;
            return [
                'exito' => 0,
                'mensaje' => '2: '.$error->getMessage(),
            ];
        } catch (\Conekta\Handler $error){
            var_dump($error->getMessage());exit;
            return [
                'exito' => 0,
                'mensaje' => '3: '.$error->getMessage(),
            ];
        } catch (\Conekta\ApiError $error){
            var_dump($error->getMessage());exit;
            return [
                'exito' => 0,
                'mensaje' => '4: '.$error->getMessage(),
            ];
        } catch (\Conekta\AuthenticationError $error){
            var_dump($error->getMessage());exit;
            return [
                'exito' => 0,
                'mensaje' => '5: '.$error->getMessage(),
            ];
        } catch (\Conekta\MalFormedRequestError $error){
            var_dump($error->getMessage());
            return [
                'exito' => 0,
                'mensaje' => '6: '.$error->getMessage(),
            ];
        } catch (\Conekta\ResourceNotFoundError $error){
            var_dump($error->getMessage());exit;
            return [
                'exito' => 0,
                'mensaje' => '7 '.$error->getMessage(),
            ];
        }
        $forma_pago = FormaPago::find()->where(['clave' => $datos_post['pago_clave']])->one();
        $pedido = new Pedidos();
        $pedido->clave = $pedido->crearClave();
        $pedido->venta_total = $venta_total;
        $pedido->forma_pago_id = $forma_pago->id;
        $pedido->estado_pedido_id = $estado_pedido;
        $pedido->clientes_id = $cliente->id;
        $pedido->referencia = $order->charges[0]->payment_method->reference;
        $pedido->barras = $order->charges[0]->payment_method->barcode_url;
        $pedido->order_id = $order->id;
        if (!$pedido->save()){
            $this->transaction->rollback();
            return [
                'exito' => 0,
                'mensaje' => 'Error finalizando compra. Error(PE)',
            ];
        }
        
        foreach($productos as $producto){
            $solucion_pedido = new PedidosSoluciones();
            if($producto->soluciones->clave == 'IMPR'){
                $solucion_pedido->papel_interior_id = $producto->papel_interior_id;
                $solucion_pedido->papel_portada_id = $producto->papel_portada_id;
                $solucion_pedido->retractil_id = $producto->retractil_id;
                $solucion_pedido->solapas_id = $producto->solapas_id;
                $solucion_pedido->tiraje = $producto->tiraje;
            }
            $solucion_pedido->cantidad = $producto->cantidad;
            $solucion_pedido->pedidos_id = $pedido->id;
            $solucion_pedido->soluciones_id = $producto->soluciones_id;
            $solucion_pedido->subtotal = $producto->subtotal;
            if (!$solucion_pedido->save()){
                return [
                    'exito' => 0,
                    'mensaje' => 'Error finalizando compra. Error(SOL)',
                ];
            }   
        }
        
        $cookies = Yii::$app->response->cookies;
        $cookies->remove('autorantida_cart');
        $this->transaction->commit();
        return [
            'exito' => 1,
            'mensaje' => 'Se realizó la compra satisfactoriamente',
            'clave' => $pedido->clave,
            'orden' => $order,
        ];
    }
}



