<section class="">
<!-- cita(elige servicio)==>
(crea la sesion de cita donde guarda)==>citauser(se debe identificar el ussuario con correo)==>validaremail(se valida el email y  se guarad en las sessioncita.,  aqui se envia el codigo  al correo==>citaemail(AQUI 	va  a pedir el codigo )==>codigoemail.php(aqui s evalida si le codigo es correcto delemail, y comprueba si exsten las sesione santeriores, para luego seguir pidiendo datos.)==>) -->
    <div class="h1__box">
        <!-- hace que se ejecute js para que se  actove el radio cuando s ele da click a la caja -->
        <input type="hidden" class="form_radio">
            <h1 class="poster__description--h1 poster__description--h1--canva h1__cita"><span class="poster__description--span poster__description--h1--canva h1__cita">A</span><span class="poster__description--span2 poster__description--h1--canva h1__cita">genda</span><br>una cita con nosotros</h1>
    </div>
    <form class="form form__cita" action="contenidos/acciones/cita.php" method="post">
        <div class="form__header form__header--cita">
            <!-- <a href="">
                <img class="left" src="assets/images/rght.png" alt="flecha">
            </a> -->
            <img class="form__header--img" src="assets/images/logolarge.png" alt="">
            <div>
                
            </div>
        </div>
        <div class="form__body">    
                <h2 class="form__h2 poster__description--h1" >Elige el servicio</h2>
                <!-- <span class="form__span" >¿Tienes una cuenta? <a class="form--text form--text1" href="index.php?seccion=login">Iniciar Sesion</a></span> -->
                <!-- <p class="form__body--p">Para agendar tu cita con nosotros es necesario  que te identifiques, por favor ingresa tu numero de celular para registrarte, si ya tienes una cuenta, por favor <a class="form--text form--text1 a_cita" href="index.php?seccion=login">inicia sesion</a>.
                </p> -->
                <div class="formJs form__radio">
                   Consulta General
                    <input type="radio" id="" name="citaS" value="consulta general"  <?php echo $resultado =  $_SESSION['cita']['servicio'] == 'consulta general' ? 'checked' : ''; ?> />
                </div>
                <div class="formJs form__radio">
                    Peluqueria
                    <input type="radio" id="" name="citaS" value="peluqueria" <?php echo $resultado =  $_SESSION['cita']['servicio'] == 'peluqueria' ? 'checked' : ''; ?>/>
                </div>
                <div class="formJs form__radio">
                    Vacunacion
                    <input type="radio" id="" name="citaS" value="vacunacion" <?php echo $resultado =  $_SESSION['cita']['servicio'] == 'vacunacion' ? 'checked' : ''; ?>/>
                </div>
      
             
                    <input class="bottom__form bottom bottom--orange bottom__serv" type="submit" value="Continuar">
            
                <div class="box__label">
                    <label class="enlace"><input required class="enlace__terminos" type="checkbox" id="" value="">Acepto <a class="enlace enlace__form" href="index.php?seccion=static&cual=terminos y condiciones">Terminos y  Condiciones</a></label>
                </div>
                <a class="" href="">
                    <div class="form__boxayuda">
                        <img class="form__boxayuda--img" src="assets/images/whatsapp.png" alt="whatsapp">
                        <p class="form__boxayuda--p enlace">¿Necesitas <br> ayuda?</p>
                    </div>
                </a>          
        </div>
    </form>
</section>
