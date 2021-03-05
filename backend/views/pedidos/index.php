<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>


<seccion class="seccion-pedidos">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p class="title-black">Pedidos</p>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
//                        'id',
                        [
                            'label' => 'CLAVE',
                            'value' => 'clave',
                        ],
                        [
                            'label' => 'FECHA',
                            'value' => function ($model) {
                                return date( "d/m/Y", $model->created_at);
                            }
                        ],
                        [
                            'label' => 'CLIENTE ID',
                            'value' => 'clientes_id',
                        ],
                        [
                            'label' => 'VENTA TOTAL',
                            'value' => 'venta_total',
                            'format' => ['decimal', 2],
                        ],
                        [
                            'label' => 'FORMA PAGO',
                            'value' => function ($model){
                                if ($model->forma_pago_id == 1){
                                    return 'TDC';
                                } else {
                                    return 'Efectivo';
                                }
                            }
                        ],
                        [
                            'label' => 'ESTADO PEDIDO',
                            'value' => function ($model){
                                if ($model->estado_pedido_id == 1){
                                    return 'Pendiente de pago';
                                } else {
                                    return 'Finalizado';
                                }
                            }
                        ],
                        [
                            'header' => 'ACCIÓN',
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view}',
                            'buttons' => [
                                'view' => function ($url,$model) {
                                    return Html::a(
                                        '',
                                        $url,
                                        ['class'=>'boton-ver']
                                    );
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</seccion>