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
    //este escript  es para añadir cita medica a paciente de un usuario
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
<form enctype="multipart/form-data" class="form contact-form" action="contenidos/usuarios/acciones/addcita.php?idP=<?php echo $idP;?>" method="post">
        <div class="form__header">
            <!-- <a href="">
                <img class="left" src="assets/images/rght.png" alt="flecha">
            </a> -->
            <img class="form__header--img" src="assets/images/logolarge.png" alt="imagen logo">
            <div>
            </div>
        </div>
        <div class="form__body">    
                <h2 class="form__h2" >Agrega Nueva Cita a <?php echo $nombre; ?></h2>
                <p>Fecha de Cita:</p>
                <input name="fechaA" class="input" type="datetime-local" value="" placeholder="fecha INvalida" required>
                <p>Descripcion</p>
                <textarea placeholder="Descripcion" name="descripcion" rows="10" cols=""></textarea>
                <div class="bottom box__bottom box__bottom--login">
                    <input id="submit" class="" type="submit" value="Continuar">        
                </div>
    </form>