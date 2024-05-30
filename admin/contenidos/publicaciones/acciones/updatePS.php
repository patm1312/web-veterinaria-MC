<?php
    include('../../../../configuracion/conexion.php');
    //este scrip es para procesar los datos enviados por formulario para editar nueva publicacion: 
    $_SESSION['rta_admin'];
    //seguridad de la pagina.
    $maximo = 2 * 1024 * 1024; //Tamaño en MB
    if(isset($_SESSION['user_id'])){
        if($_SESSION['nivel_usuario'] == 'administrador'){
            //echo "<script>window.location.href='/veterinaria/admin/index.php'</script>";
        }else{
            //echo "No existe usuario administrador";
            $_SESSION['rta'] = 'noAutorizado';
            echo "<script>window.location.href='/veterinaria/index.php?seccion=perfil'</script>";
        }
    }else{
        //echo "existe usuario";
        $_SESSION['rta'] = 'noAutorizado';
        echo "<script>window.location.href='/veterinaria/index.php'</script>";
    }
    if(isset($_SESSION['foto'])){
        $foto = $_SESSION['foto'];
    }else{
    }
    //foto del slider que se envia a travez de session , es la ruta de la imagen que esta en la db de la publicacion en cuestion, q se va a modificar.
    $fotoS = $_SESSION['fotoS'];
    //le quito esta ruta, ya que es la ruta almacenada en la DB, y con esa ruta no puedo elimnar la imagen en el servidor.
    $fotoDB = str_replace('/contenidos/publicaciones/assets/ContenidoPServ', '', $foto);
    unset($_SESSION['foto']);
    if(isset($_POST['tittle'])){
        $idPS = $_GET['idPS'];
        $idp = $_GET['idp'];
        if(!empty($_POST['tittle'])){
            $titulo = $_POST['tittle'];
            $subtitulo = $_POST['subtittle'];
            $descripcion = $_POST['textarea'];
            if(isset($_POST['eliminar'])){
                $estado = $_POST['eliminar'];
            }else{
                $estado = 1;
            }
        }else{
            $_SESSION['rta_admin'] = "error";
            echo "<script>window.location.href='../../../index.php?seccion=AdminPublicaciones&accion=editarpS&idp=$idp&idPS=$idPS'</script>";
        }
        if(($_FILES['imagen']['size'][0] > $maximo)){
            $_SESSION['rta_admin'] = "img_big";
            echo "<script>window.location.href='../../../index.php?seccion=AdminPublicaciones&accion=editarpS&idp=$idp&idPS=$idPS'</script>";
        }else{
            $c = "UPDATE PServicio set titulo=:titulo, subtitulo=:subtitulo, fechaAlta=now(), parrafo=:descripcion, estado=:estado";
            if(($_FILES['imagen']['size'][0] > 0)){
                //hay imagen de Pservicio cargada 
                $imagenuno = $_FILES['imagen']['name'][0];
                $tmp1_dir = $_FILES['imagen']['tmp_name'][0];
                //este es el recurso q se guarda en la carpeta del servidor 
                $upload_diruno = '../assets/ContenidoPServ/'; // upload directory
                $img1Ext = strtolower(pathinfo($imagenuno,PATHINFO_EXTENSION)); 
                $fotoErase = $upload_diruno . $fotoDB;
                $fileImguno = time( ).rand(1,1000).".".$img1Ext;
                //esta es la ruta que se guarda en la bd para acceder a ella desde readImg.php
                $path1DB = '/contenidos/publicaciones/assets/ContenidoPServ/'. $fileImguno;
                //concateno la consulta,
                $c = $c . ", imagen=:foto";
                try {
                    //elimino la img del servidor
                    unlink($fotoErase);
                    //cargo la nueva imagen en el servidor.
                    move_uploaded_file($tmp1_dir,$upload_diruno.$fileImguno);
                } catch (\Throwable $th) {
                    echo $th;
                }
            }
           $c = $c .  " WHERE idPservicio=:idPS AND publicaciones_idpublicaciones=:idp";
                try {
                    //preparar la consulta:
                    $stm = $pdo->prepare($c);
                    //ejecutar la consulta:
                    //vincular los dats con bimparams(recomendado):
                    //primer argumento es el argumento  que especifico  en la consulta, el segundo parametro es la variable recibida  en el formuario, y  el tercer parametro es el tipo  de dato(PDO::PARAM_STR(es dato string)):
                    $stm->bindParam(':titulo', $titulo, PDO::PARAM_STR);
                    $stm->bindParam(':subtitulo', $subtitulo, PDO::PARAM_STR);
                    $stm->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                    $stm->bindParam(':estado', $estado, PDO::PARAM_STR);
                    $stm->bindParam(':idPS', $idPS);
                    $stm->bindParam(':idp', $idp);
                    if($_FILES['imagen']['size'][0] > 0){
                        $stm->bindParam(':foto', $path1DB);
                    }
                    //ejecutar la consulta:
                    $stm->execute();
                } catch (PDOException $exception) {
                    echo $exception;
                }
                //Si el último identificador insertado es mayor que cero, la inserción funcionó.
                $count = $stm->rowCount();
                if($count > 0){
                    $_SESSION['rta_admin'] = "ok_form";
                    echo "<script>window.location.href='../../../index.php?seccion=AdminPublicaciones&accion=editarpS&idp=$idp&idPS=$idPS'</script>";
                }else{
                    $_SESSION['rta_admin'] = "error";
                    echo "<script>window.location.href='../../../index.php?seccion=AdminPublicaciones&accion=editarpS&idp=$idp&idPS=$idPS'</script>";
                }
        }
    }
?>