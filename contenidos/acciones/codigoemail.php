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
        $digito .= $dos;
        $digito .= $tres;
        $digito .= $cuatro;
        if(isset($_SESSION['cita']['aleatorio'])){
            if(!empty($_SESSION['cita']['aleatorio'])){
                $NumeroAleatorio = $_SESSION['cita']['aleatorio'];
                unset($_SESSION['cita']['aleatorio']);
                if($NumeroAleatorio == $digito){
                    $_SESSION['cita']['validar'] = true;
                                        $email =  $_SESSION['cita']['correo'];
                    $c = "INSERT INTO usuarios ( nombre, email,clave,fechaAlta) VALUES(:nombre, :email, :clave, NOW())";
                    try {
                        //preparar la consulta:
                        $stm = $pdo->prepare($c);
                        //ejecutar la consulta:
                        //vincular los dats con bimparams(recomendado):
                        //primer argumento es el argumento  que especifico  en la consulta, el segundo parametro es la variable recibida  en el formuario, y  el tercer parametro es el tipo  de dato(PDO::PARAM_STR(es dato string)):
                        $stm->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                        $stm->bindParam(':email', $email, PDO::PARAM_STR);
                        $stm->bindParam(':clave', $password_encrypt, PDO::PARAM_STR);
                            //ejecutar la consulta:
                            $stm->execute();
                            
                    
                    } catch (PDOException $exception) {
                        
                    }
                }else{
                    $_SESSION['cita']['validar'] = false;
                    echo "<script>window.location.href='../../index.php?seccion=cita__email'</script>";
                }
            }
        }
        if((!empty($_SESSION['cita']['validar'])) && ($_SESSION['cita']['validar'] == true)){
            $lastInsertId = $pdo->lastInsertId();
            if($lastInsertId > 0){
                $_SESSION['cita']['id_usuario'] = $lastInsertId;
                echo "<script>window.location.href='../../index.php?seccion=cita__datos'</script>";
            }else{
                $_SESSION['rta_admin'] = "error";
                //echo 'no inserto';
                echo "<script>window.location.href='../../index.php?seccion=cita'</script>";
            };
        }else{
            $_SESSION['rta_admin'] = "error";
            echo "<script>window.location.href='../../index.php?seccion=cita'</script>";
        }
}else{
    $_SESSION['rta_admin'] = "error";
    echo "<script>window.location.href='../../index.php?seccion=cita'</script>";
}
?>