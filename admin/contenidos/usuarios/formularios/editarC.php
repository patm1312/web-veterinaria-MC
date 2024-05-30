<?php
//script editar cita
    if(isset($_GET['idC']) && isset($_GET['idPc'])){
        $dato_consultaCita = $_GET['idC'];
        $idpaciente = $_GET['idPc'];
    }else{
        $_SESSION['rta_admin'] == 'DateNull';
        echo "<script>window.location.href='../../../index.php?seccion=AdminPublicaciones&accion=editarpS'</script>";
    }
    //consulto la bd con la publicacion a la que quiero editar para autocomplear en el formulario:
    $c = "SELECT * FROM CitasPacientes WHERE pacientes_idpacientes =:idPc AND idcita=:idC";
    //preparar la consulta:
    try {
            $stmt = $pdo->prepare($c);
        // Especificamos el fetch mode antes de llamar a fetch()
        //uso metodo execute con el metodo array para vincular el parametro a consultar:
        $stmt->execute(array(":idPc" => $idpaciente, ":idC" => $dato_consultaCita));
        // $row = $stmt->fetch();
        $p = $stmt->fetchAll();
    } catch (\Throwable $th) {
        echo $th;
    }

     foreach($p as $r){
             $nombre =  $r->nombre;
             $descripcion =  $r->descripcion;
             $fechaCita =  $r->fechaCita;
             $fechaAlta =  $r->fechaAlta;
             $exito =  $r->exito;
             $estado =  $r->estado;
            }
?>
<input type="hidden" id="homeAdmin">
<form enctype="multipart/form-data" class="form contact-form" action="contenidos/usuarios/acciones/updateCita.php?idC=<?php echo $dato_consultaCita;?>&idPc=<?php echo $idpaciente;?>" method="post">
        <div class="form__header">
            <!-- <a href="">
                <img class="left" src="assets/images/rght.png" alt="flecha">
            </a> -->
            <img class="form__header--img" src="assets/images/logolarge.png" alt="imagen logo">
            <div>
            </div>
        </div>
        <div class="form__body">    
                <h2 class="form__h2" >Datos de Cita:</h2>
                <p>Edita su Solicitud:</p>
                <input name="name" class="input" type="text" value=" <?php echo $nombre; ?>" placeholder="Titulo de Publicacion" title="Titulo  Invalido" pattern="[a-zA-Z ]{1,40}$" required>
                <p>Edita descripcion de cita:</p>
                <textarea placeholder="Descripcion" name="textarea" rows="10" cols=""><?php echo $descripcion; ?></textarea>
                <p>Edita fecha de cita:</p>
                <input name="fechaC" class="input" type="datetime-local" value="<?php echo $fechaCita; ?>" placeholder="fecha INvalida">
                <div class="bottom box__bottom box__bottom--login">
                    <input id="submit" class="" type="submit" value="Continuar">        
                </div>
    </form>