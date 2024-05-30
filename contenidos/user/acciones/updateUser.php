<?php
    include('../../../configuracion/conexion.php');
    //este scrip es para procesar los datos enviados por formulario para editar informacion de usuario: 
    $_SESSION['rta_admin'];
    //seguridad de la pagina.
    $maximo = 2 * 1024 * 1024; //Tamaño en MB
    if(isset($_SESSION['user_id'])){
        // if($_SESSION['nivel_usuario'] == 'administrador'){
        //     //echo "<script>window.location.href='/veterinaria/admin/index.php'</script>";
        // }else{
        //     //echo "No existe usuario administrador";
        //     $_SESSION['rta'] = 'noAutorizado';
        //     echo "<script>window.location.href='/veterinaria/index.php?seccion=perfil'</script>";
        // }
    }else{
        //echo "no existe usuario";
        $_SESSION['rta'] = 'noAutorizado';
        echo "<script>window.location.href='/veterinaria/index.php'</script>";
    }
    if(isset($_GET['id'])){
        if(!empty($_GET['id'])){
            $nombre = $_POST['name'];
            $apellido = $_POST['subname'];
            $telefono = $_POST['phone'];
            $telefono2 = $_POST['phone2'];
            $direccion = $_POST['direccion'];
            $id = $_GET['id'];
    
                    $c = "UPDATE usuarios set nombre=:nombre, apellido=:apellido, direccion=:direccion, telefono=:telefono, telefonosecundario=:telefonosecundario";
                   $c = $c .  " WHERE idusuario=:id";
                        try {
                            //preparar la consulta:
                            $stm = $pdo->prepare($c);
                            //ejecutar la consulta:
                            //vincular los dats con bimparams(recomendado):
                            //primer argumento es el argumento  que especifico  en la consulta, el segundo parametro es la variable recibida  en el formuario, y  el tercer parametro es el tipo  de dato(PDO::PARAM_STR(es dato string)):
                            $stm->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                            $stm->bindParam(':apellido', $apellido, PDO::PARAM_STR);
                            $stm->bindParam(':direccion', $direccion, PDO::PARAM_STR);
                            $stm->bindParam(':telefono', $telefono, PDO::PARAM_INT);
                            $stm->bindParam(':telefonosecundario', $telefono2, PDO::PARAM_INT );
                            $stm->bindParam(':id', $id);
                            //ejecutar la consulta:
                            $stm->execute();
                        } catch (PDOException $exception) {
                            echo $exception;
                        }
                        //Si el último identificador insertado es mayor que cero, la inserción funcionó.
                        $count = $stm->rowCount();
                        if($count > 0){
                            $_SESSION['rta_admin'] = "ok_form";
                            echo "<script>window.location.href='../../../index.php?seccion=perfil&seccionUser=home'</script>";
                        }else{
                            $_SESSION['rta_admin'] = "error";
                            echo "<script>window.location.href='../../../index.php?seccion=perfil&seccionUser=home'</script>";
                        }
            
        }else{
            $_SESSION['rta_admin'] = "error";
        echo "<script>window.location.href='../../../index.php?seccion=perfil&seccionUser=home'</script>";
        }
    }else{
        $_SESSION['rta_admin'] = "error";
        echo "<script>window.location.href='../../../index.php?seccion=perfil&seccionUser=home'</script>";
    }
   
?>