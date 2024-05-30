<?php
session_start();
try {
    //code...
    include('../../configuracion/conexion.php');
} catch (\Throwable $th) {
    echo $th;
}
if(isset($_POST['email'])){
    if(!empty($_POST['email'])){
        $email = $_POST['email'];
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
        if($row){
                    
            $_SESSION['rta'] = "y__user";
            echo "<script>window.location.href='../../index.php'</script>";
            //echo 'ningun susuario';
        }else{
            $numeroAleatorio = mt_rand(1000, 9999);
            $_SESSION['reg_email']['aleatorio'] = $numeroAleatorio;
            //enviar info al correo:
            $to = $email;
            $subject = "!Enhorabuena¡ Completa tu  registro con MUndo  Canino";
            $headers = 'Por favor ingresa el siguiente codigo de confirmacion en el formulario: '  . $numeroAleatorio ;
            //Esta es la función que envía el correo 
            try {
            mail($to, $subject, $message, $headers);
            $_SESSION['reg_email']['email'] = $email;
            echo "<script>window.location.href='../../index.php?seccion=validar_email'</script>";
                //code...
            } catch (\Throwable $th) {
                echo $th;
            }
        
        }
        
        }else{
           $_SESSION['rta'] = "error";
            echo "<script>window.location.href='../index.php'</script>";
        }
}else{
    $_SESSION['rta'] = "error";
    echo "<script>window.location.href='../index.php'</script>";
}

?>