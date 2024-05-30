<?php
include('../configuracion/conexion.php');
session_start();
if (!empty($_POST['email'])){
    echo $_POST['email'];
    $email = $_POST['email'];
    echo 'estoy en reuperar usuario';
    $cTextos = <<<SQL
            SELECT 
                *
            FROM
                usuarios
            WHERE email=:email
            SQL;
    $stmt = $pdo->prepare($cTextos);
    // Especificamos el fetch mode antes de llamar a fetch()
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if( $row){
        foreach ($row as $key => $value){
            $valor = $value['email'];
            echo 'valor es ' .  $valor;
            $_SESSION['validar_pass']['email'] = $valor;
            $numeroAleatorio = mt_rand(1000, 9999);
            //echo 'aqui no hay resultado, llevo  a el usuario a validar su cuenta de correo electronico';
            $_SESSION['validar_pass']['aleatorio'] = $numeroAleatorio;
            //enviar info al correo:
            $to = $email;
            $subject = "Hola, estas intentando recuperar contraseña a tu cuenta: ";
            $headers = "Por favor ingresa el siguiente codigo de confirmacion en el formulario: " . $numeroAleatorio . "si no hiciste esto, ignora este mensaje";
            //Esta es la función que envía el correo 
            try {
            mail($to, $subject, $message, $headers);
                //code...
            } catch (\Throwable $th) {
                echo $th;
            }
            echo "<script>window.location.href='../index.php?seccion=rec_user_v'</script>";
        }
    }else{
        $_SESSION['rta'] = "no__user";
        echo "<script>window.location.href='../index.php'</script>";
    }
}else{
    $_SESSION['rta'] = "error";
    echo "<script>window.location.href='../index.php'</script>";
}

?>