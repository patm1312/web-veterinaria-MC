<?php
session_start();
     if (isset($_SESSION['user_id'])) {
        //header("Location: ../veterinaria/index.php?set=1");
         //header("Location: .$/veterinaria/index.php");
         //header("Location: http://localhost/veterinaria/index.php?set=1");
         echo "<script>window.location.href='/veterinaria/index.php?set=1'</script>";
         
       }
        //si esta seteado el serverreferer pues vo a laurl que estaba pero si no existe pues voy al index.php:
        $_SESSION['referer'] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER']:'../index.php';
       
?>
<section class="">
    <div class="h1__box">
            <h1 class="poster__description--h1 poster__description--h1--canva h1__cita"><span class="poster__description--span poster__description--h1--canva h1__cita">L</span><span class="poster__description--span2 poster__description--h1--canva h1__cita">ogueate</span><br>aqui</h1>
    </div>
    <form class="form contact-form" action="formularios/login.php" method="post">
        <div class="form__header">
            <!-- <a href="">
                <img class="left" src="assets/images/rght.png" alt="flecha">
            </a> -->
            <img class="form__header--img" src="assets/images/logolarge.png" alt="">
            <div>
                
            </div>
        </div>
        <div class="form__body">    
                <h2 class="form__h2 poster__description--h1" >Iniciar Sesion</h2>
                <span class="form__span poster__description--h1" >¿Eres nuevo? <a class="form--text form--text1 enlace poster__description--h1 enlace__form" href="index.php?seccion=logout"> Registrate</a></span>
                
                <input name="email" class="input" type="email" placeholder="Ingresa tu correo" title="Email incorrecto" pattern="[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-])+@[a-zA-Z0-9]([^@&%$\/\(\)=?¿!\.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?" required>
                <input name="password" class="input " type="password" placeholder="Ingresa tu contraseña" required >
                <!-- <div class="bottom box__bottom box__bottom--login"> -->
                    <!-- <a class="bottom bottom__big--a bottom__big bottom--orange bottom__serv" href="index.php?seccion=servicio&id=<?php echo $idP; ?>">Agendar Cita</a>
                    <input class=" bottom box__bottom box__bottom--login" type="submit" value="Continuar">
                </div> -->
                <input class="bottom bottom__big--a bottom__big bottom--orange " type="submit" value="Continuar">
                <span class="form__span form__span-password" ><a class="form--text form--text1 enlace poster__description--h1 enlace__form" href="index.php?seccion=logadd">Recuperar contraseña</a></span>
                <a class="" href="">
                    <div class="form__boxayuda">
                        <img class="form__boxayuda--img" src="assets/images/whatsapp.png" alt="whatsapp">
                        <p class="form__boxayuda--p">¿Necesitas <br> ayuda?</p>
                    </div>
                </a>          
        </div>
    </form>
</section>