<?php
    if(isset($_GET['id'])){
        $dato_consulta = $_GET['id'];
    }else{
        $_SESSION['rta_admin'] == 'DateNull';
        echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios&accion=editarUser&id=$dato_consulta'</script>";
    }
    //consulto la bd con la publicacion a la que quiero editar para autocomplear en el formulario:
    $c = "SELECT nombre, apellido, email, direccion,telefono,telefonosecundario,nivelUsuario,fechaAlta,fotoPortada, foto, estado FROM usuarios WHERE idusuario=?";
    //preparar la consulta:
    try {
            $stmt = $pdo->prepare($c);
        // Especificamos el fetch mode antes de llamar a fetch()
        //uso metodo execute con el metodo array para vincular el parametro a consultar:
        $stmt->execute([$dato_consulta]);
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
    echo '<br>';
    $_SESSION['foto'] =  $foto;
    $_SESSION['fotoP'] =  $fotoPortada;
?>
<input type="hidden" id="homeAdmin">
<form enctype="multipart/form-data" class="form contact-form" action="contenidos/usuarios/acciones/updateU.php?id=<?php echo $dato_consulta;?>" method="post">
        <div class="form__header">
            <img class="form__header--img" src="assets/images/logolarge.png" alt="imagen logo">
            <div>
            </div>
        </div>
        <div class="form__body">    
                <h2 class="form__h2" >Datos de Usuario:</h2>
                <p>Edita nombre de Usuario:</p>
                <input name="name" class="input" type="text" value=" <?php echo $nombre; ?>" placeholder="nombre de usuario" title="nombre Invalido Invalido" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" required>
                <p>Edita apellido de Usuario:</p>
                <input name="subname" class="input" type="text" value=" <?php echo $apellido; ?>" placeholder="Apellido de usuario" title="nombre Invalido Invalido" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" required>
                <p>No se puede editar:</p>
                <input name="email" class="input" type="email" placeholder="email" title="Email incorrecto"
                    pattern="[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-])+@[a-zA-Z0-9]([^@&%$\/\(\)=?¿!\.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?" value="<?php echo $email; ?>" required>
                <p>Edita telefono de Usuario:</p>
                <input value="<?php echo $telefono; ?>" name="phone" class="input" type="tel" placeholder="telefono" title="numero incorrecto" pattern="[0-9]{7,10}" required>
                <p>Edita telefono secundario de Usuario:</p>
                <input value="<?php echo $telefonosecundario; ?>" name="phone2" class="input" type="tel" placeholder="telefono" title="numero incorrecto" pattern="[0-9]{7,10}" required>
                <p>Edita direccion de Usuario:</p>
                <textarea placeholder="direccion" name="direccion" rows="10" cols=""><?php echo $direccion;?></textarea>
                <div id="input_file" class="">
                    <p>Actualiza imagen de tu perfil:</p>
                    <input class="" id="archivoDefault" type="file" name="imagen[]" accept=".png, .jpg, .jpeg" tittle="La imagen debe ser cuadrada como minimo">
                    <div>
                        <a href="" class="openImg">
                            <img class="openImg" src="contenidos/publicaciones/assets/default/img.png" alt="foto">
                            <!-- //aqu guardo la rutade la imagen para recuperarla, se puede mostar haciendo click en la imagen visualizar, se usa js. y readIumg.php abre la imagen. -->
                            <input  type="hidden" value="<?php echo $foto;?>">
                        </a>
                    </div>
                    <span class="messaje_form" id="span_input--default"></span>
                </div>
                <div id="input_file" class="">
                    <p>Actualiza imagen portada de tu perfil:</p>
                    <input class="" id="archivoPortada" type="file" name="imagen[]" accept=".png, .jpg, .jpeg" tittle="La imagen debe ser rectangular como minimo">
                    <div>
                        <a href="" class="openImg">
                            <img class="openImg" src="contenidos/publicaciones/assets/default/img.png" alt="foto">
                            <!-- //aqu guardo la rutade la imagen para recuperarla, se puede mostar haciendo click en la imagen visualizar, se usa js. y readIumg.php abre la imagen. -->
                            <input  type="hidden" value="<?php echo $fotoPortada;?>">
                        </a>
                    </div>
                    <span class="messaje_form" id="span_input--default"></span>
                </div>
                <div class="bottom box__bottom box__bottom--login">
                    <input id="submit" class="" type="submit" value="Continuar">        
                </div>
    </form>