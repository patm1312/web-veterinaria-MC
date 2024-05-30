<?php
    include('../../../../configuracion/conexion.php');
    $_SESSION['rta_admin'];
    //seguridad de la pagina
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
    $maximo = 2 * 1024 * 1024; //Tamaño en MB
    $titulo = $_POST['tittle'];
    $subtitulo = $_POST['subtittle'];
    $descripcion = $_POST['textarea'];
    $imagenuno;
    $tmp1_dir;
    $espacio;
    $upload_dir; // upload directory
    $img1Ext; 
    $carpeta;
    $path1DB;
    $idPublicacionS = $_SESSION['p_id'];
    unset($_SESSION['p_id']);
    if(($_FILES['imagen']['size'][0] > $maximo)){
        $_SESSION['rta_admin'] = "img_big";
        echo "<script>window.location.href='../../../index.php?seccion=AdminPublicaciones&accion=addpServ&p=$idPublicacionS'</script>";
    }else{
        if(($titulo != '') && ($descripcion != '')){
            $estado = 1;
            $usuario = $_SESSION['user_id'];

            if(($_FILES['imagen']['size'][0] > 0)){
                //hay imagen de Pservicio cargada 
                $imagenuno = $_FILES['imagen']['name'][0];
                $tmp1_dir = $_FILES['imagen']['tmp_name'][0];
                //este es el recurso q se guarda en la carpeta del servidor
                $upload_dir = '../assets/ContenidoPServ/'; // upload directory
                $img1Ext = strtolower(pathinfo($imagenuno,PATHINFO_EXTENSION)); 
                $fileImg1 = time( ).rand(1,1000).".".$img1Ext;
                //esta es la ruta que se guarda en la bd para acceder a ella desde readImg.php
                $path1DB = '/contenidos/publicaciones/assets/ContenidoPServ/'. $fileImg1;
                move_uploaded_file($tmp1_dir,$upload_dir.$fileImg1);
            }else{
                //si no  se subio nunguna imagen se va a generar una imagen por defecto
                $path1DB = '/contenidos/publicaciones/assets/default/default.jpg';
            }
            $categoria =  'PServicio';
            $c = "INSERT INTO PServicio (titulo,subtitulo,parrafo,imagen,publicaciones_idpublicaciones,fechaAlta, estado) VALUES(:titulo, :subtitulo, :descripcion, :imagen, :publicaciones_idpublicaciones,now(), :estado)";
                try {
                    //preparar la consulta:
                    $stm = $pdo->prepare($c);
                    //ejecutar la consulta:
                    //vincular los dats con bimparams(recomendado):
                    //primer argumento es el argumento  que especifico  en la consulta, el segundo parametro es la variable recibida  en el formuario, y  el tercer parametro es el tipo  de dato(PDO::PARAM_STR(es dato string)):
                    $stm->bindParam(':titulo', $titulo, PDO::PARAM_STR);
                    $stm->bindParam(':subtitulo', $subtitulo, PDO::PARAM_STR);
                    $stm->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                    $stm->bindParam(':imagen', $path1DB, PDO::PARAM_STR);
                    $stm->bindParam(':publicaciones_idpublicaciones', $idPublicacionS);
                    $stm->bindParam(':estado', $estado);
                    //ejecutar la consulta:
                    $stm->execute();
                } catch (PDOException $exception) {
                    echo $exception;
                }
                //Si el último identificador insertado es mayor que cero, la inserción funcionó.
                    $lastInsertId = $pdo->lastInsertId();
                if($lastInsertId > 0){
                    $_SESSION['rta_admin'] = "ok_form";
                    echo "<script>window.location.href='../../../index.php?seccion=AdminPublicaciones'</script>";
                }else{
                    $_SESSION['rta_admin'] = "error__consulta";
                    echo "<script>window.location.href='../../../index.php?seccion=AdminPublicaciones'</script>";
                    
                };
        }else{
            $_SESSION['rta_admin'] = "error";
            echo "<script>window.location.href='../../../index.php?seccion=AdminPublicaciones&accion=addpServ&p=$idPublicacionS'</script>";
        }
    }
?>