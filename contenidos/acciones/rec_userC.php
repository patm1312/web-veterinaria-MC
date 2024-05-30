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
        if(isset($_SESSION['validar_pass']['aleatorio'])){
            if(!empty($_SESSION['validar_pass']['aleatorio'])){
                if($_SESSION['validar_pass']['aleatorio'] == $digito){
                    $_SESSION['validar_pass']['validar'] = true;
                    //echo 'updatepaswr';
                    echo "<script>window.location.href='../../index.php?seccion=updatePassword'</script>";
                }else{
                    $_SESSION['validar_pass']['validar'] = false;
                    //echo 'recusercv';
                    echo "<script>window.location.href='../../index.php?seccion=rec_user_v'</script>";
                }
            }else{
                $_SESSION['rta'] = "error";
                echo "<script>window.location.href='../../index.php'</script>";
            }
        }else{
            $_SESSION['rta'] = "error";
            echo "<script>window.location.href='../../index.php'</script>";
        }
}else{
    echo 'no existe post';
    $_SESSION['rta'] = "error";
    echo "<script>window.location.href='../../index.php'</script>";
}
?>