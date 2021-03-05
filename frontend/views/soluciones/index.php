<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>


<section class="soluciones">
    <div class="gris-soluciones"></div>
    <div class="container">
        <div class="row">
        
<!--
            <div class="col-sm-6 solucion-wrap">
                <p class="title-black-circular">Traducción</p>
                <p class="soluciones-descripcion">Traducimos textos de todo tipo.</p>
                <p class="soluciones-descripcion">Cotejo de la traducción.</p>
                <button type="button" class="btn-cotizar" data-toggle="modal" data-target="#modal-1">Cotizar</button>
            </div>        
-->
            <div class="col-sm-6 solucion-wrap" id="estilo">
                <p class="title-black-circular">Correción de estilo</p>
                <p class="soluciones-descripcion"><i>Cuida el contenido de tu texto.</i></p>
                <ol class="soluciones-descripcion">
                    <li>La corrección de estilo o de original se hace en la primera lectura en la que se revisa la sintaxis y la ortografía del documento antes de que pase a la composición tipográfica o formación. Sin alterar el sentido de lo escrito por el autor, se limpia el texto con el fin de darle claridad, concisión y armonía, para facilitar la lectura al público al que va dirigido.</li>
                    <li>Marcaje. Se señalan las categorías del texto (títulos, subtítulos, citas, notas, etc.) y se cuida que estén homologadas a lo largo de la obra.</li>
                </ol>
                <div class="img-solucion-wrap">
                    <?= Html::img('@web/images/estilo.jpg', ['class' => 'img-responsive']) ?>
                </div>
                <div class="solucion-btn-wrap">
                    <button type="button" class="btn-cotizar" data-toggle="modal" data-target="#modal-estilo">Cotizar</button>
                </div>
            </div> 
            <div class="col-sm-6 solucion-wrap" id="formacion">
                <p class="title-black-circular">Formación</p>
                <p class="soluciones-descripcion"><i>Que el aspecto visual de tu libro no le dificulte la tarea a tu lector.</i></p>
                <ol class="soluciones-descripcion">
                    <li>El formador incorpora las correcciones señaladas en la lectura del original.</li>
                    <li>El texto se traslada a un programa de edición, en el que se le asignarán las categorías indicadas en el marcaje, siguiendo las especificaciones del diseño.</li>
                    <li>Adicionalmente, se hace una tercera lectura para señalar problemas de formación (viudas, huérfanas, callejones) y erratas que no se hayan subsanado. De esta forma se cuida la parte visual, es decir, la mancha tipográfica, para que el lector  experimente una lectura fluida sin distracciones, como blancos desproporcionados o saltos de página que corten ideas importantes.</li>
                </ol>
                <div class="solucion-btn-wrap">
                    <button type="button" class="btn-cotizar" data-toggle="modal" data-target="#modal-formacion">Cotizar</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 solucion-wrap" id="portada">
                <p class="title-black-circular">Diseño de portada</p>
                <p class="soluciones-descripcion"><i>Cuida la imagen y presentación de tu libro.</i></p>
                <p class="soluciones-descripcion">Elige una portada que exprese el contenido de tu obra, ¡que se vea bien por dentro y por fuera!</p>
                <div class="solucion-btn-wrap">
                    <button type="button" class="btn-cotizar" data-toggle="modal" data-target="#modal-portada">Comprar</button>
                </div>
            </div>
            <div class="col-sm-6 solucion-wrap" id="isbn">
                <p class="title-black-circular">ISBN</p>
                <p class="soluciones-descripcion"><i>Dale un identificador de libro internacional a tu obra.</i></p>
                <p class="soluciones-descripcion">El Número Internacional Normalizado del Libro (ISBN) es un identificador de trece dígitos que se asigna a cada publicación o edición de forma exclusiva. Codifica un título, editor, autor, país de publicación y características de la edición.</p>
                <div class="img-solucion-wrap">
                    <?= Html::img('@web/images/isbn.png', ['class' => 'img-responsive img-solucion-isbn']) ?>
                </div>
                <div class="solucion-btn-wrap">
                    <button type="button" class="btn-cotizar" data-toggle="modal" data-target="#modal-isbn">Comprar</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 solucion-wrap" id="impresion">
                <p class="title-black-circular">Impresión</p>
                <p class="soluciones-descripcion"><i>Si no sabes cuántos libros vas a vender, comienza con un tiro corto.</i></p>
                <p class="soluciones-descripcion">La impresión digital, impresión bajo demanda o POD, es una tecnología que permite plasmar directamente un archivo digital en papel sin necesidad de recurrir a procesos intermedios y así contar con tirajes desde un ejemplar.</p>
                <p class="soluciones-descripcion">Beneficios:</p>
                <ul class="soluciones-descripcion">
                    <li>Olvídate del almacenajeReduce tiempos de producción</li>
                    <li>Reduce tiempos de producción</li>
                    <li>Controla los gastos de inversión</li>
                    <li>Haz tantas reimpresiones como necesites</li>
                    <li>Mantén tu catálogo siempre vivo; si hay demanda, satisfácela</li>
                </ul>
                <div class="solucion-btn-wrap">
                    <button type="button" class="btn-cotizar" data-toggle="modal" data-target="#modal-impresion">Cotizar</button>
                </div>
            </div>
            <div class="col-sm-6 solucion-wrap" id="promocional">
                <p class="title-black-circular">Banner promocional</p>
                <p class="soluciones-descripcion"><i>Promociona tu obra</i></p>
                <p class="soluciones-descripcion">Obtén un banner promocional para tus redes sociales, deja que tus contactos se enteren de tu nueva publicación.</p>
                <div class="solucion-btn-wrap">
                    <button type="button" class="btn-cotizar btn-cotizar-modal" data-toggle="modal" data-target="#modal-banner" data-clave="bann">Comprar</button>
                </div>
            </div>
        </div>
<!--
        <div class="row">
            <div class="col-sm-6 solucion-wrap">
                <p class="title-black-circular">Redacción</p>
                <p class="soluciones-descripcion">Que el aspecto visual de tu libro no le dificulte la tarea a tu lector.</p>
                <p class="soluciones-descripcion">El formador incorpora las correcciones señaladas a la lectura de original.</p>
                <p class="soluciones-descripcion">Adicionalmente, se hace una tercera lectura para señalar problemas de formación (viudas, huérfanas, callejones) y erratas que no se hayan subsanado. De esta forma se cuida la parte visual, es decir, la mancha tipográfica, para que el lector experimente una lectura fluida sin distracciones, como blancos desproporcionados o saltos de página que corten ideas importantes.</p>
                <div class="solucion-btn-wrap">
                    <button type="button" class="btn-cotizar" data-toggle="modal" data-target="#modal-redaccion">Cotizar</button>
                </div>
            </div>
        </div>
-->
        <div class="row row-maquina-wrap">
            <div class="col-sm-6 solucion-wrap" id="distribucion">
                <p class="title-black-circular">Distribución</p>
                <p class="soluciones-descripcion"><i>Dale visibilidad a tu obra</i></p>
                <p class="soluciones-descripcion">Distribuye tus libros bajo demanda y sin costos de inversión en las principales librerías del país.</p>
                <p class="soluciones-descripcion">¿Cómo funciona?</p>
                <p><a href="">Librántida</a></p>
                <div class="solucion-btn-wrap">
                    <a href="<?= Url::toRoute('site/contacto') ?>" class="btn-contactar">Contactar</a>
                </div>
            </div>
            <div class="col-sm-6 solucion-wrap soluciones-maquina-wrap">
                <?= Html::img('@web/images/maquina.png', ['class' => 'img-responsive soluciones-maquina']) ?>
            </div>
        </div>
    </div>
</section>

<?= 
     $this->render('_modals', [
        'solucionForm' => $solucionForm,
        'papel_interior' => $papel_interior,
        'gramaje_interior' => $gramaje_interior,
        'color' => $color,
        'tamano' => $tamano,
        'papel_portada' => $papel_portada,
        'tipo_portada' => $tipo_portada,
     ]);
?>

