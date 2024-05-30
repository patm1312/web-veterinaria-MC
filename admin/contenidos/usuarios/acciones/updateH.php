<?php
    include('../../../../configuracion/conexion.php');
    //este scrip es para procesar los datos enviados por formulario para editar informacion de historias medicas: 
    $_SESSION['rta_admin'];
    //seguridad de la pagina.
    $maximo = 16000000; //Tamaño maximo 16 en MB
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
    if(isset($_GET['idH'])){
        $idH = $_GET['idH'];
        $nombre = $_POST['name'];
        $diagnostico = $_POST['diagnostico'];
        $hospitalizacion = $_POST['hospitalizacion'];
        $fechaI = $_POST['fechaI'];
        $fechaA = $_POST['fechaA'];
        $prescripciones = $_POST['prescripciones'];
        if(($_FILES['document']['size'] < $maximo)){
            if(isset($_SESSION['documento'])){
                $documento = $_SESSION['documento'];

                    //le quito esta ruta, ya que es la ruta almacenada en la DB, y con esa ruta no puedo elimnar la imagen en el servidor.
                    $documentoDB = str_replace('/contenidos/usuarios/assets/documents/', '', $documento);
            }else{
            }
        }else{
            $_SESSION['rta_admin'] = "img_big";
           echo "<script>window.location.href='../../../index.php'</script>";
        }
        $c = "UPDATE HistorialMedico set diagnostico=:diagnostico, hospitalizacion=:hospitalizacion, prescripciones=:prescripciones, fechaUpdate=now()";
          if(($_FILES['document']['size'] > 0)){
                //hay imagen de Pservicio cargada 
                $imagenuno = $_FILES['document']['name'];
                $tmp1_dir = $_FILES['document']['tmp_name'];
                //este es el recurso q se guarda en la carpeta del servidor
                $upload_diruno = '../assets/documents/'; // upload directory
                $img1Ext = strtolower(pathinfo($imagenuno,PATHINFO_EXTENSION)); 
                $fotoErase = $upload_diruno . $documentoDB;
                $fileImguno = time( ).rand(1,1000).".".$img1Ext;
                //esta es la ruta que se guarda en la bd para acceder a ella desde readImg.php
                $path1DB = '/contenidos/usuarios/assets/documents/'. $fileImguno;
                //concateno la consulta,
                $c = $c . ", documentos=:documentos";
                try {
                    //elimino la img del servidor
                    
                    unlink($fotoErase);
                    //cargo la nueva imagen en el servidor.
                    move_uploaded_file($tmp1_dir,$upload_diruno.$fileImguno);
                } catch (\Throwable $th) {
                    echo $th;
                }
            }
        
        if($fechaI != ''){
            $c = $c .  ",fechaIngreso=:fechaI";
        }
        if($fechaA != ''){
            
            $c = $c .  ",fechaAlta=:fechaA";
        }
        $c = $c .  " WHERE idHistorialMedico=:idHM";
        

try {
    //preparar la consulta:
    $stm = $pdo->prepare($c);
    //ejecutar la consulta:
    //vincular los dats con bimparams(recomendado):
    //primer argumento es el argumento  que especifico  en la consulta, el segundo parametro es la variable recibida  en el formuario, y  el tercer parametro es el tipo  de dato(PDO::PARAM_STR(es dato string)):
    $stm->bindParam(':diagnostico', $diagnostico, PDO::PARAM_STR);
    $stm->bindParam(':hospitalizacion', $hospitalizacion, PDO::PARAM_STR);
    if($fechaI != ''){
        $stm->bindParam(':fechaI', $fechaI, PDO::PARAM_STR);
    }
    if($fechaA != ''){
        $stm->bindParam(':fechaA', $fechaA, PDO::PARAM_STR);
    }
    if(($_FILES['document']['size'] > 0)){
        $stm->bindParam(':documentos', $path1DB, PDO::PARAM_STR);
    }
    $stm->bindParam(':prescripciones', $prescripciones);
    $stm->bindParam(':idHM', $idH);
    //ejecutar la consulta:
    $stm->execute();
} catch (PDOException $exception) {
    echo $exception;
}
    //Si el último identificador insertado es mayor que cero, la inserción funcionó.
    $count = $stm->rowCount();
    if($count > 0){
        $_SESSION['rta_admin'] = "ok_form";
        echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios&accion=editarH&idH=$idH'</script>";
    }else{
        $_SESSION['rta_admin'] = "error";
        echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios&accion=editarH&idH=$idH'</script>";
    }
}
   
        
?>