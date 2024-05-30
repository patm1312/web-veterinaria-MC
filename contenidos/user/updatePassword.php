<section>
<div class="h1__box">
            <h1 class="poster__description--h1 poster__description--h1--canva h1__cita"><span class="poster__description--span poster__description--h1--canva h1__cita">C</span><span class="poster__description--span2 poster__description--h1--canva h1__cita">ambio</span><br>de Contraseña</h1>
    </div>
    <form class="form contact-form" action="contenidos/user/acciones/updatePassword.php" method="post">
        <div class="form__header">
            <!-- <a href="">
                <img class="left" src="assets/images/rght.png" alt="flecha">
            </a> -->
            <img class="form__header--img" src="assets/images/logolarge.png" alt="">
            <div>
                
            </div>
        </div>
        <div class="form__body">    
                <h2 class="form__h2" >Actualiza tu contraseña</h2>
                <!-- <span class="form__span" >¿Eres nuevo? <a class="form--text form--text1 enlace" href="index.php?seccion=logout"> Registrate</a></span> -->
                <!-- <p class="form__body--p">Para agendar tu cita con nosotros es necesario  que te identifiques, por favor ingresa tu numero de celular para registrarte, si ya tienes una cuenta, por favor <a class="form--text form--text1 a_cita" href="index.php?seccion=login">inicia sesion</a>.
                </p> -->
                <!-- <input class="input" type="text" placeholder="Ingresa tu correo"> -->
               <div class="password_show">
                    <input id="contrasenia" name="password" class="show_password input input_one" type="password" placeholder="contraseña" title="La contraseña debe tener al entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula. Puede tener otros símbolos"
                        pattern="^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$" required>
                        <img class="img_show"  src="../assets/iconos/show.png" alt="">
                </div>
                <input id="confirm__contrasenia" name="confirmpassword" class="input" type="password" placeholder="contraseña" title="La contraseña debe coincidir, tener al entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula. Puede tener otros símbolos"
                    pattern="^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$" required>
                    <input class="submit bottom__form bottom bottom--orange bottom__serv" type="submit" value="Continuar">
                <!-- <span class="form__span form__span-password" ><a class="form--text form--text1 enlace" href="index.php?seccion=logadd">Recuperar contraseña</a></span> -->
                <a class="" href="">
                    <div class="form__boxayuda">
                        <img class="form__boxayuda--img" src="assets/images/whatsapp.png" alt="whatsapp">
                        <p class="form__boxayuda--p">¿Necesitas <br> ayuda?</p>
                    </div>
                </a>          
        </div>
    </form>
</section>