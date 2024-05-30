<?php
    include('../../../../configuracion/conexion.php');
    //este scrip es para eliminar una publicacion, es un borrado inteligente, no va a aestar activa al publicacion, pero no se va a viusalizar en las publicaciones en la web.: 
    $_SESSION['rta_admin'];
    //seguridad de la pagina:
    if(isset($_SESSION['user_id'])){
        if($_SESSION['nivel_usuario'] == 'administrador'){
            //echo "<script>window.location.href='/veterinaria/admin/index.php'</script>";
        }else{
            //echo "No existe usuario administrador";
            $_SESSION['rta'] = 'noAutorizado';
            //echo "<script>window.location.href='/veterinaria/index.php?seccion=perfil'</script>";
        }
    }else{
        //echo "existe usuario";
        $_SESSION['rta'] = 'noAutorizado';
        //echo "<script>window.location.href='/veterinaria/index.php'</script>";
    }

    if(isset( $_GET['idM'] ) && isset( $_GET['idU'] )){
        $estado = 0;
        $idM = $_GET['idM'];
        $idU = $_GET['idU'];
        $c = "UPDATE pacientes set estado=:estado, fechaAlta=now() WHERE idpacientes=:idM AND usuario_idusuario=:idU";
        $stm = $pdo->prepare($c);
        $stm->bindParam(':idM', $idM, PDO::PARAM_INT);
        $stm->bindParam(':idU', $idU, PDO::PARAM_INT);
        $stm->bindParam(':estado', $estado, PDO::PARAM_INT);
        //ejecutar la consulta:
        try {
            $stm->execute();
        } catch (\Throwable $th) {
            echo $th;
        }
                  //Si el último identificador insertado es mayor que cero, la inserción funcionó.
                  $count = $stm->rowCount();
                  if($count > 0){
                      $_SESSION['rta_admin'] = "ok_form";
                      echo "<script>window.location.href='index.php?seccion=AdminUsuarios'</script>";
                  }else{
                      $_SESSION['rta_admin'] = "error";
                      echo "<script>window.location.href='index.php?seccion=AdminUsuarios'</script>";
                  }
    }
?>
