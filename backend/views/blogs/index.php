<?php

use yii\helpers\Html;
use yii\grid\GridView;
Yii::$app->formatter->locale = 'es-ES';

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BlogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<section class="blogs">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 blogs-index">
                <p class="title-black">Blog</p>
                <p>
                    <?= Html::a('Agregar Entrada', ['create'], ['class' => 'btn btn-success btn-agregar-blog']) ?>
                </p>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
//                        'id',
                        [
                            'label' => 'TÍTULO',
                            'value' => 'titulo',
                        ],
                        [
                            'label' => 'AUTOR',
                            'value' => 'autor',
                        ],
                        [
                            'label' => 'TEMA',
                            'value' => 'tema',
                        ],
                        [
                            'label' => 'FECHA',
                            'value' => function ($model) {
                                return date( "d/m/Y", $model->created_at);
                            }
                        ],
                        [
                            'label' => 'RESUMEN',
                            'value' => 'resumen',
                        ],
                        [
                            'label' => 'PUBLICADO',
                            'value' => function ($model) {
                                if($model->activo == 1){
                                    return 'Si';
                                } else {
                                    return 'No';
                                }
                            }
                        ],
                        [
                            'header' => 'ACCIÓN',
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {update} {delete}',
                            'buttons' => [
                                'view' => function ($url,$model) {
                                    return Html::a(
                                        '',
                                        $url,
                                        ['class'=>'boton-ver']
                                    );
                                },
                                'update' => function ($url,$model) {
                                    return Html::a(
                                        '',
                                        $url,
                                        ['class'=>'boton-editar']);
                                },
                                'delete' => function ($url,$model) {
                                    return Html::a('', ['delete', 'id' => $model->id], [
                                        'class' => 'boton-borrar',
                                        'data' => [
                                            'confirm' => '¿Estás seguro de eliminar la entrada?',
                                            'method' => 'post',
                                        ],
                                    ]);
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</section>



