<?php
 $section = isset($_GET['seccion']) ? $_GET['seccion']:'home';
?>
<form action="">
    <h1>homa soy la pagina de inicio, soy el header</h1>
    <h2>contenido que quieres ver:</h2>
        <input class="input__1"  type="button" value="informacion1">
        <input class="input__2"  type="button" value="informacion2">
        <div id="respuesta" class=""></div>
</form>
<script src="script.js" type="module"></script>