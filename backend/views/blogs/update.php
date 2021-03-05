<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<section class="blog-actualizar">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="blogs-update">
                    <a href="<?= Url::toRoute(['/blogs/index']) ?>" class="regresar-listado">Regresar</a>
                    <p class="title-view">Actualizar Entrada</p>
                    <div class="blogs-form">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="col-sm-12">
                        <?= $form->field($model, 'titulo')->textInput(['class' => 'entrada-input', 'maxlength' => true,'placeholder' => 'Título'])?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'autor')->textInput(['class' => 'entrada-input', 'maxlength' => true, 'placeholder' => 'Autor'])?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'tema')->textInput(['class' => 'entrada-input', 'maxlength' => true, 'placeholder' => 'Tema'])?>
                    </div>
                    <div class="col-sm-12">
                        <?= $form->field($model, 'resumen')->textarea(['class' => 'entrada-input-text wysi', 'rows' => 6, 'placeholder' => 'Resumen'])?>
                    </div>
                    <div class="col-sm-12">
                        <?= $form->field($model, 'texto')->textarea(['class' => 'entrada-input-text wysi', 'rows' => 6, 'placeholder' => 'Texto'])?>
                    </div>
                    <div class="col-sm-12 container-entrada-archivo">
                        <?= $form->field($model, 'archivo')->fileInput(['class' => 'entrada-input-archivo',  'id' => 'entrada-input-archivo', 'maxlength' => true])?>
                    </div>
                    <div class="col-sm-6 container-click-archivo">
                        <span class="click-entrada-archivo">Imagen</span>
                        <span class="click-entrada-archivo-2"><?= Html::img('@web/icons/edit.png', ['class' >= 'img-responsive']) ?> Adjunta una imagen en formato png o jpg.</span>
                    </div>
                    <div class="col-sm-6">
                        <?= Html::img('@web/blog/'.$model->imagen, ['class' => 'img-responsive documento-preview img-ver-blog']) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'activo')->checkBox() ?>
                    </div>
                    <div class="col-md-offset-8 col-md-2">
                        <?= Html::submitButton('Guardar', ['class' => 'btn-backend']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
