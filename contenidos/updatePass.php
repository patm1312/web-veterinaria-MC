<?php
if((!empty($_SESSION['validar_pass']['validar'])) && ($_SESSION['validar_pass']['validar'] == true)){

}else{
    $_SESSION['rta_admin'] = "error";
    //secho 'no valido, validar no es true';
    echo "<script>window.location.href='../index.php'</script>";
}
?>
<section class="">
    <div class="h1__box">
            <h1 class="poster__description--h1 poster__description--h1--canva h1__cita"><span class="poster__description--span poster__description--h1--canva h1__cita">A</span><span class="poster__description--span2 poster__description--h1--canva h1__cita">ctualiza</span><br>aqui tu contraseña:</h1>
    </div>
    <form class="form contact-form" action="contenidos/acciones/updatePass.php" method="post">
        <div class="form__header">
            <!-- <a href="">
                <img class="left" src="assets/images/rght.png" alt="flecha">
            </a> -->
            <img class="form__header--img" src="assets/images/logolarge.png" alt="">
            <div>
                
            </div>
        </div>
        <div class="form__body">    
                <!-- <h2 class="form__h2 poster__description--h1" >Iniciar Sesion</h2>
                <span class="form__span poster__description--h1" >¿Eres nuevo? <a class="form--text form--text1 enlace poster__description--h1 enlace__form" href="index.php?seccion=logout"> Registrate</a></span> -->
                
                <!-- <input name="email" class="input" type="email" placeholder="Ingresa tu correo" title="Email incorrecto" pattern="[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-])+@[a-zA-Z0-9]([^@&%$\/\(\)=?¿!\.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?" required> -->
                <div class="password_show">
                    <input id="contrasenia" name="password" class="show_password input input_one" type="password" placeholder="contraseña" title="La contraseña debe tener al entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula. Puede tener otros símbolos"
                        pattern="^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$" required>
                        <img class="img_show"  src="../assets/iconos/show.png" alt="">
                </div>
                <input id="confirm__contrasenia" name="confirmpassword" class="input" type="password" placeholder="contraseña nueva" title="La contraseña debe coincidir,  tener al entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula. Puede tener otros símbolos"
                    pattern="^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$" required>
                <!-- <div class="bottom box__bottom box__bottom--login"> -->
                    <!-- <a class="bottom bottom__big--a bottom__big bottom--orange bottom__serv" href="index.php?seccion=servicio&id=<?php echo $idP; ?>">Agendar Cita</a>
                    <input class=" bottom box__bottom box__bottom--login" type="submit" value="Continuar">
                </div> -->
                <input class="submit bottom bottom__big--a bottom__big bottom--orange " type="submit" value="Continuar">
                <!-- <span class="form__span form__span-password" ><a class="form--text form--text1 enlace poster__description--h1 enlace__form" href="index.php?seccion=logadd">Recuperar contraseña</a></span> -->
                <a class="" href="">
                    <div class="form__boxayuda">
                        <img class="form__boxayuda--img" src="assets/images/whatsapp.png" alt="whatsapp">
                        <p class="form__boxayuda--p">¿Necesitas <br> ayuda?</p>
                    </div>
                </a>          
        </div>
    </form>
</section>