<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

\yii\web\YiiAsset::register($this);
?>

<section class="blog-ver">
    <div class="container">
        <div class="row">
            <a href="<?= Url::toRoute(['/blogs/index']) ?>" class="regresar-listado">Regresar</a>
            <p class="title-view">Ver blog</p>
            <p>
                <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn-backend']) ?>
                <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
                    'class' => 'btn-backend',
                    'data' => [
                        'confirm' => '¿Esta seguro de querer borrar esta entrada?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
            <div class="col-sm-12">
                <div class="blogs-view">
                    <br>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'titulo',
                            'autor',
                            'tema',
                            'resumen:ntext',
                            'texto:ntext',
                            [
                                'label' => 'Creado el',
                                'value' => function ($model) {
                                    return date( "d/M/Y", $model->created_at);
                                }
                            ],
                            [
                                'label' => 'Modificado el',
                                'value' => function ($model) {
                                    return date( "d/M/Y", $model->updated_at);
                                }
                            ],
                            [
                                'label' => 'Activo',
                                'value' => function ($model) {
                                    if($model->activo == 1){
                                        return 'Si';
                                    } else {
                                        return 'No';
                                    }
                                }
                            ],
                        ],
                    ]) ?>

                </div>
            </div>
            <div class="col-sm-12 img-container">
                <?= Html::img('@web/blog/'.$model->imagen, ['class' => 'img-responsive img-ver-blog']) ?>
            </div>
        </div>
    </div>
</section>
