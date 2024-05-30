<?php
session_start();
include('../../configuracion/conexion.php');
                    $nameMasc;
                    $especieMasc;
                    $pacienteVet;
?>
<?php
if((isset($_POST['fechaC']))){
        $fechaFormateada;
    if((!empty($_POST['fechaC'])) ){
        $fechaC = $_POST['fechaC'];
         $fechaH = $_POST['hora'];
        $fechaM = $_POST['min'];
        $fechaCita = $fechaC . ' ' . $fechaH . ':' . $fechaM . ':' . '00';
        if(isset($_POST['inputFormatoDate'])){
            $fechaFormateada = $_POST['inputFormatoDate'];
        }else{
            //echo 'no eiste ';
        };
        $email = $_SESSION['cita']['correo'];
        echo 'correo es ' . $email;
        if(($_SESSION['cita']['validar'] == true)){
            $mascota = $_SESSION['cita']['mascota'];
            echo 'id es: ' . $mascota;
            //consulta nombre de paciente:
            $cTextosMascotaName = <<<SQL
            SELECT 
                nombre , especie
            FROM
                pacientes
            WHERE idpacientes=?
            SQL;
            $stmtName = $pdo->prepare($cTextosMascotaName);
            // Especificamos el fetch mode antes de llamar a fetch()
            //$stmt->fetch(PDO::FETCH_ASSOC);
            $stmtName->setFetchMode(PDO::FETCH_ASSOC);
            // Ejecutamos
              try {
                $stmtName->execute([$mascota]);
               
                //code...
            } catch (\Throwable $th) {
                echo $th;
            }
               
               while ($rowName = $stmtName->fetch()){
                    echo 'nombre ' . $rowName["nombre"];
                    echo 'especie ' . $rowName["especie"];
                     if($rowName["nombre"] != null){
                        $pacienteVet = $rowName["nombre"];
                    }else{
                        $pacienteVet = $rowName["especie"];
                    }
               }
           
            echo 'paciente es : '.$pacienteVet;
            //se envia informacion al correo electronico y  se verifica si la fehca esa disponible, is es asi, se envia al usuario la fehc de cita al correo electronico, y  se muestra el mensaje ne pantalla llevandolo  al index.php, despues de subir a la db, al ususario le envio un correo y  al cliente un mensaje en whatsap con lso datos:
            $nombre = $_SESSION['cita']['nombre'];
            $mascota = $_SESSION['cita']['mascota'];
            $telefono = $_SESSION['cita']['telefono'];
            $idUser = $_SESSION['cita']['id_usuario'];
            $motivo = $_SESSION['cita']['motivo'];
            $c = "INSERT INTO cita (fechaAlta, fechaCita, pacientes_idpacientes, descripcion, estado) VALUES(NOW(), :fechaC, :paciente, :motivo, 1)";
            $stm = $pdo->prepare($c);
            //ejecutar la consulta:
            echo 'fecha de cita es : ' .  $fechaCita;
            $stm->bindParam(':fechaC', $fechaCita, PDO::PARAM_STR);
            $stm->bindParam(':paciente', $mascota, PDO::PARAM_STR);
            $stm->bindParam(':motivo', $motivo, PDO::PARAM_STR);
            try {
                $stm->execute();
                //code...
            } catch (\Throwable $th) {
                echo $th;
            }
            $lastInsertId = $pdo->lastInsertId();
            if($lastInsertId > 0){
            $to = $_SESSION['cita']['correo'];
            echo 'email enviado a : ' . $to;
                $subject = "!Felicidades, para nuestro equipo de trabajo es un gusto poder atenderte!, creaste una cita para tu mascota";
                $message = "La fecha de la cita  para tu " . $pacienteVet  .  " es para el :" . $fechaFormateada . "motivo: " . $motivo;
                $headers = 'Desde Veterinaria Mundo Canino';
                
                //Esta es la función que envía el correo 
                try {
                $envio = mail($to, $subject, $message, $headers);
                if($envio){
                    echo 'envio exito';
                }else{
                    echo 'no envio';
                }
                    //code...
                } catch (\Throwable $th) {
                    echo $th;
                }
             //aqui va el codigo para el whatsap
                
                
                
                
                //echo "<script>window.location.href='../../index.php?seccion=cita'</script>";
                
                unset($_SESSION['cita']);
            }else{
                $_SESSION['rta_admin'] = "error";
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
}else{
    $_SESSION['rta_admin'] = "error";
    echo "<script>window.location.href='../../index.php?seccion=cita'</script>";
}
?>