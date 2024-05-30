<?php
 if(isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];

 }else{
    $_SESSION['rta_admin'] == 'DateNull';
    echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios&accion=editarUser&id=$dato_consulta'</script>";
 }
    //consulto la bd con la publicacion a la que quiero editar para autocomplear en el formulario:
    $c = "SELECT nombre, apellido, email, direccion,telefono,telefonosecundario FROM usuarios WHERE idusuario=?";
    //preparar la consulta:
    try {
            $stmt = $pdo->prepare($c);
        // Especificamos el fetch mode antes de llamar a fetch()
        //uso metodo execute con el metodo array para vincular el parametro a consultar:
        $stmt->execute([$id]);
        // $row = $stmt->fetch();
        $p = $stmt->fetchAll();
    } catch (\Throwable $th) {
        echo $th;
    }
   $nombre;
   $apellido;
   $email;
   $direccion;
   $telefono;
   $telefonosecundario;
   $nivelUsuario;
   $fechaAlta;
   $fotoPortada;
   $foto;
   $estado;
     foreach($p as $r){
        $nombre =  $r->nombre;
        $apellido =  $r->apellido;
        $email  =  $r->email;
        $direccion  =  $r->direccion;
        $telefono  =  $r->telefono;
        $telefonosecundario  =  $r->telefonosecundario;
        $nivelUsuario  =  $r->nivelUsuario;
        $fechaAlta  =  $r->fechaAlta;
        $fotoPortada  =  $r->fotoPortada;
        $foto  =  $r->foto;
        $estado  =  $r->estado;
    }
   
?>
<input type="hidden" id="homeAdmin">
<form enctype="multipart/form-data" class="form contact-form" action="contenidos/user/acciones/updateUser.php?id=<?php echo $id;?>" method="post">
        <div class="form__header">
            <img class="form__header--img" src="assets/images/logolarge.png" alt="imagen logo">
            <div>
            </div>
        </div>
        <div class="form__body">    
                <h2 class="form__h2" >Datos de Usuario:</h2>
                <p class="poster__description--form">Edita nombre de Usuario:</p>
                <input name="name" class="input" type="text" value=" <?php echo $nombre; ?>" placeholder="nombre de usuario" title="nombre Invalido Invalido" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" required>
                <p class="poster__description--form">Edita apellido de Usuario:</p>
                <input name="subname" class="input" type="text" value=" <?php echo $apellido; ?>" placeholder="Apellido de usuario" title="nombre Invalido Invalido" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" required>
                <p class="poster__description--form">Email:</p>
                <input name="email" class="input" type="email" placeholder="email" title="Email incorrecto"
                    pattern="[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-])+@[a-zA-Z0-9]([^@&%$\/\(\)=?¿!\.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?" value="<?php echo $email; ?>" required>
                <p class="poster__description--form">Edita telefono de Usuario:</p>
                <input value="<?php echo $telefono; ?>" name="phone" class="input" type="tel" placeholder="telefono" title="numero incorrecto" pattern="[0-9]{7,10}" required>
                <p class="poster__description--form">Edita telefono secundario de Usuario:</p>
                <input value="<?php echo $telefonosecundario; ?>" name="phone2" class="input" type="tel" placeholder="telefono" title="numero incorrecto" pattern="[0-9]{7,10}" required>
                <p class="poster__description--form">Edita direccion de Usuario:</p>
                <input name="direccion" class="input" type="text" value=" <?php echo $direccion; ?>" placeholder="Direccion" required>
                                   <input class="bottom__form bottom bottom--orange bottom__serv" type="submit" value="Continuar">
    </form>