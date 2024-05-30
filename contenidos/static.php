<?php
//por medio de get recibo la varibale que medice que texto muestro si terminos o condiciones
$archivo = $_GET['cual'];
//titulo de el documento, segun el archivo que se va a leer
$first = substr($archivo, 1); 
$rest = substr($archivo, 0, 1);

//los archivos que voy a abrir con lafuncion 
$ruta = "institucion/$archivo.txt";
if(file_exists($ruta)){
    //con la funcion leo el archivo .txt
    $contenido = file_get_contents($ruta);
    // sin embargo cuando aceptamos codigo que se quiere procesar con esta funcion, y que se envia a travez de un comentario  que  hace el usuario, un textarea que hace el usuario, entonces si escribe en ese comentario codigo htlm, javasrcipt php, la funcion va a hacer que ste codigo  se procese interfiriendo en la ejecucion ormal de la pagina, por ello, para elviatr eso,  // sin embargo cuando aceptamos codigo que se quiere procesar con esta funcion, y que se envia a travez de un comentario  que  hace el usuario, un textarea que hace el usuario, entonces si escribe en ese comentario codigo htlm, javasrcipt php, la funcion va a hacer que ste codigo  se procese interfiriendo en la ejecucion ormal de la pagina, por ello, para elviatr eso, antes us o la funcion  strigs tags, para eliminar todo el contemndi ohtml que ha sido  escrito por el usuario en el textarea por ejemplo:
    //$contenido = strip_tags($contenido);
    //luego  cuando elimino todo, si agrego solo los br o los saltos de linea.
    $contenido = nl2br($contenido);
    
}else{
    $contenido = '<span class="error">Error, no es posible ir a ese sitio</span>';
    echo "<p>el invocador no puede finalizar la taarea sin ayuda del incluido</p>";
}
?>
<section class="container container__block ">
    <div class="poster__description postes_quienes">
       
        <div class="quienes__box">
            <h1 class="poster__description--h1 poster__description--h1--canva"><span class="poster__description--span poster__description--h1--canva"><?php echo $rest; ?></span><span class="poster__description--span2 poster__description--h1--canva"><?php echo $first; ?></span><br></h1>
        </div>
        <?php
            if($archivo == 'quienes somos'){

           ?>
        <div class="quienes__box2">
            <img class="quienes__box2--img" src="assets/images/veterinaria/somos.png" alt="veterinario">
        </div>
        <?php
    }
        ?>
    </div>

    <div class="quienes__box3" ><?php echo $contenido; ?></div>
</section>