<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$ini = parse_ini_file("../private.ini");
?>

<section class="seccion-pasos">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p class="title-black title-carrito">Carrito de compra</p>
            </div>
            <div class="col-xs-4 checkout-paso-1 paso-seleccionado">1. Carrito</div>
            <div class="col-xs-4 checkout-paso-2">2. Pago</div>
            <div class="col-xs-4 checkout-paso-3">3. Confirmación</div>
<!--            <hr><hr><hr>-->
        </div>
    </div>
</section>
        
<section class="productos-checkout">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 contenedor-checkout-productos">
                <p class="txt-cantidad-servicios ver-paso-1">Tienes <?= $numero_soluciones ?> servicios en el carrito</p>
                <p class="texto-servicio ver-paso-2">Servicios</p>
<!--                aqui va foreach              -->
                <?php foreach($productos as $producto){ ?>
                <div class="row contenedor-producto contenedor-producto-<?= $producto->soluciones->clave ?>">
                    <div class="col-xs-1 contenedor-producto-punto">
                        <div class="producto-punto"></div>
                    </div>
                    <div class="col-xs-8">
                        <p class="titulo-producto"><?= ucfirst($producto->soluciones->nombre) ?></p>
                        <p class="cantidad-producto"><?= $producto->cantidad .' '. $producto->soluciones->unidad ?></p>
                    </div>
                    <div class="col-xs-3 img-eliminar-container ">
                        <button class="btn-eliminar-producto" value="<?= $producto->soluciones->clave ?>">
                            <?= Html::img('@web/icons/cerrar.png', ['class' => 'img-responsive eliminar-producto ver-paso-1'])?>
                        </button>
                    </div>
                </div>
                <?php } ?> 
<!--                termina foreach    -->
              
              
<!--               solo se ve en paso 1-->
               <div class="row row-botones-checkout ver-paso-1">
                   <div class="col-xs-6">
                       <a href="<?= Url::toRoute('soluciones/index') ?>" class="btn-salir-checkout" >
                           <?= Html::img('@web/icons/desplegar.png', ['class' => 'img-responsive salir-checkout']) ?>
                           Seguir comprando
                        </a>
                   </div>
                   <div class="col-xs-6">
                       <button class="btn-checkout ir-paso-2">Continuar con pagos</button>
                   </div>
               </div>
               
<!--            solo se ve en paso 2      -->
               <div class="row ver-paso-2">
                   <div class="col-xs-12">
                       <p class="txt-checkout">Ingresa tus datos de contacto</p>
                        <div class="row">
                            <div class="col-xs-offset-1 col-xs-5 col-tarjeta-form">
                                <input type="text" class="tarjeta-form nombre-cliente-form" placeholder="Nombre">
                            </div>
                            <div class="col-xs-5 col-tarjeta-form">
                                <input type="text" class="tarjeta-form apellido-cliente-form" placeholder="Apellido">
                            </div>
                            <div class="col-xs-offset-1 col-xs-10 col-tarjeta-form">
                                <input type="text" class="tarjeta-form correo-cliente-form" placeholder="Correo electrónico">
                            </div>
                            <div class="col-xs-offset-1 col-xs-5 col-tarjeta-form">
                                <input type="text" class="tarjeta-form telefono-cliente-form" placeholder="Teléfono fijo" maxlength="14">
                            </div>
                            <div class="col-xs-5 col-tarjeta-form">
                                <input type="text" class="tarjeta-form celular-cliente-form" placeholder="Teléfono móvil" maxlength="14">
                            </div>
                        </div>
                        <p class="txt-checkout">Escoge tu forma de pago</p>
                        <div class="row">
                            <div class="col-xs-1">
                                <input type="radio" name="forma-pago" value="tarjeta" class="radio-tarjeta" data-clave="TAR">
                            </div>
                            <div class="col-xs-11 col-forma-pago">
                                <p>VISA / MASTERCARD / AMEX</p>
                            </div>
                        </div>
                        <div class="row row-tarjeta-pago">
                            <div class="col-xs-offset-1 col-xs-10 col-tarjeta-form">
                                <input type="text" class="tarjeta-form numero-tarjeta-form" placeholder="Número de tarjeta" maxlength="19">
                            </div>
                            <div class="col-xs-offset-1 col-xs-10 col-tarjeta-form">
                                <input type="text" class="tarjeta-form nombre-tarjeta-form" placeholder="Nombre del titular">
                            </div>
                            <div class="col-xs-offset-1 col-xs-5 col-tarjeta-form">
                                <input type="text" class="tarjeta-form fecha-tarjeta-form" placeholder="Fecha de vencimiento (MM/AA)" maxlength="5">
                            </div>
                            <div class="col-xs-5 col-tarjeta-form">
                                <input type="text" class="tarjeta-form codigo-tarjeta-form" placeholder="Código de seguridad" maxlength="4">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-1">
                                <input type="radio" name="forma-pago" value="efectivo" class="radio-efectivo" data-clave="EFE">
                            </div>
                            <div class="col-xs-11 col-forma-pago">
                                <p>EFECTIVO</p>
                            </div>                            
                        </div>
                        <div class="row ">
                            <div class="col-xs-12">
                                <p class="error-forma-pago">Debe seleccionar una forma de pago</p>
                                <p class="error-datos-pago">Debe llenar los datos de pago</p>
                                <p class="error-correo-pago">Debe colocar un correo válido</p>
                                <p class="error-nombre-pago">Debe colocar su nombre</p>
                                <p class="error-apellido-pago">Debe colocar su apellido</p>
                                <p class="error-telefono-pago">Debe colocar un número de teléfono fijo válido (10 dígitos)</p>
                                <p class="error-celular-pago">Debe colocar un número de teléfono móvil válido (10 dígitos)</p>
                            </div>
                        </div>
                       <div class="row row-botones-checkout">
                           <div class="col-xs-6">
                               <button class="btn-checkout-regresar ir-paso-1">
                                   <?= Html::img('@web/icons/desplegar.png', ['class' => 'img-responsive salir-checkout']) ?>
                                   Regresar a carrito
                                </button>
                           </div>
                           <div class="col-xs-6">
                               <button class="btn-checkout ir-paso-3">Confirmación de compra</button>
                           </div>
                       </div>
                       <p class="txt-factura">Si deseas solicitar factura, <a href="">haz click aqui</a></p>
                   </div>
               </div>

                
<!--               Solo se ve en paso 3    -->
               
               <div class="row ver-paso-3">
                   <div class="col-xs-12">
                       <div class="row row-pago-3">
                           <div class="col-xs-12 datos-cliente-3">
                               <p>DATOS DE CLIENTE</p>
                               <span class="paso-3-gris paso-3-cliente-nombre">** / **</span>
                               <span class="paso-3-gris paso-3-apellido">***</span>
                               <p class="paso-3-gris paso-3-correo">Ana Gabriela León Carbajal</p>
                               <span class="paso-3-gris paso-3-telefono">***</span>
                               <span class="paso-3-gris paso-3-celular">***</span>
                           </div>
                           <div class="col-xs-12 pago-tarjeta-3">
                               <p>VISA / MASTERCARD / AMEX</p>
                               <p class="paso-3-gris paso-3-tarjeta"></p>
                               <p class="paso-3-gris paso-3-nombre"></p>
                               <span class="paso-3-gris paso-3-fecha"></span>
                               <span class="paso-3-gris paso-3-seguridad"></span>
                           </div>
                           <div class="col-xs-12 pago-paypal-3">
                               <p>PAYPAL</p>
                           </div>
                           <div class="col-xs-12 pago-efectivo-3">
                               <p>EFECTIVO</p>
                           </div>
                       </div>
                       <button class="btn-checkout-regresar ir-paso-2">
                           <?= Html::img('@web/icons/desplegar.png', ['class' => 'img-responsive salir-checkout']) ?>
                           Regresar a pago
                        </button>
                   </div>
               </div>
           
           
            </div>
            
<!--            seccion derecha         -->
            <div class="col-sm-offset-1 col-sm-5">
                <div class="row">
                    <div class="col-xs-12">
                        <p class="titulo-producto">Subtotal</p>
                    </div>
                </div>
                <?php foreach($productos as $producto){ ?>
                <div class="row row-subtotal subtotal-<?=$producto->soluciones->clave?>">
                    <div class="col-xs-6">
                        <p><?= ucfirst($producto->soluciones->nombre) ?></p>
                    </div>
                    <div class="col-xs-6">
                        <p> $ <span class="span-subtotal-<?= $producto->soluciones->clave ?>"><?= number_format($producto->subtotal, 2) ?></span> MXN</p>
                    </div>
                </div>
                <?php } ?>
                <div class="row row-metodos-pago">
                    <div class="col-xs-12">
                        <p class="titulo-producto">Método de pago</p>
                        <p class="txt-metodo-pago">Pendiente</p>
                    </div>
                </div>
                <div class="row row-total">
                    <div class="col-xs-6">
                        <p class="txt-total">Total</p>
                    </div>
                    <div class="col-xs-6">
                        <?php foreach($productos as $producto){ 
                            $total += $producto->subtotal;
                        } ?>
                        <p class="titulo-producto"> $ <span class='span-txt-total'><?= number_format($total, 2) ?></span> MXN</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-offset-6 col-sm-6">
<!--                        <button class='btn-checkout realizar-pago'>Realizar pago</button>-->
                        <?= Html::button('Realizar pago', ['class' => 'btn-checkout btn-realizar-pago btn-disabled', 'disabled' => true]) ?>
                    </div>
                </div>
                <div class="row row-terminos">
                    <p class="error-condiciones">Debe aceptar los terminos y condiciones</p>
                    <div class="col-xs-1">
                        <input type="checkbox" class="check-terminos">
                    </div>
                    <div class="col-xs-11">
                        <p class="titulo-terminos">Términos y condiciones</p>
                        <p class="txt-terminos">Al dar click estas aceptando los rérminos y condiciones de este contrato</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $form = ActiveForm::begin([
    'action' => ['realizar-pago'],
    'options' => [
        'class' => 'pedido-form'
    ]
]); ?>
<?= $form->field($pedido, 'numero_tarjeta')->hiddenInput(['disabled' => true])->label(false) ?>
<?= $form->field($pedido, 'nombre_tarjeta')->hiddenInput(['disabled' => true])->label(false) ?>
<?= $form->field($pedido, 'expira_tarjeta')->hiddenInput(['disabled' => true])->label(false) ?>
<?= $form->field($pedido, 'seguridad_tarjeta')->hiddenInput(['disabled' => true])->label(false) ?>

<?= $form->field($pedido, 'nombre')->hiddenInput()->label(false) ?>
<?= $form->field($pedido, 'apellidos')->hiddenInput()->label(false) ?>
<?= $form->field($pedido, 'correo')->hiddenInput()->label(false) ?>
<?= $form->field($pedido, 'telefono')->hiddenInput()->label(false) ?>
<?= $form->field($pedido, 'celular')->hiddenInput()->label(false) ?>

<?= $form->field($pedido, 'pago_clave')->hiddenInput()->label(false) ?>
<?= $form->field($pedido, 'tok')->hiddenInput(['value' => $ini['publicKey']])->label(false) ?>

<?php  foreach($productos as $i => $producto){ ?>
    <div class="producto-each producto-<?= $producto->soluciones->clave ?>">
        <?php if($producto->soluciones->clave == 'IMPR'){ ?>
            <input type="hidden" class= '<?='producto-each-'.$i ?>' data-clave="<?= $producto->soluciones->clave ?>" data-cantidad="<?=$producto->cantidad?>" data-interior="<?=$producto->papel_interior_id?>" data-portada="<?=$producto->papel_portada_id?>" data-retractil="<?=$producto->retractil_id?>" data-solapas="<?=$producto->solapas_id?>" data-tiraje="<?=$producto->tiraje?>"> 
        <?php } else { ?>
            <input type="hidden" class= '<?='producto-each-'.$i ?>' data-clave="<?= $producto->soluciones->clave ?>", data-cantidad="<?=$producto->cantidad?>"> 
        <?php } ?>
    </div>
<?php } ?>

<?= Html::submitButton('Realizar pago', ['class' => 'btn-pedido-form', 'disabled' => true]) ?>
<?php ActiveForm::end(); ?>
</section>
