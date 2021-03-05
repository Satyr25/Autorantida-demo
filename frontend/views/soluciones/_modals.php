<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

?>

<!--Modal correccion de estilo-->
<div class="modal fade" id="modal-estilo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close cerrar-modal" data-dismiss="modal" aria-label="Close">
                <?= Html::img('@web/icons/cerrar.png', ['class' => 'img-responsive img-cerrar-modal']) ?>
                <?= Html::img('@web/icons/cerrarHover.png', ['class' => 'img-responsive img-cerrar-modal-hover']) ?>
            </button>
            <div class="container modal-body">
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                        <p class="title-black title-solucion-modal">Cotizar corrección de estilo</p>
                        <p class="txt-cotizar">Por favor proporciona la información que se te pide para poder realizar la cotización correspondiente</p>
                        <br><br><br>
                        
                        <?php $form = ActiveForm::begin([
                            'action' => ['agregar-carrito'], 
                            'options' => [
                                'class' => 'solucion-form-estilo'
                            ]
                        ]); ?>
                        
                        <div class="col-sm-offset-3 col-sm-4 col-input-cotizar">
                            <?= $form->field($solucionForm, 'cantidad')->textInput(['class' => 'input-cotizar', 'id' => 'cantidad-esti', 'required' => true])->label(false) ?>
                            <?= $form->field($solucionForm, 'clave')->hiddenInput(['class' => 'solucion-form-clave', 'value' => 'ESTI'])->label(false) ?>
                            <span class="span-cotizar">Páginas</span>
                        </div> 
                        <div class="col-sm-2">
                            <button type="button" class="btn-cotizar calcular-cotizacion" data-clave="esti">Calcular</button>
                        </div>
                    </div>
                </div>
                <br><br><br>
                <div class="row">
                    <div class="col-sm-12 col-numero-cotizar">
                        <p class="numero-cotizar">$ </p>
                        <p class="numero-cotizar mostrar-numero-cotizar" >0.00</p>
                        <p class="numero-cotizar"> MXN </p>
                    </div>
                </div>
                <br><br><br>
                <div class="row">
                    <div class="col-sm-12 col-botones-cotizar">
                        <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
                        
                        <?= Html::submitButton('Agregar', ['class' => 'btn btn-cotizar btn-agregar-solucion', 'data-clave' => 'estilo']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <br><br>
            </div>
        </div>
    </div>
</div>
<button type="button" class="btn-modal-2-estilo" data-toggle="modal" data-target="#modal-estilo-2" data-clave="esti"></button>

<div class="modal fade" id="modal-estilo-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close cerrar-modal" data-dismiss="modal" aria-label="Close">
                <?= Html::img('@web/icons/cerrar.png', ['class' => 'img-responsive img-cerrar-modal']) ?>
                <?= Html::img('@web/icons/cerrarHover.png', ['class' => 'img-responsive img-cerrar-modal-hover']) ?>
            </button>
            <div class="container modal-body">
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                        <p class="title-black title-solucion-modal">Cotizar corrección de estilo</p>
                        <br>
                        <p class="txt-cotizar">Se agregó correctamente.</p>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-botones-cotizar">
                        <a href="<?= Url::toRoute(['checkout/index']) ?>" class="modal-link">Ir a carrito</a>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>


<!--Modal formacion-->
<div class="modal fade" id="modal-formacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close cerrar-modal" data-dismiss="modal" aria-label="Close">
                <?= Html::img('@web/icons/cerrar.png', ['class' => 'img-responsive img-cerrar-modal']) ?>
                <?= Html::img('@web/icons/cerrarHover.png', ['class' => 'img-responsive img-cerrar-modal-hover']) ?>
            </button>
            <div class="container modal-body">
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                        <p class="title-black title-solucion-modal">Cotizar formación</p>
                        <p class="txt-cotizar">Por favor proporciona la información que se te pide para poder realizar la cotización correspondiente</p>
                        <br><br><br>
                        
                        <?php $form = ActiveForm::begin([
                            'action' => ['agregar-carrito'], 
                            'options' => [
                                'class' => 'solucion-form-formacion'
                            ]
                        ]); ?>
                        
                        <div class="col-sm-offset-3 col-sm-4 col-input-cotizar">
                            <?= $form->field($solucionForm, 'cantidad')->textInput(['class' => 'input-cotizar', 'id' => 'cantidad-form', 'required' => true])->label(false) ?>
                            <?= $form->field($solucionForm, 'clave')->hiddenInput(['class' => 'solucion-form-clave', 'value' => 'FORM'])->label(false) ?>
                            <span class="span-cotizar">Páginas</span>
                        </div>  
                        <div class="col-sm-2">
                            <button type="button" class="btn-cotizar calcular-cotizacion" data-clave="form" >Calcular</button>
                        </div>
                    </div>
                </div>
                <br><br><br>
                <div class="row">
                    <div class="col-sm-12 col-numero-cotizar">
                        <p class="numero-cotizar">$ </p>
                        <p class="numero-cotizar mostrar-numero-cotizar" >0.00</p>
                        <p class="numero-cotizar"> MXN </p>
                    </div>
                </div>
                <br><br><br>
                <div class="row">
                    <div class="col-sm-12 col-botones-cotizar">
                        <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
                        
                        <?= Html::submitButton('Agregar', ['class' => 'btn btn-cotizar btn-agregar-solucion', 'data-clave' => 'formacion']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <br><br>
            </div>
        </div>
    </div>
</div>
<button type="button" class="btn-modal-2-formacion" data-toggle="modal" data-target="#modal-formacion-2" data-clave="form"></button>

<div class="modal fade" id="modal-formacion-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close cerrar-modal" data-dismiss="modal" aria-label="Close">
                <?= Html::img('@web/icons/cerrar.png', ['class' => 'img-responsive img-cerrar-modal']) ?>
                <?= Html::img('@web/icons/cerrarHover.png', ['class' => 'img-responsive img-cerrar-modal-hover']) ?>
            </button>
            <div class="container modal-body">
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                        <p class="title-black title-solucion-modal">Cotizar formación</p>
                        <br>
                        <p class="txt-cotizar">Se agregó correctamente.</p>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-botones-cotizar">
                        <a href="<?= Url::toRoute(['checkout/index']) ?>" class="modal-link">Ir a carrito</a>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>


<!--Modal diseño de portada-->
<div class="modal fade" id="modal-portada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close cerrar-modal" data-dismiss="modal" aria-label="Close">
                <?= Html::img('@web/icons/cerrar.png', ['class' => 'img-responsive img-cerrar-modal']) ?>
                <?= Html::img('@web/icons/cerrarHover.png', ['class' => 'img-responsive img-cerrar-modal-hover']) ?>
            </button>
            <div class="container modal-body">
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                        <p class="title-black title-solucion-modal">Cotizar diseño de portada</p>
                        <p class="txt-cotizar">Por favor proporciona la información que se te pide para poder realizar la cotización correspondiente</p>
                        <br><br><br>
                        
                        <?php $form = ActiveForm::begin([
                            'action' => ['agregar-carrito'], 
                            'options' => [
                                'class' => 'solucion-form-portada'
                            ]
                        ]); ?>
                        
                        <div class="col-sm-offset-3 col-sm-4 col-input-cotizar">
                            <?= $form->field($solucionForm, 'cantidad')->textInput(['class' => 'input-cotizar', 'id' => 'cantidad-port', 'required' => true])->label(false) ?>
                            <?= $form->field($solucionForm, 'clave')->hiddenInput(['class' => 'solucion-form-clave', 'value' => 'PORT'])->label(false) ?>
                            <span class="span-cotizar">Unidades</span>
                        </div>  
                        <div class="col-sm-2">
                            <button type="button" class="btn-cotizar calcular-cotizacion" data-clave="port" >Calcular</button>
                        </div>
                    </div>
                </div>
                <br><br><br>
                <div class="row">
                    <div class="col-sm-12 col-numero-cotizar">
                        <p class="numero-cotizar">$ </p>
                        <p class="numero-cotizar mostrar-numero-cotizar" >100.00</p>
                        <p class="numero-cotizar"> MXN </p>
                    </div>
                </div>
                <br><br><br>
                <div class="row">
                    <div class="col-sm-12 col-botones-cotizar">
                        <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
                        
                        <?= Html::submitButton('Agregar', ['class' => 'btn btn-cotizar btn-agregar-solucion', 'data-clave' => 'portada']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <br><br>
            </div>
        </div>
    </div>
</div>
<button type="button" class="btn-modal-2-portada" data-toggle="modal" data-target="#modal-portada-2" data-clave="port"></button>

<div class="modal fade" id="modal-portada-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close cerrar-modal" data-dismiss="modal" aria-label="Close">
                <?= Html::img('@web/icons/cerrar.png', ['class' => 'img-responsive img-cerrar-modal']) ?>
                <?= Html::img('@web/icons/cerrarHover.png', ['class' => 'img-responsive img-cerrar-modal-hover']) ?>
            </button>
            <div class="container modal-body">
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                        <p class="title-black title-solucion-modal">Cotizar diseño de portada</p>
                        <br>
                        <p class="txt-cotizar">Se agregó correctamente.</p>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-botones-cotizar">
                        <a href="<?= Url::toRoute(['checkout/index']) ?>" class="modal-link">Ir a carrito</a>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>


<!--Modal ISBN-->
<div class="modal fade" id="modal-isbn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close cerrar-modal" data-dismiss="modal" aria-label="Close">
                <?= Html::img('@web/icons/cerrar.png', ['class' => 'img-responsive img-cerrar-modal']) ?>
                <?= Html::img('@web/icons/cerrarHover.png', ['class' => 'img-responsive img-cerrar-modal-hover']) ?>
            </button>
            <div class="container modal-body">
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                        <p class="title-black title-solucion-modal">Comprar ISBN</p>
                        <p class="txt-cotizar">Por favor proporciona la información que se te pide para poder realizar la cotización correspondiente</p>
                        <br><br><br>
                        
                        <?php $form = ActiveForm::begin([
                            'action' => ['agregar-carrito'], 
                            'options' => [
                                'class' => 'solucion-form-isbn'
                            ]
                        ]); ?>
                        
                        <div class="col-sm-offset-3 col-sm-4 col-input-cotizar">
                            <?= $form->field($solucionForm, 'cantidad')->textInput(['class' => 'input-cotizar', 'id' => 'cantidad-isbn', 'required' => true])->label(false) ?>
                            <?= $form->field($solucionForm, 'clave')->hiddenInput(['class' => 'solucion-form-clave', 'value' => 'ISBN'])->label(false) ?>
                            <span class="span-cotizar">Unidades</span>
                        </div>  
                        <div class="col-sm-2">
                            <button type="button" class="btn-cotizar calcular-cotizacion" data-clave="isbn" >Calcular</button>
                        </div>
                    </div>
                </div>
                <br><br><br>
                <div class="row">
                    <div class="col-sm-12 col-numero-cotizar">
                        <p class="numero-cotizar">$ </p>
                        <p class="numero-cotizar mostrar-numero-cotizar" >100.00</p>
                        <p class="numero-cotizar"> MXN </p>
                    </div>
                </div>
                <br><br><br>
                <div class="row">
                    <div class="col-sm-12 col-botones-cotizar">
                        <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
                        
                        <?= Html::submitButton('Agregar', ['class' => 'btn btn-cotizar btn-agregar-solucion', 'data-clave' => 'isbn']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <br><br>
            </div>
        </div>
    </div>
</div>

<button type="button" class="btn-modal-2-isbn" data-toggle="modal" data-target="#modal-isbn-2" data-clave="isbn"></button>

<div class="modal fade" id="modal-isbn-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close cerrar-modal" data-dismiss="modal" aria-label="Close">
                <?= Html::img('@web/icons/cerrar.png', ['class' => 'img-responsive img-cerrar-modal']) ?>
                <?= Html::img('@web/icons/cerrarHover.png', ['class' => 'img-responsive img-cerrar-modal-hover']) ?>
            </button>
            <div class="container modal-body">
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                        <p class="title-black title-solucion-modal">Cotizar ISBN</p>
                        <br>
                        <p class="txt-cotizar">Se agregó correctamente.</p>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-botones-cotizar">
                        <a href="<?= Url::toRoute(['checkout/index']) ?>" class="modal-link">Ir a carrito</a>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>


<!--Modal impresion-->
<div class="modal fade" id="modal-impresion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close cerrar-modal" data-dismiss="modal" aria-label="Close">
                <?= Html::img('@web/icons/cerrar.png', ['class' => 'img-responsive img-cerrar-modal']) ?>
                <?= Html::img('@web/icons/cerrarHover.png', ['class' => 'img-responsive img-cerrar-modal-hover']) ?>
            </button>
            <div class="container modal-body">
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                        <p class="title-black title-solucion-modal">Cotizar impresión</p>
                        <p class="txt-cotizar">Por favor proporciona la información que se te pide para poder realizar la cotización correspondiente</p>
                        <br>
                        
                        <?php $form = ActiveForm::begin([
                            'action' => ['agregar-carrito'], 
                            'options' => [
                                'class' => 'solucion-form-impresion'
                            ]
                        ]); ?>
                        
                        <div class="col-sm-12 ">
                            <div class="row">
                                <p class="sub-cotizar-impresion">Seleccione las especificaciones del papel</p>
                                <div class="col-sm-6 col-input-cotizar-impresion">
                                    <?= $form->field($solucionForm, 'interior_papel')->dropDownList($papel_interior, ['class' => 'input-cotizar-impresion', 'id' => 'interior-papel-impr', 'required' => true, 'prompt'=>'Seleccione'])->label(false) ?>
                                    <span class="span-cotizar">Tipo de papel</span>
                                </div>
                                <div class="col-sm-6 col-input-cotizar-impresion">
                                    <span class="span-cotizar">Impresion a:</span>
                                    <?= $form->field($solucionForm, 'interior_color')->dropDownList($color,['class' => 'input-cotizar-impresion', 'id' => 'interior-color-impr', 'required' => true, 'prompt'=>'Seleccione'])->label(false) ?>
                                </div>
                                <div class="col-sm-6 col-input-cotizar-impresion">
                                    <?= $form->field($solucionForm, 'tamano')->dropDownList($tamano,['class' => 'input-cotizar-impresion', 'id' => 'tamano-impr', 'required' => true, 'prompt'=>'Seleccione'])->label(false) ?>
                                    <span class="span-cotizar">Tamaño de papel</span>
                                </div>
                                <div class="col-sm-6 col-input-cotizar-impresion">
                                    <?= $form->field($solucionForm, 'cantidad')->textInput(['class' => 'input-cotizar-impresion', 'id' => 'cantidad-impr', 'required' => true])->label(false) ?>
                                    <span class="span-cotizar">Número de páginas</span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <p class="sub-cotizar-impresion">Seleccione las especificaciones de la portada</p>
                                <div class="col-sm-5 col-input-cotizar-impresion">
                                    <?= $form->field($solucionForm, 'portada_papel')->dropDownList($papel_portada,['class' => 'input-cotizar-impresion', 'id' => 'portada-papel-impr', 'required' => true, 'prompt'=>'Seleccione'])->label(false) ?>
                                    <span class="span-cotizar">Tipo de portada</span>
                                </div>
                                <div class="col-sm-2 col-input-cotizar-impresion">
                                    <?= $form->field($solucionForm, 'solapas')->checkBox(['id' => 'solapas-impr'])->label(false) ?>
                                </div>
                                <div class="col-sm-2 col-input-cotizar-impresion">
                                    <?= $form->field($solucionForm, 'retractil')->checkBox(['id' => 'retractil-impr'])->label(false) ?>
                                </div>
                                <div class="col-sm-3 col-input-cotizar-impresion">
                                    <?= $form->field($solucionForm, 'tiraje')->textInput(['class' => 'input-cotizar-impresion', 'id' => 'tiraje-impr', 'required' => true])->label(false) ?>
                                    <span class="span-cotizar">Tiraje</span>
                                </div>
                            </div>
                        </div>  
                        <div class="col-sm-offset-5 col-sm-2">
                            <?= $form->field($solucionForm, 'clave')->hiddenInput(['class' => 'solucion-form-clave', 'value' => 'IMPR'])->label(false) ?>
                            <button type="button" class="btn-cotizar calcular-cotizacion" data-clave="impr" >Calcular</button>
                        </div>
                    </div>
                </div>
                <br><br><br>
                <div class="row">
                    <div class="col-sm-12 col-numero-cotizar">
                        <p class="numero-cotizar">$ </p>
                        <p class="numero-cotizar mostrar-numero-cotizar" ></p>
                        <p class="numero-cotizar"> MXN </p>
                    </div>
                </div>
                <br><br><br>
                <div class="row">
                    <div class="col-sm-12 col-botones-cotizar">
                        <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
                        
                        <?= Html::submitButton('Agregar', ['class' => 'btn btn-cotizar btn-agregar-solucion', 'data-clave' => 'impresion']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <br><br>
            </div>
        </div>
    </div>
</div>


<!--Modal banner impresion 2-->

<button type="button" class="btn-modal-2-impresion" data-toggle="modal" data-target="#modal-impresion-2" data-clave="impresion"></button>

<div class="modal fade" id="modal-impresion-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close cerrar-modal" data-dismiss="modal" aria-label="Close">
                <?= Html::img('@web/icons/cerrar.png', ['class' => 'img-responsive img-cerrar-modal']) ?>
                <?= Html::img('@web/icons/cerrarHover.png', ['class' => 'img-responsive img-cerrar-modal-hover']) ?>
            </button>
            <div class="container modal-body">
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                        <p class="title-black title-solucion-modal">Cotizar impresión</p>
                        <br>
                        <p class="txt-cotizar">Se agregó correctamente.</p>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-botones-cotizar">
                        <a href="<?= Url::toRoute(['checkout/index']) ?>" class="modal-link">Ir a carrito</a>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>


<!--Modal banner promocional-->
<div class="modal fade" id="modal-banner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close cerrar-modal" data-dismiss="modal" aria-label="Close">
                <?= Html::img('@web/icons/cerrar.png', ['class' => 'img-responsive img-cerrar-modal']) ?>
                <?= Html::img('@web/icons/cerrarHover.png', ['class' => 'img-responsive img-cerrar-modal-hover']) ?>
            </button>
            <div class="container modal-body">
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                        <p class="title-black title-solucion-modal">Cotizar banner promocional</p>
                        <p class="txt-cotizar">Por favor proporciona la información que se te pide para poder realizar la cotización correspondiente</p>
                        <br><br><br>
                        
                        <?php $form = ActiveForm::begin([
                            'action' => ['agregar-carrito'], 
                            'options' => [
                                'class' => 'solucion-form-banner'
                            ]
                        ]); ?>
                        
                        <div class="col-sm-offset-3 col-sm-4 col-input-cotizar">
                            <?= $form->field($solucionForm, 'cantidad')->textInput(['class' => 'input-cotizar', 'id' => 'cantidad-bann', 'required' => true])->label(false) ?>
                            <?= $form->field($solucionForm, 'clave')->hiddenInput(['class' => 'solucion-form-clave', 'value' => 'BANN'])->label(false) ?>
                            <span class="span-cotizar">Unidades</span>
                        </div>  
                        <div class="col-sm-2">
                            <button type="button" class="btn-cotizar calcular-cotizacion" data-clave="bann" >Calcular</button>
                        </div>
                    </div>
                </div>
                <br><br><br>
                <div class="row">
                    <div class="col-sm-12 col-numero-cotizar">
                        <p class="numero-cotizar">$ </p>
                        <p class="numero-cotizar mostrar-numero-cotizar" >100.00</p>
                        <p class="numero-cotizar"> MXN </p>
                    </div>
                </div>
                <br><br><br>
                <div class="row">
                    <div class="col-sm-12 col-botones-cotizar">
                        <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
                        
                        <?= Html::submitButton('Agregar', ['class' => 'btn btn-cotizar btn-agregar-solucion', 'data-clave' => 'banner']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <br><br>
            </div>
        </div>
    </div>
</div>


<!--Modal banner promocional 2-->

<button type="button" class="btn-modal-2-banner" data-toggle="modal" data-target="#modal-banner-2" data-clave="bann"></button>

<div class="modal fade" id="modal-banner-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close cerrar-modal" data-dismiss="modal" aria-label="Close">
                <?= Html::img('@web/icons/cerrar.png', ['class' => 'img-responsive img-cerrar-modal']) ?>
                <?= Html::img('@web/icons/cerrarHover.png', ['class' => 'img-responsive img-cerrar-modal-hover']) ?>
            </button>
            <div class="container modal-body">
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                        <p class="title-black title-solucion-modal">Cotizar banner promocional</p>
                        <br>
                        <p class="txt-cotizar">Se agregó correctamente.</p>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-botones-cotizar">
                        <a href="<?= Url::toRoute(['checkout/index']) ?>" class="modal-link">Ir a carrito</a>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>