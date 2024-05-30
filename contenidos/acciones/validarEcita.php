<?php
session_start();
include('../../configuracion/conexion.php');
if(isset($_POST['email'])){
    if(!empty($_POST['email'])){
        //se envia el codigo  al email y s eguarada el email  en la session
        $email = $_POST['email'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['phone'];
        $_SESSION['cita']['correo'] = $email;
        $_SESSION['cita']['telefono'] = $telefono;
        $_SESSION['cita']['nombre'] = $nombre;
        $cTextos2 = <<<SQL
        SELECT 
            *
        FROM
            usuarios
        WHERE
            email=:email
        SQL;
        try {
        $stmt2 = $pdo->prepare($cTextos2);
        // Especificamos el fetch mode antes de llamar a fetch()
        $stmt2->setFetchMode(PDO::FETCH_ASSOC);
        // Ejecutamos
      
        $stmt2->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt2->execute();
        } catch (\Throwable $th) {
        echo $th;
        }
        $row2 = $stmt2->fetch();
       
            $nombreU = $row2['nombre'];
        if(!$row2){
            $numeroAleatorio = mt_rand(1000, 9999);
            $to = $email;
            $subject = "!Felicidades!, Estas a punto de crear una cita para tu mascota:";
            $message = "Por favor ingresa el siguiente codigo de confirmacion para identificarte: " . $numeroAleatorio ;
            $headers = 'Desde Veterinaria Mundo Canino';
            
            //Esta es la función que envía el correo 
            try {
            mail($to, $subject, $message, $headers);
                //code...
            } catch (\Throwable $th) {
                echo $th;
            }
            $_SESSION['cita']['aleatorio'] = $numeroAleatorio;
            echo "<script>window.location.href='../../index.php?seccion=cita__email'</script>";
        }else{
            $_SESSION['cita']['nombre'] = $nombreU;
            $_SESSION['cita']['validar'] = true;
            $id_usuario = $row2['idusuario'];
            $_SESSION['cita']['id_usuario'] = $id_usuario;
            echo "<script>window.location.href='../../index.php?seccion=cita__datos'</script>";
        }
    }else{
        $_SESSION['rta_admin'] = "error";
        echo "<script>window.location.href='../../index.php?seccion=cita'</script>";
    }
}else{
    $_SESSION['rta_admin'] = "error";
    echo "<script>window.location.href='../../index.php?seccion=cita'</script>";
}

?>