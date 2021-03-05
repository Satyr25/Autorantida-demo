<?php
use yii\helpers\Html;
use yii\helpers\Url;
date_default_timezone_set('America/Mexico_City');

?>
<link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

<div style="background-color: #efe0e4;text-align: center;margin: 0;">
    <div style="padding: 5vh 5%;">
        <div>
            <img src="http://www.autorantida.blackrobot.mx/images/logo.png" alt="logo" style='max-width: 250px'>
        </div>
        <br>
        <br>
        <?php if ($pedido->estadoPedido->clave == 'ESP'){ ?>
            <p style="font-size: 34px; font-family: 'Crimson Text', serif;margin: 0 0 5px;">¡Gracias por tu compra! Descarga tu ficha para poder realizar tu pago.</p>
        <?php } else { ?> 
            <p style="font-size: 34px; font-family: 'Crimson Text', serif;margin: 0 0 5px;">¡Gracias por tu compra!</p>
        <?php } ?>
        <br>
        <br>
        <p style="font-size: 30px;font-family: 'Crimson Text', serif;margin: 0 0 5px;">Datos de la venta</p>
        <p style="font-size: 20px;font-family: 'Open Sans', sans-serif;margin: 0 0 5px;">Clave: <?= $pedido->clave ?></p>
        <br>
        <br>
        <p style="font-size: 30px;font-family: 'Crimson Text', serif;margin: 0 0 5px;">Datos del pedido</p>
        <?php foreach($productos as $producto){ ?> 
            <?php if ($producto->soluciones->clave == 'IMPR'){ ?> 
                <p style="font-size: 20px;font-family: 'Open Sans', sans-serif;margin: 0 0 5px;">Cantidad: <?= $producto->tiraje?> Unidades</p>
            <?php } else { ?>
                <p style="font-size: 20px;font-family: 'Open Sans', sans-serif;margin: 0 0 5px;">Cantidad: <?= $producto->cantidad.' '.$producto->soluciones->unidad ?></p>
            <?php } ?>
            <p style="font-size: 20px;font-family: 'Open Sans', sans-serif;margin: 0 0 5px;">Servicio: <?= $producto->soluciones->nombre ?></p>
            <p style="font-size: 20px;font-family: 'Open Sans', sans-serif;margin: 0 0 5px;">Total: $<?= number_format($producto->subtotal, 2) ?> MXN</p>
            <br>
        <?php } ?>
        <?php if($pedido->estadoPedido->clave == 'ESP'){ ?> 
            <br>
            <p><a href="http://www.autorantida.blackrobot.mx/checkout/oxxo?pedido=<?=$pedido->clave?>" style="color: black;text-decoration-line: none;font-size: 24px; font-weight:bold;" target="_blank">Descarga tu ficha de pago</a></p>
        <?php } ?>

        <br>
        <br>
        <p style="font-size: 18px;font-family: 'Open Sans', sans-serif;margin: 0 0 5px;">Si tienes alguna duda escribenos a:</p>
        <p><a href="mailto:solar@solareditores.com" style="color: black;text-decoration-line: none;font-size: 18px;">solar@solareditores.com</a></p>
        <br>
        <br>
        <p style="font-size: 34px; font-family: 'Crimson Text', serif;margin: 0 0 5px;">Del autor al lector</p>
        <br>
    </div>
    <img src="http://www.autorantida.blackrobot.mx/images/ilustracion.png" alt="ilustracion" style="width: 100%;">
    <br>
</div>
