<?php
session_start();
$idUser;
$idMascota;
try {
include('../configuracion/conexion.php');
if(isset($_SESSION['cita']['id_usuario'])){
    if(!empty($_SESSION['cita']['id_usuario'])){
        $idUser = $_SESSION['cita']['id_usuario'];
        echo $idUser;
        $cTextosMascota = <<<SQL
    SELECT 
        *
    FROM
        pacientes
    WHERE estado=1 AND  usuario_idusuario =?
    SQL;
    $stmtM = $pdo->prepare($cTextosMascota);
    // Especificamos el fetch mode antes de llamar a fetch()
    //$stmt->fetch(PDO::FETCH_ASSOC);
    $stmtM->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
        $stmtM->execute([$idUser]);
        $rowM = $stmtM->fetchAll();
       
    }else{
        //echo 'esta vacio el id usuario';
        $_SESSION['rta_admin'] = "error";
        //echo "<script>window.location.href='../../index.php?seccion=cita'</script>";
    }
}else{
    $_SESSION['rta_admin'] = "error";
    echo "<script>window.location.href='../../veterinaria/index.php?seccion=cita'</script>";
}
} catch (\Throwable $th) {
    echo $th;
}
?>
<section class="">
    <div class="h1__box">
    <input type="hidden" class="form_radio">
            <h1 class="poster__description--h1 poster__description--h1--canva h1__cita"><span class="poster__description--span poster__description--h1--canva h1__cita">A</span><span class="poster__description--span2 poster__description--h1--canva h1__cita">genda</span><br>una cita con nosotros</h1>
    </div>
    <?php
    $nombreU;
    if(isset($_SESSION['cita']['nombre'])){
        if(!empty($_SESSION['cita']['nombre'])){
            $nombreU = $_SESSION['cita']['nombre'];
        }
    }
    ?>
    <form class="form" action="contenidos/acciones/datosCita.php" method="post">
        <div class="form__header form__header--cita">
            <!-- <a href="">
                <img class="left" src="assets/images/rght.png" alt="flecha">
            </a> -->
            <img class="form__header--img" src="assets/images/logolarge.png" alt="">
            <div>
                
            </div>
        </div>
        <div class="form__body">    
                <h2 class="form__h2 poster__description--h1" >Agenda en pocos pasos</h2>
                <!-- <span class="form__span" >¿Tienes una cuenta? <a class="form--text form--text1" href="index.php?seccion=login">Iniciar Sesion</a></span> -->
                <p class="form__p poster__description--h1">Por favor llena el  siguiente formulario para validar tu cuenta y asignar una cita a tu mascota<a class="enlace__form" href="index.php?seccion=login">inicia sesion</a>.
                </p>
                
                
                
                                <h3 class="h3__form poster__description--h1" >Elige tu mascota que tomara el servicio</h3>
<?php
 if (count($rowM) <= 0){
?>
                <div class="formJs form__radio">
                    Gato
                    <input type="radio" id="dog" name="mascota" value="gato" <?php echo $resultado =  $_SESSION['cita'][4] == 'gato' ? 'checked' : ''; ?>/>
                </div>
                <div class="formJs form__radio">
                    Perro
                    <input type="radio" id="cat" name="mascota" value="perro" <?php echo $resultado =  $_SESSION['cita'][0] == 'perro' ? 'checked' : ''; ?> />
                </div>
<?php
}else
?>
<div class="preview_paci">
<?php
{
    foreach ($rowM as $key => $value) {
        // echo '<br>';
        // echo $value["idpacientes"];
        // echo $value["nombre"];
         //echo $value["foto"];
        // echo '<br>';
        // echo ',';
?>

    <label id="label__<?php echo $value["idpacientes"]; ?>" class="preview_paci--box">
        <div class="preview_paciBox">
            <input id="<?php echo $value["idpacientes"]; ?>" class="preview_paci--input" type="radio" name="paciente" value="<?php echo $value["idpacientes"]; ?>">

            <img class="preview_paci--img" class="preview_pac--img" src="admin/<?php echo $value["foto"]; ?>" alt="imagen mascota" srcset="">
            <span class="preview_paci--span" class="preview_pac--span"><?php echo $value["nombre"]; ?></span>
        </div>

    </label><br>
<?php

    }
};

?>
                
                </div>
                <textarea name="motivo" id="motivo" cols="30" rows="10" placeholder="motivo consulta"><?php echo $_SESSION['cita']['motivo']; ?></textarea>
                <input class="bottom__form bottom bottom--orange bottom__serv" type="submit" value="Continuar">
                <a class="" href="">
                    <div class="form__boxayuda">
                        <img class="form__boxayuda--img" src="assets/images/whatsapp.png" alt="whatsapp">
                        <p class="form__boxayuda--p">¿Necesitas <br> ayuda?</p>
                    </div>
                </a>          
        </div>
    </form>
</section>
