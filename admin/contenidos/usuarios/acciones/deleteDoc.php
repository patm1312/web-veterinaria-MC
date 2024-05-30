<?php
    if(isset($_GET['idH'])){

                $c = "UPDATE HistorialMedico set documentos=NULL, fechaUpdate=now() WHERE idHistorialMedico=:idH";
                $historia =  $_GET['idH'];
                $fileUp =  $_GET['file'];
                try {
                    $stmt2 = $pdo->prepare($c);
                    // Especificamos el fetch mode antes de llamar a fetch()
                    $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                    // Ejecutamos

                    $stmt2->bindParam(':idH', $historia, PDO::PARAM_STR);
                    $stmt2->execute();
                } catch (\Throwable $th) {
                    echo $th;
                }

                $count = $stmt2->rowCount();
                if($count > 0){

                    $_SESSION['rta_admin'] = "ok_form";
                    try {
                        $ruta = 'contenidos/usuarios/assets/documents';
                        $patron = '/contenidos/usuarios/assets/documents/';
                        $fileE = substr($fileUp,37);
                        //elimino la img del servidor
                        $ruta .= $fileE;
                    if( unlink($ruta)){
                        //echo 'true';
                    }else{
                        //echo 'false';
                    }
                    } catch (\Throwable $th) {
                        echo $th;
                    }
                    echo "<script>window.location.href='index.php?seccion=AdminUsuarios'</script>";
                }else{
                $_SESSION['rta_admin'] = "error";
                echo "<script>window.location.href='index.php?seccion=AdminUsuarios'</script>";
                }
                
    }else{
        $_SESSION['rta_admin'] = "error";
        echo "<script>window.location.href='index.php?seccion=AdminUsuarios'</script>";
        
    }

?>