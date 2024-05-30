<?php
    include('../../../../configuracion/conexion.php');
    //este scrip es para procesar los datos enviados por formulario para editar informacion de usuario: 
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
    $fotoPortada = $_SESSION['fotoP'];
    //le quito esta ruta, ya que es la ruta almacenada en la DB, y con esa ruta no puedo elimnar la imagen en el servidor.
    $fotoDB = str_replace('/contenidos/usuarios/assets/imgPerfil/', '', $foto);
    $fotoSDB = str_replace('/contenidos/usuarios/assets/imgPortada/', '', $fotoPortada);
    unset($_SESSION['foto']);
    unset($_SESSION['fotoP']);
    $nombre = $_POST['name'];
    $apellido = $_POST['subname'];
    $telefono = $_POST['phone'];
    $telefono2 = $_POST['phone2'];
    $direccion = $_POST['direccion'];
    $id = $_GET['id'];
    if(($_FILES['imagen']['size'][0] > $maximo) || ($_FILES['imagen']['size'][1] > $maximo)){
        $_SESSION['rta_admin'] = "img_big";
        echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios&accion=editarUser&id=$id'</script>";
        }else{
            $c = "UPDATE usuarios set nombre=:nombre, apellido=:apellido, fechaAlta=now(), direccion=:direccion, telefono=:telefono, telefonosecundario=:telefonosecundario";
            if(($_FILES['imagen']['size'][0] > 0)){
                //hay imagen de Pservicio cargada 
                $imagenuno = $_FILES['imagen']['name'][0];
                $tmp1_dir = $_FILES['imagen']['tmp_name'][0];
                //este es el recurso q se guarda en la carpeta del servidor
                $upload_diruno = '../assets/imgPerfil/'; // upload directory
                $img1Ext = strtolower(pathinfo($imagenuno,PATHINFO_EXTENSION)); 
                $fotoErase = $upload_diruno . $fotoDB;
                $fileImguno = time( ).rand(1,1000).".".$img1Ext;
                //esta es la ruta que se guarda en la bd para acceder a ella desde readImg.php
                $path1DB = '/contenidos/usuarios/assets/imgPerfil/'. $fileImguno;
                //concateno la consulta,
                $c = $c . ", foto=:foto";
                try {
                    //elimino la img del servidor
                    unlink($fotoErase);
                    //cargo la nueva imagen en el servidor.
                    move_uploaded_file($tmp1_dir,$upload_diruno.$fileImguno);
                } catch (\Throwable $th) {
                    echo $th;
                }
            }
            if(($_FILES['imagen']['size'][1] > 0)){
                $c = $c . ", fotoPortada=:fotoPortada";
                //hay imagen de ContenidoPservicio cargada 
                //imagenes  
                $imagendos = $_FILES['imagen']['name'][1]; 
                $tmp2_dir = $_FILES['imagen']['tmp_name'][1]; 
                $upload_dir2 = '../assets/imgPortada/'; // upload directory 
                $img2Ext = strtolower(pathinfo($imagendos,PATHINFO_EXTENSION)); 
                $fileImg2 = time( ).rand(1,1000).".".$img2Ext;
                $path2DB = '/contenidos/usuarios/assets/imgPortada/'. $fileImg2;
                $fotoEraseS = $upload_dir2 . $fotoSDB;
                unlink($fotoEraseS);
                move_uploaded_file($tmp2_dir,$upload_dir2.$fileImg2);
            }
           $c = $c .  " WHERE idusuario=:id";
                try {
                    //preparar la consulta:
                    $stm = $pdo->prepare($c);
                    //ejecutar la consulta:
                    //vincular los dats con bimparams(recomendado):
                    //primer argumento es el argumento  que especifico  en la consulta, el segundo parametro es la variable recibida  en el formuario, y  el tercer parametro es el tipo  de dato(PDO::PARAM_STR(es dato string)):
                    $stm->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                    $stm->bindParam(':apellido', $apellido, PDO::PARAM_STR);
                    $stm->bindParam(':direccion', $direccion, PDO::PARAM_STR);
                    $stm->bindParam(':telefono', $telefono, PDO::PARAM_INT);
                    $stm->bindParam(':telefonosecundario', $telefono2, PDO::PARAM_INT );
                    $stm->bindParam(':id', $id);
                    if($_FILES['imagen']['size'][0] > 0){
                        $stm->bindParam(':foto', $path1DB);
                    }
                    if($_FILES['imagen']['size'][1] > 0){
                        $stm->bindParam(':fotoPortada', $path2DB);
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
                    echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios&accion=editarUser&id=$id'</script>";
                }else{
                    $_SESSION['rta_admin'] = "error";
                    echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios&accion=editarUser&id=$id'</script>";
                }
        }
?>