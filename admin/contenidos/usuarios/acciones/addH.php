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
            echo "<script>window.location.href='index.php?seccion=perfil'</script>";
        }
    }else{
        //echo "existe usuario";
        $_SESSION['rta'] = 'noAutorizado';
        echo "<script>window.location.href='index.php'</script>";
    }
    if(isset($_GET['idP'])){
        if(!empty($_GET['idP'])){
            $idPac = $_GET['idP'];
            $diagnostico = $_POST['diagnostico'];
            $hospitalizacion = $_POST['hospitalizacion'];
            $fechaI = $_POST['fechaI'];
            $fechaA = $_POST['fechaA'];
            $prescripciones = $_POST['prescripciones'];
            $c = " INSERT INTO HistorialMedico  (pacientes_idpacientes, diagnostico, estado, hospitalizacion, prescripciones, fechaIngreso, fechaRegistro";
            if(($_FILES['document']['size'] > 0)){
                if(($_FILES['document']['size'] > $maximo)){
                    $_SESSION['rta_admin'] = "error";
                    echo "<script>window.location.href='../../../index.php?seccion=AdminPublicaciones&accion=addH&idP=$idPac'</script>";
                }else{
                    //hay imagen de Pservicio cargada 
                    $imagenuno = $_FILES['document']['name'];
                    $tmp1_dir = $_FILES['document']['tmp_name'];
                    //este es el recurso q se guarda en la carpeta del servidor
                    $upload_diruno = '../assets/documents/'; // upload directory
                    $img1Ext = strtolower(pathinfo($imagenuno,PATHINFO_EXTENSION)); 
                    $fileImguno = time( ).rand(1,1000).".".$img1Ext;
                    //esta es la ruta que se guarda en la bd para acceder a ella desde readImg.php
                    $path1DB = '/contenidos/usuarios/assets/documents/'. $fileImguno;
                    try {
                        move_uploaded_file($tmp1_dir,$upload_diruno.$fileImguno);
                    } catch (\Throwable $th) {
                        echo $th;
                }


                    $c = $c .  ", documentos ";
                $consulta_value = ', :documentos';
                }
            }
           
            if($fechaA != ''){
                $c = $c .  ", fechaAlta";
                $consulta_value .= ', :fechaA)';
            }else{
                $consulta_value .= ')';
            }
            $consulta = ') VALUES (:paciente, :diagnostico, 1, :hospitalizacion, :prescripciones, :fechaI, now()';
            $c =  $c . $consulta .  $consulta_value;

    try {
        //preparar la consulta:
        $stm = $pdo->prepare($c);
        //ejecutar la consulta:
        //vincular los dats con bimparams(recomendado):
        //primer argumento es el argumento  que especifico  en la consulta, el segundo parametro es la variable recibida  en el formuario, y  el tercer parametro es el tipo  de dato(PDO::PARAM_STR(es dato string)):
        $stm->bindParam(':diagnostico', $diagnostico, PDO::PARAM_STR);
        $stm->bindParam(':hospitalizacion', $hospitalizacion, PDO::PARAM_STR);
        if(($_FILES['document']['size'] > 0)){
            echo ' doc parametros';
            $stm->bindParam(':documentos', $path1DB, PDO::PARAM_STR);
        }else{
        }
        try {
            $nuevafecha = date('Y-m-d H:i:s', strtotime($fechaI));
        } catch (\Throwable $th) {
            echo $th;
        }
        if($fechaI != ''){
            $stm->bindParam(':fechaI', $nuevafecha, PDO::PARAM_STR);
        }
        if($fechaA != ''){
            $stm->bindParam(':fechaA', $fechaA, PDO::PARAM_STR);
        }
        $stm->bindParam(':prescripciones', $prescripciones);
        $stm->bindParam(':paciente', $idPac);
        //ejecutar la consulta:
        $stm->execute();
    } catch (PDOException $exception) {
        echo $exception;
    }
    //Si el último identificador insertado es mayor que cero, la inserción funcionó.
        $lastInsertId = $pdo->lastInsertId();
    if($lastInsertId > 0){
        $_SESSION['rta_admin'] = "ok_form";
        echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios'</script>";
    }else{
        $_SESSION['rta_admin'] = "error";
        echo "<script>window.location.href='../../../index.php?seccion=AdminPublicaciones&accion=addH&idP=$idPac'</script>";
    }
        }else{
            $_SESSION['rta_admin'] = "DateNull";
            echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios'</script>";
        }
      
    }else{
        $_SESSION['rta_admin'] = "DateNull";
        echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios'</script>";
    }
   
        
?>