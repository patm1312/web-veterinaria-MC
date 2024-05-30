<!-- <section class="">
    <form class="form" action="" method="">
        <div class="form__img">
            <img  src="assets/images/word.png" alt="">
        </div>
        <div class="form__box1">
            <h2 class="form--text">Recuperar Usuario</h2>
            <p class="form--text form--text-p form--text1"><a class="form--text form--text1" href="index.php?seccion=login">Iniciar Sesion</a></p>
            <p class="enlaces enlaces--loadd">Por favor ingresa tu  correo electronico  y  se te enviara un enlace para crear tu nueva contraseña</p>
        </div>
            <input class="input" type="text" placeholder="email">
            <input class="bottom bottom__form" type="submit">
</section> -->

<section class="">
    <div class="h1__box">
            <h1 class="poster__description--h1 poster__description--h1--canva h1__cita"><span class="poster__description--span poster__description--h1--canva h1__cita">R</span><span class="poster__description--span2 poster__description--h1--canva h1__cita">ecupera</span><br>tu cuenta</h1>
    </div>
    <form class="form contact-form" action="formularios/recuperar.php" method="post">
        <div class="form__header">
            <!-- <a href="">
                <img class="left" src="assets/images/rght.png" alt="flecha">
            </a> -->
            <img class="form__header--img" src="assets/images/logolarge.png" alt="">
            <div>
                
            </div>
        </div>
        <div class="form__body">    
                <h2 class="form__h2 poster__description--h1" >Recuperar Usuario</h2>
                <span class="form__span poster__description--h1" ><a class="form--text form--text1 enlace poster__description--h1 enlace__form" href="index.php?seccion=login">Iniciar Sesion</a></span>
                <!-- <p class="form__body--p">Para agendar tu cita con nosotros es necesario  que te identifiques, por favor ingresa tu numero de celular para registrarte, si ya tienes una cuenta, por favor <a class="form--text form--text1 a_cita" href="index.php?seccion=login">inicia sesion</a>.
                </p> -->
                <input name="email" class="input" type="email" placeholder="Ingresa tu correo" title="revisa tus datos" title="Email incorrecto" pattern="[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-])+@[a-zA-Z0-9]([^@&%$\/\(\)=?¿!\.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?" required>
               
                <input class=" box__bottom bottom bottom__big--a bottom__big bottom--orange " type="submit" value="Continuar">
                <!-- <span class="form__span form__span-password" ><a class="form--text form--text1" href="index.php?seccion=logout">Recuperar contraseña</a></span> -->
                <a class="" href="">
                    <div class="form__boxayuda">
                        <img class="form__boxayuda--img" src="assets/images/whatsapp.png" alt="whatsapp">
                        <p class="form__boxayuda--p">¿Necesitas <br> ayuda?</p>
                    </div>
                </a>          
        </div>
    </form>
</section>