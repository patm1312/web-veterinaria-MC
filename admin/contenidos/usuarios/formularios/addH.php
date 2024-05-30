<?php
$idP;
    if(isset($_GET['idP'])){
        if(!empty($_GET['idP'])){
            $idP = $_GET['idP'];
        }else{
            $_SESSION['rta_admin'] == 'DateNull';
            echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios&accion=addH'</script>";
        }
    }else{
        $_SESSION['rta_admin'] == 'DateNull';
        echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios&accion=addH'</script>";
    }
    //este escript  es para añadir historia medica a paciente de un usuario
    $c = "SELECT nombre FROM pacientes WHERE idpacientes=:idP";
    //preparar la consulta:
    try {
            $stmt = $pdo->prepare($c);
        // Especificamos el fetch mode antes de llamar a fetch()
        //uso metodo execute con el metodo array para vincular el parametro a consultar:
        $stmt->execute(array(":idP" => $idP));
        $p = $stmt->fetchAll();
    } catch (\Throwable $th) {
        echo $th;
    }
     foreach($p as $r){
             $nombre =  $r->nombre;
            }
?>
<input type="hidden" id="homeAdmin">
<form enctype="multipart/form-data" class="form contact-form" action="contenidos/usuarios/acciones/addH.php?idP=<?php echo $idP;?>" method="post">
        <div class="form__header">
            <!-- <a href="">
                <img class="left" src="assets/images/rght.png" alt="flecha">
            </a> -->
            <img class="form__header--img" src="assets/images/logolarge.png" alt="imagen logo">
            <div>
            </div>
        </div>
        <div class="form__body">    
                <h2 class="form__h2" >Agrega Nueva historia a <?php echo $nombre; ?></h2>

                <p>Diagnostico:</p>
                <textarea placeholder="Descripcion" name="diagnostico" rows="10" cols=""><?php echo $diagnostico; ?></textarea>
                <p>Hospitalizacion:</p>
                <textarea placeholder="Descripcion" name="hospitalizacion" rows="10" cols=""><?php echo $hospitalizacion; ?></textarea>
                <p>Prescripciones:</p>
                <textarea placeholder="Descripcion" name="prescripciones" rows="10" cols=""><?php echo $prescripciones; ?></textarea>
                <p>Fecha de ingreso:</p>
                <input name="fechaI" class="input" type="datetime-local" value="<?php echo $fechaIngreso; ?>" placeholder="fecha INvalida" required>
                <p>Fecha de alta de Mascota:</p>
                <input name="fechaA" class="input" type="datetime-local" value="<?php echo $fechaAlta; ?>" placeholder="fecha INvalida">
                <div id="input_file" class="">
                    <p>Agrega Documentos(Maximo 16Mb):</p>
                    <input class="" id="archivoDefault" type="file" name="document" accept="image/*,.pdf" tittle="debe ser documento en pdf">
                <div class="bottom box__bottom box__bottom--login">
                    <input id="submit" class="" type="submit" value="Continuar">        
                </div>
    </form>