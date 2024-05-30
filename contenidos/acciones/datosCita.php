<?php
session_start();
include('../../configuracion/conexion.php');
?>
<?php
//si envia una especie de gato  o perro significa que va aregistrar una mascota
if(isset($_POST['mascota'])){
    if( !empty($_POST['mascota']) && (($_SESSION['cita']['validar'] == true)) ){
        $mascota = $_POST['mascota'];
        $motivo = $_POST['motivo'];
        if(($_SESSION['cita']['validar'] == true)){
            //aqui debo crear una mascota o paciente a ese usuario:
            $_SESSION['cita']['mascota'] = $mascota;
            $_SESSION['cita']['motivo'] = $motivo;
            $idUser = $_SESSION['cita']['id_usuario'];
            $c = "INSERT INTO pacientes ( especie, fechaAlta ,usuario_idusuario, estado) VALUES(:especie, NOW(),  :id_usuario, 1)";
            try {
                //preparar la consulta:
                $stm = $pdo->prepare($c);
                //ejecutar la consulta:
                //vincular los dats con bimparams(recomendado):
                //primer argumento es el argumento  que especifico  en la consulta, el segundo parametro es la variable recibida  en el formuario, y  el tercer parametro es el tipo  de dato(PDO::PARAM_STR(es dato string)):
                $stm->bindParam(':especie', $mascota, PDO::PARAM_STR);
                $stm->bindParam(':id_usuario', $idUser, PDO::PARAM_STR);
                    //ejecutar la consulta:
                    $stm->execute();
            
            } catch (PDOException $exception) {
                echo $exception;
            }
            $lastInsertId = $pdo->lastInsertId();
            if($lastInsertId > 0){
                $idPaciente = $lastInsertId;
                $c2 = "INSERT INTO planvacunacion (fechaAlta) VALUES( now())";
                $stm2 = $pdo->prepare($c2);
                try {
                    $stm2->execute();
                } catch (\Throwable $th) {
                    echo $th;
                }
                $lastInsertId2 = $pdo->lastInsertId();
                $idVacunacion = $lastInsertId2;
                if($lastInsertId2 > 0){
                    $c3 = "UPDATE pacientes set planvacunacion_idplanvacunacion=:idplanvacunacion WHERE idpacientes=:paciente";
                    $stm3 = $pdo->prepare($c3);
                    $stm3->bindParam(':idplanvacunacion', $idVacunacion, PDO::PARAM_STR);
                    $stm3->bindParam(':paciente', $idPaciente, PDO::PARAM_STR);
                    try {
                        $stm3->execute();
                    } catch (\Throwable $th) {
                        echo $th;
                    }
                $lastInsertId3 = $pdo->lastInsertId();
                }
                $c4 = "INSERT INTO PlanDesparacitacion (pacientes_idpacientes, fechaAlta) VALUES( :idpaciente, now())";
                $stm4 = $pdo->prepare($c4);
                $stm4->bindParam(':idpaciente', $idPaciente, PDO::PARAM_STR);
                try {
                    $stm4->execute();
                } catch (\Throwable $th) {
                    echo $th;
                }
                $_SESSION['cita']['mascota'] = $lastInsertId;
                echo "<script>window.location.href='../../index.php?seccion=cita__fecha'</script>";
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
}else if(isset($_POST['paciente'])){
    if( !empty($_POST['paciente']) && (($_SESSION['cita']['validar'] == true)) ){
        //en este caso recibo un id que corresponde a una mascota registrada de un usuario,  a esa mascota proximamanete le  creo una cita:s
        $IdMascota= $_POST['paciente'];
        $_SESSION['cita']['mascota'] = $IdMascota;
        $motivo= $_POST['motivo'];
        $_SESSION['cita']['motivo'] = $motivo;
        echo "<script>window.location.href='../../index.php?seccion=cita__fecha'</script>";
    }else{
        $_SESSION['rta_admin'] = "error";
        echo "<script>window.location.href='../../index.php?seccion=cita'</script>";
    }
}else{
    $_SESSION['rta_admin'] = "error";
    echo "<script>window.location.href='../../index.php?seccion=cita'</script>";
}
?>