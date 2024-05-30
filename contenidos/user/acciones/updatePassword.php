<?php
session_start();
include('../../../configuracion/conexion.php');
    if(isset($_POST['password'])){
        if(!empty($_POST['password'])){
                //funcion password hash, ver explicacion en word, parametrod, la clave que me llego, el metood o algoritmo par aencryptar y  el costo, que es el numero  de vecs que se genera una encryptacion sobre el resultado cada vez q se envia.
                $clave = $_POST['password'];
          $id = $_SESSION['user_id'];
    $password_encrypt = password_hash($clave, PASSWORD_DEFAULT, ['cost' => 10] );
            $c = "UPDATE usuarios set clave=:password WHERE idusuario=:id";
            $stm = $pdo->prepare($c);
            $stm->bindParam(':id', $id, PDO::PARAM_STR);
            $stm->bindParam(':password', $password_encrypt, PDO::PARAM_STR);
            $stm->execute();
              //Si el último identificador insertado es mayor que cero, la inserción funcionó.
              $count = $stm->rowCount();
              if($count > 0){
                $_SESSION['rta'] = "ok__cpassw";
                //eliminar la sesion
                  session_unset();
                //destruir la session
                  session_destroy();
                  echo "<script>window.location.href='../../../index.php?'</script>";
              }else{
                $_SESSION['rta'] = "error";
                  echo "<script>window.location.href='../../../index.php'</script>";
              }
        }else{
            $_SESSION['rta'] = "error";

            echo "<script>window.location.href='../../../index.php'</script>";
        }
    }else{
        $_SESSION['rta'] = "error";
        echo "<script>window.location.href='../../../index.php'</script>";
    }

?>