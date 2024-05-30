<?php
include('../configuracion/conexion.php');
 if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $url_anterior = $_SESSION['referer'];
    $records = $pdo->prepare('SELECT idusuario,nombre, email, clave, nivelUsuario FROM usuarios WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    //fect assoc es un array asociativo que almacena los datos de un usuario
    $results = $records->fetch(PDO::FETCH_ASSOC);
    //verifico la contraseña si no eta vacio los resultados de la consulta del login, comparando con los password de la bd  con la que me envio en el formulario de login.
    //password verify verifica la lave dl ususario, con laque envio  a travez del formulario(no en cryptada) con la de la base de datos que si esta encryptada.
    if($results){
        if (count($results) > 0 && password_verify($_POST['password'], $results['clave'] ) ) {
            //contraseña verificada
            //almaceno el id del usuario de la consulta en la sesion.
            $_SESSION['user_id'] = $results['idusuario'];
            $_SESSION['user_name'] = $results['nombre'];
            $_SESSION['user_subname'] = $results['email'];
            $_SESSION['nivel_usuario'] = $results['nivelUsuario'];
            $_SESSION['rta'] = "ok__session";
            echo "<script>window.location.href='$url_anterior'</script>";
        } else {
          $_SESSION['rta'] = "error__session";
          echo "<script>window.location.href='../index.php'</script>";
        }
    }else{
      $_SESSION['rta'] = "error__session";
       echo "<script>window.location.href='../index.php'</script>";
    }
    
  }
  if (isset($_SESSION['user_id'])) {
     echo "<script>window.location.href='../index.php'</script>";
  }
?>