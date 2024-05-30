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
    if(isset($_GET['idC']) && (isset($_GET['idPc']))){
        if(!empty($_GET['idC']) && (!empty($_GET['idPc']))){
            $descripcion = $_POST['textarea'];
        $fechaC = $_POST['fechaC'];
        $idC = $_GET['idC'];
        $idPc= $_GET['idPc'];
        $c = "UPDATE cita set fechaCita=:fechaC, descripcion=:descripcion, fechaAlta=now() WHERE pacientes_idpacientes=:idPc AND idcita=:idC";
              
                    try {
                        //preparar la consulta:
                        $stm = $pdo->prepare($c);
                        //ejecutar la consulta:
                        //vincular los dats con bimparams(recomendado):
                        //primer argumento es el argumento  que especifico  en la consulta, el segundo parametro es la variable recibida  en el formuario, y  el tercer parametro es el tipo  de dato(PDO::PARAM_STR(es dato string)):
                        $stm->bindParam(':fechaC', $fechaC, PDO::PARAM_STR);
                        $stm->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                        $stm->bindParam(':idC', $idC, PDO::PARAM_STR);
                        $stm->bindParam(':idPc', $idPc, PDO::PARAM_STR);
                        //ejecutar la consulta:
                        $stm->execute();
                    } catch (PDOException $exception) {
                        echo $exception;
                    }
                    //Si el último identificador insertado es mayor que cero, la inserción funcionó.
                    //Si el último identificador insertado es mayor que cero, la inserción funcionó.
                    $count = $stm->rowCount();
                    if($count > 0){
                        $_SESSION['rta_admin'] = "ok_form";
                        echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios&accion=editarCita&idC=$idM&idPc=$idU'</script>";
                    }else{
                        $_SESSION['rta_admin'] = "error";
                        echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios&accion=editarCita&idC=$idM&idPc=$idU'</script>";
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