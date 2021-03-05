<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

\yii\web\YiiAsset::register($this);
?>

<section class="blog-ver">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="blogs-view">
                    <a href="<?= Url::toRoute(['/pedidos/index']) ?>" class="regresar-listado">Regresar</a>
                    <p class="title-view">Ver pedido</p>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'clave',
                            [
                                'label' => 'Nombre del cliente',
                                'value' => $model->clientes->nombre.' '.$model->clientes->apellidos,
                            ],
                            [
                                'label' => 'Correo del cliente',
                                'value' => $model->clientes->correo,
                            ],
                            [
                                'label' => 'Teléfono fijo',
                                'value' => $model->clientes->telefono,
                            ],
                            [
                                'label' => 'Teléfono móvil',
                                'value' => $model->clientes->celular,
                            ],
                            [
                                'label' => 'Fecha',
                                'value' => date( "d/m/Y", $model->created_at),
                            ],
                            [
                                'label' => 'Venta total', 
                                'value' => '$ '.number_format($model->venta_total, 2),
                            ],
                            [
                                'label' => 'Forma de pago',
                                'value' => ucfirst($model->formaPago->forma_pago),
                            ],
                            [
                                'label' => 'Estado del pedido',
                                'value' => ucfirst($model->estadoPedido->estado),
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <?php foreach($soluciones as $solucion){ ?>
                <?php if ($solucion->soluciones->clave == 'IMPR'){ ?> 
                    <div class="col-sm-6">
                        <p class="ver-titulo-solucion"><?= $solucion->soluciones->nombre ?></p>
                        <?= DetailView::widget([
                            'model' => $solucion,
                            'attributes' => [
                                [
                                    'label' => 'No. de páginas',
                                    'value' => $solucion->cantidad,
                                ],
                                [
                                    'label' => 'Tamaño',
                                    'value' => $solucion->papelInterior->tamano->tamano,
                                ],
                                [
                                    'label' => 'Color de impresión',
                                    'value' => $solucion->papelInterior->interiorColor->tipo,
                                ],
                                [
                                    'label' => 'Tipo de papel',
                                    'value' => $solucion->papelInterior->interiorPapel->papel,
                                ],
                                [
                                    'label' => 'Tipo de portada',
                                    'value' => $solucion->papelPortada->portadaTipo->tipo,
                                ],
                                [
                                    'label' => 'Material de portada',
                                    'value' => $solucion->papelPortada->portadaPapel->papel,
                                ],
                                [
                                    'label' => 'Solapas',
                                    'value' => function($solucion){
                                        if($solucion->solapas_id != null){
                                            return 'Si';
                                        } else {
                                            return 'No';
                                        }
                                    }
                                ],
                                [
                                    'label' => 'Retractil',
                                    'value' => function($solucion){
                                        if($solucion->retractil_id != null){
                                            return 'Si';
                                        } else {
                                            return 'No';
                                        }
                                    }
                                ],
                                [
                                    'label' => 'Tiraje',
                                    'value' => $solucion->tiraje,
                                ],
                                [
                                    'label' => 'Subtotal',
                                    'value' => '$ '.number_format($solucion->subtotal, 2),
                                ],
                            ],
                        ]) ?>
                    </div>
                <?php } else { ?>
                    <div class="col-sm-6">
                        <p class="ver-titulo-solucion"><?= $solucion->soluciones->nombre ?></p>
                        <?= DetailView::widget([
                            'model' => $solucion,
                            'attributes' => [
                                [
                                    'label' => $solucion->soluciones->unidad,
                                    'value' => $solucion->cantidad,
                                ],
                                [
                                    'label' => 'Subtotal',
                                    'value' => '$ '.number_format($solucion->subtotal, 2),
                                ],
                            ],
                        ]) ?>
                    </div>
                <?php } ?> 
            <?php } ?>
        </div>
        <br>
        <div class="row">
            <?php if ($documentos){ ?>
                <p class="ver-titulo-solucion">Documentos adjuntos</p>
            <?php } ?>
            <?php foreach ($documentos as $documento){ ?>
                <div class="col-sm-4 documento-wrap documento-<?= $documento->id ?>">
                    <p class="txt-doc-guardado"><?= substr($documento->nombre, 10) ?></p>
                    <?php if(substr($documento->nombre, -3) == 'pdf'){ ?>
                        <?= Html::img('@web/images/imagepdf.png', ['class' => 'img-responsive img-doc-guardado']) ?>
                        <br>
                        <?= Html::a('Descargar', '@web/archivos/'.$documento->nombre, ['class' => 'ver-documento']) ?>
                    <?php } else if (substr($documento->nombre, -3) == 'doc' || substr($documento->nombre, -4) == 'docx') { ?> 
                        <?= Html::img('@web/images/imagedoc.png', ['class' => 'img-responsive img-doc-guardado']) ?>
                        <br>
                        <?= Html::a('Descargar', '@web/archivos/'.$documento->nombre, ['class' => 'ver-documento']) ?>
                    <?php } else { ?> 
                        <?= Html::img('@web/archivos/'.$documento->nombre, ['class' => 'img-responsive img-doc-guardado']) ?>
                        <br>
                        <?= Html::a('Descargar', '@web/archivos/'.$documento->nombre, ['class' => 'ver-documento', 'target' => '_blank']) ?>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
