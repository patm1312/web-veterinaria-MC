<?php
    if(isset($_GET['idPS']) && isset($_GET['idp'])){
        $dato_consultaPSer = $_GET['idPS'];
        $idP = $_GET['idp'];
    }else{
        $_SESSION['rta_admin'] == 'DateNull';
        echo "<script>window.location.href='../../../index.php?seccion=AdminPublicaciones&accion=editarpS'</script>";
    }
    //consulto la bd con la publicacion a la que quiero editar para autocomplear en el formulario:
    $c = "SELECT titulo, subtitulo, parrafo, imagen, estado FROM PServicio WHERE idPservicio= :idPS AND publicaciones_idpublicaciones= :idP";
    //preparar la consulta:
    try {
            $stmt = $pdo->prepare($c);
        // Especificamos el fetch mode antes de llamar a fetch()
        //uso metodo execute con el metodo array para vincular el parametro a consultar:
        $stmt->execute(array(":idPS" => $dato_consultaPSer, ":idP" => $idP));
        // $row = $stmt->fetch();
        $p = $stmt->fetchAll();
    } catch (\Throwable $th) {
        echo $th;
    }
    $titulo;
    $subtitulo;
    $parrafo;
    $estado;
    $foto;
     foreach($p as $r){
             $titulo =  $r->titulo;
             $subtitulo =  $r->subtitulo;
             $parrafo =  $r->parrafo;
             $estado =  $r->estado;
             $foto =  $r->imagen;
            }
    $_SESSION['foto'] =  $foto;
?>
<input type="hidden" id="homeAdmin">
<form enctype="multipart/form-data" class="form contact-form" action="contenidos/publicaciones/acciones/updatePS.php?idPS=<?php echo $dato_consultaPSer;?>&idp=<?php echo $idP;?>" method="post">
        <div class="form__header">
            <!-- <a href="">
                <img class="left" src="assets/images/rght.png" alt="flecha">
            </a> -->
            <img class="form__header--img" src="assets/images/logolarge.png" alt="imagen logo">
            <div>
            </div>
        </div>
        <div class="form__body">    
                <h2 class="form__h2" >Datos de Publicacion:</h2>
                <p>Edita titulo de publicacion:</p>
                <input name="tittle" class="input" type="text" value=" <?php echo $titulo; ?>" placeholder="Titulo de Publicacion" title="Titulo  Invalido" pattern="^.{0,45}$" required>
                <p>Edita titulo de publicacion:</p>
                <input name="subtittle" class="input" type="text" value=" <?php echo $subtitulo; ?>" placeholder="Titulo de Publicacion" title="Titulo  Invalido" pattern="^.{0,45}$" required>
                <p>Edita la descripcion de tu  publicacion:</p>
                <textarea placeholder="Descripcion" name="textarea" rows="10" cols=""><?php echo $parrafo;?></textarea>
                <p>
                    Elimanar Contenido a Publicacion:<br>
                    <input <?php echo $resultadoP =  $estado == 0 ? 'checked' : ''; ?> type="radio" name="eliminar" value="0"> Borrar<br>
                    <input <?php echo $resultadoP =  $estado == 1 ? 'checked' : ''; ?> type="radio" name="eliminar" value="1"> Conservar<br>
                 </p>
                <div id="input_file" class="">
                    <p>Actualiza imagen de tu publicacion:</p>
                    <input class="" id="archivoDefault" type="file" name="imagen[]" accept=".png, .jpg, .jpeg" tittle="La imagen debe ser cuadrada como minimo">
                    <div>
                        <a href="" class="openImg">
                            <img class="openImg" src="contenidos/publicaciones/assets/default/img.png" alt="foto">
                            <!-- //aqu guardo la rutade la imagen para recuperarla, se puede mostar haciendo click en la imagen visualizar, se usa js. y readIumg.php abre la imagen. -->
                            <input  type="hidden" value="<?php echo $foto;?>">
                        </a>
                    </div>
                    <span class="messaje_form" id="span_input--default"></span>
                </div>
                <div class="bottom box__bottom box__bottom--login">
                    <input id="submit" class="" type="submit" value="Continuar">        
                </div>
    </form>