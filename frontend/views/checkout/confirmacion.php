<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>


<section class="confirmacion">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php if ($pedido->estadoPedido->clave == 'ESP'){ ?> 
                    <p class="title-black title-confirmacion">En espera de pago</p>
                    <p class="txt-confirmacion"><a href="<?= Url::toRoute(['checkout/oxxo', 'pedido' => $pedido->clave]) ?>" class="confirmacion-correo" target="_blank">Descargue su ficha para realizar su pago en efectivo.</a> En breve nos pondremos en contacto contigo.</p>
                <?php } else { ?> 
                    <p class="title-black title-confirmacion">Confirmación de pago</p>
                    <p class="txt-confirmacion">Tu pago se realizó de forma correcta. En breve nos pondremos en contacto contigo.</p>
                <?php } ?>
                <p class="txt-confirmacion">A continuación adjunta tus documentos en caso de que sea necesario</p>
                <div class="row">
                    <div class="col-sm-6">
                        <?php $form = ActiveForm::begin(); ?>
                        <?= $form->field($documentosForm, 'archivo')->fileInput(['id' => 'input-archivo', 'accept' => '.jpg,.jpeg,.png'])->label(false) ?>
                        <p class="click-input-archivo"><?= Html::img('@web/icons/cerrar.png', ['class' => 'img-responsive img-input-archivo']) ?>Formato word, pdf, jpg, png.</p>
                        <?= Html::submitButton('Adjuntar', ['class' => 'btn-documentos-form']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="col-sm-6">
                        <img src="" class="img-responsive documento-preview" alt="">
                    </div>
                </div>
                
                <div class="row">
                <?php foreach ($documentos as $documento){ ?>
                    <div class="col-sm-4 documento-wrap documento-<?= $documento->id ?>">
                        <p class="txt-doc-guardado"><?= substr($documento->nombre, 10) ?></p>
                        <?php if(substr($documento->nombre, -3) == 'pdf'){ ?>
                            <?= Html::img('@web/images/imagepdf.png', ['class' => 'img-responsive img-doc-guardado']) ?>
                        <?php } else if (substr($documento->nombre, -3) == 'doc' || substr($documento->nombre, -4) == 'docx') { ?> 
                            <?= Html::img('@web/images/imagedoc.png', ['class' => 'img-responsive img-doc-guardado']) ?>
                        <?php } else { ?> 
                            <?= Html::img('@web/archivos/'.$documento->nombre, ['class' => 'img-responsive img-doc-guardado']) ?>
                        <?php } ?>
                        <button class="eliminar-doc" data-id='<?= $documento->id ?>'>Eliminar</button>
                    </div>
                <?php } ?>
                </div>
                
                <p class="txt-confirmacion">O si lo deseas manda tus documentos al correo 
                    <a href="mailto:soluciones@autorantida.com" class="confirmacion-correo">soluciones@autorantida.com</a>
                </p>
            </div>
        </div>
    </div>
</section>