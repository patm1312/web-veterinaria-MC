<?php
include('../../configuracion/conexion.php');
session_start();
?>
<?php
if((isset($_POST['phone__dig1'])) && isset($_POST['phone__dig2']) && isset($_POST['phone__dig3']) && isset($_POST['phone__dig4'])){
    $uno = $_POST['phone__dig1'];
    $dos= $_POST['phone__dig2'];
    $tres = $_POST['phone__dig3'];
    $cuatro = $_POST['phone__dig4'];
        $digito =  $uno;
        $digito .=  $dos;
        $digito .=  $tres;
        $digito .= $cuatro;
        if(isset($_SESSION['reg_email']['aleatorio'])){
            if(!empty($_SESSION['reg_email']['aleatorio'])){
                if($_SESSION['reg_email']['aleatorio'] == $digito){
                    $_SESSION['reg_email']['validar'] = true;
                    echo "<script>window.location.href='../../index.php?seccion=datos_registro'</script>";
                }else{
                    $_SESSION['reg_email']['validar'] = false;
                    echo "<script>window.location.href='../../index.php?seccion=validar_email'</script>";
                }
            }else{
                $_SESSION['rta'] = "error";
                echo "<script>window.location.href='../../index.php?seccion=cita'</script>";
            }
        }else{
            $_SESSION['rta'] = "error";
            echo "<script>window.location.href='../../index.php?seccion=cita'</script>";
        }
}else{
    echo 'no existe post';
    $_SESSION['rta'] = "error";
    echo "<script>window.location.href='../../index.php?seccion=cita'</script>";
}
?>