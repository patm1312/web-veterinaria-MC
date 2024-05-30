<?php
session_start();
$nombreU;
if(isset($_SESSION['cita']['nombre'])){
    if(!empty($_SESSION['cita']['nombre'])){
        $nombreU = $_SESSION['cita']['nombre'];
    }
}
?>
<section class="">
    <div class="h1__box">
            <h1 class="poster__description--h1 poster__description--h1--canva h1__cita"><span class="poster__description--span poster__description--h1--canva h1__cita">A</span><span class="poster__description--span2 poster__description--h1--canva h1__cita">genda</span><br>una cita con nosotros</h1>
    </div>
    <form class="form contact-form" action="contenidos/acciones/validarEcita.php" method="post">
        <div class="form__header form__header--cita">
          <!-- <a href="">
                <img class="left" src="assets/images/rght.png" alt="flecha">
            </a> -->
            <img class="form__header--img" src="assets/images/logolarge.png" alt="">
            <div>
                
            </div>
        </div>
        <?php
    if(isset($_SESSION['cita']['email'])){
        $email = $_SESSION['cita']['email'];
    }else{
       // echo 'no existe  servicio';
    }
       
    ?>
        <div class="form__body">    
                <h2 class="form__h2 poster__description--h1" >Identificate</h2>
                <span class="form__span" >¿Tienes una cuenta? <a class="form--text form--text1 enlace enlace__form" href="index.php?seccion=login">Iniciar Sesion</a></span>
                <p class="form__p poster__description--h1">Para agendar tu cita con nosotros es necesario  que te identifiques, por favor ingresa tu correo electronico para registrarte, si ya tienes una cuenta, por favor <a class="enlace enlace__form" href="index.php?seccion=login">inicia sesion</a>.
                </p> 
                <input name="nombre" class="input" type="text" placeholder="Ingresa tu nombre" value="<?php echo $resultado = empty($nombreU) ? $_SESSION['cita']['nombre'] : $nombreU; ?>">
                <input value="<?php echo $telefono; ?>" name="phone" class="input" type="tel" placeholder="telefono" title="numero incorrecto" pattern="^3[012]\d{8}$" required>
                <input name="email" class="input" type="email" placeholder="email" title="Email incorrecto"
                    pattern="[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-])+@[a-zA-Z0-9]([^@&%$\/\(\)=?¿!\.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?" value="<?php echo $email; ?>" required>
                    <input class="bottom__form bottom bottom--orange bottom__serv" type="submit" value="Continuar">
                <!-- <div class="box__label">
                    <label class=""><input class="" type="checkbox" id="" value="">Acepto <a class="" href="">Terminos y  Condiciones</a></label>
                </div> -->
                <a class="" href="">
                    <div class="form__boxayuda">
                        <img class="form__boxayuda--img" src="assets/images/whatsapp.png" alt="whatsapp">
                        <p class="form__boxayuda--p enlace">¿Necesitas <br> ayuda?</p>
                    </div>
                </a>          
        </div>
    </form>
</section>
