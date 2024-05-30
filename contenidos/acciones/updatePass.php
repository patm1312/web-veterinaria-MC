<?php
include('../../configuracion/conexion.php');

if((!empty($_SESSION['validar_pass']['validar'])) && ($_SESSION['validar_pass']['validar'] == true)){
    if(isset($_POST['password'])){
        if(!empty($_POST['password'])){
                //funcion password hash, ver explicacion en word, parametrod, la clave que me llego, el metood o algoritmo par aencryptar y  el costo, que es el numero  de vecs que se genera una encryptacion sobre el resultado cada vez q se envia.
                $clave = $_POST['password'];
                $email = $_SESSION['validar_pass']['email'];
    $password_encrypt = password_hash($clave, PASSWORD_DEFAULT, ['cost' => 10] );
            $c = "UPDATE usuarios set clave=:password WHERE email=:email";
            $stm = $pdo->prepare($c);
            $stm->bindParam(':email', $email, PDO::PARAM_STR);
            $stm->bindParam(':password', $password_encrypt, PDO::PARAM_STR);
            $stm->execute();
              //Si el último identificador insertado es mayor que cero, la inserción funcionó.
              $count = $stm->rowCount();
              if($count > 0){
                $_SESSION['rta'] = "ok__cpassw";
                  unset($_SESSION['validar_pass']);
                  echo "<script>window.location.href='../../index.php?'</script>";
              }else{
                $_SESSION['rta'] = "error";
                  unset($_SESSION['validar_pass']);
                  echo "<script>window.location.href='../../index.php'</script>";
              }
        }
    }

}else{
    unset($_SESSION['validar_pass']);
    $_SESSION['rta'] = "error";
    //secho 'no valido, validar no es true';
    echo "<script>window.location.href='../index.php'</script>";
}

?>