<?php
session_start();
if(isset($_SESSION['user_id'])){
    $_SESSION['cita']['nombre'] = $_SESSION['user_name'];
    $_SESSION['cita']['validar'] = true;
    if(isset($_POST['citaS'])){
        if(!empty($_POST['citaS'])){
            $servicio = $_POST['citaS'];
            $_SESSION['cita']['servicio'] = $servicio;
            $_SESSION['cita']['id_usuario'] = $_SESSION['user_id'];
            $_SESSION['cita']['correo'] = $_SESSION['user_subname'];
            echo "<script>window.location.href='../../index.php?seccion=cita__datos'</script>";
        }else{
            $_SESSION['rta_admin'] = "error";
            echo "<script>window.location.href='../../index.php?seccion=cita'</script>";
        }
    }else{
            $_SESSION['rta_admin'] = "error";
            echo "<script>window.location.href='../../index.php?seccion=cita'</script>";
        }
}else{
    if(isset($_POST['citaS'])){
        if(!empty($_POST['citaS'])){
            $servicio = $_POST['citaS'];
            $_SESSION['cita']['servicio'] = $servicio;
            echo "<script>window.location.href='../../index.php?seccion=citaUser'</script>";
        }else{
            $_SESSION['rta_admin'] = "error";
            echo "<script>window.location.href='../../index.php?seccion=cita'</script>";
        }
    }else{
        $_SESSION['rta_admin'] = "error";
        echo "<script>window.location.href='../../index.php?seccion=cita'</script>";
    }
 }

?>