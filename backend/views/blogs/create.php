<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\Blogs */

?>
<seccion class="crear-blog">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="blogs-create">
            <a href="<?= Url::toRoute(['/blogs/index']) ?>" class="regresar-listado">Regresar</a>
            <p class="title-view">Nueva Entrada</p>
                </div>
            </div>
            <div class="blogs-form">
                <?php $form = ActiveForm::begin(); ?>
                <div class="col-sm-12">
                    <?= $form->field($model, 'titulo')->textInput(['class' => 'entrada-input', 'maxlength' => true,'placeholder' => 'Título'])->label(false) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'autor')->textInput(['class' => 'entrada-input', 'maxlength' => true, 'placeholder' => 'Autor'])->label(false) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'tema')->textInput(['class' => 'entrada-input', 'maxlength' => true, 'placeholder' => 'Tema'])->label(false) ?>
                </div>
                <div class="col-sm-12">
                    <?= $form->field($model, 'resumen')->textarea(['class' => 'entrada-input-text wysi', 'rows' => 6, 'placeholder' => 'Resumen'])->label(false) ?>
                </div>
                <div class="col-sm-12">
                    <?= $form->field($model, 'texto')->textarea(['class' => 'entrada-input-text wysi', 'rows' => 6, 'placeholder' => 'Texto'])->label(false) ?>
                </div>
                <div class="col-sm-12 container-entrada-archivo">
                    <?= $form->field($model, 'archivo')->fileInput(['class' => 'entrada-input-archivo',  'id' => 'entrada-input-archivo', 'maxlength' => true])->label(false) ?>
                </div>
                <div class="col-sm-6 container-click-archivo">
                    <span class="click-entrada-archivo">Imagen</span>
                    <span class="click-entrada-archivo-2"><?= Html::img('@web/icons/edit.png', ['class' >= 'img-responsive']) ?> Adjunta una imagen en formato png o jpg.</span>
                </div>
                <div class="col-sm-6">
                    <img src="" class="img-responsive documento-preview img-ver-blog" alt="">
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
</seccion>
