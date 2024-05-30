<?php
//p es el id de  la publicacion a la que le quiero gregar contenido
if(isset($_GET['p'])){
    if(!empty($_GET['p'])){
        $_SESSION['p_id'] = $_GET['p'];
    }else{
        $_SESSION['rta_admin'] == 'DateNull';
        echo "<script>window.location.href='../../../index.php?seccion=AdminPublicacioness&accion=addpServ'</script>";
    }
}
//agregar nuevo contenido a publicacion
?>
<form enctype="multipart/form-data" class="form contact-form" action="contenidos/publicaciones/acciones/addpServ.php" method="post">
        <div class="form__header">
            <img class="form__header--img" src="assets/images/logolarge.png" alt="imagen logo">
            <div>
            </div>
        </div>
        <div class="form__body">    
                <h2 class="form__h2" >Datos de Publicacion:</h2>
                <input name="tittle" class="input" type="name" placeholder="Titulo de Publicacion" title="Titulo  Invalido" pattern="^.{0,45}$" required>
                <input name="subtittle" class="input" type="name" placeholder="Subtitulo de Publicacion" title="Subtitulo Invalido" pattern="^.{0,45}$" required>
                <textarea placeholder="Descripcion" name="textarea" rows="10" cols=""></textarea>
                <h2>Foto:</h2>
                <div id="input_file" class="">
                    <input class="" id="archivoDefault" type="file" name="imagen[]" accept=".png, .jpg, .jpeg" tittle="La imagen debe ser cuadrada como minimo">
                    <span class="messaje_form" id="span_input--default"></span>
                </div>
                <div class="bottom box__bottom box__bottom--login">
                    <input id="submit" class="" type="submit" value="Continuar">        
        </div>
    </form>