<?php
    session_start();
    //si un usuario esta logueado no deberia ver esta pagina, ademas si un usuario no ha validado email, no deberia ver esta pagina:.
    $email;
    if (isset($_SESSION['user_id'])) {
        header('Location:index.php');
      }else if(isset($_SESSION['reg_email']['validar'])){
          $email =  $_SESSION['reg_email']['email'];
        if($_SESSION['reg_email']['validar'] == false){
            $_SESSION['rta'] = "error";
            echo "<script>window.location.href='../index.php'</script>";
        }
      }else{
        $_SESSION['rta'] = "error";
        echo "<script>window.location.href='../index.php'</script>";
      }
    if(isset($_SESSION['rta'])){
        if($_SESSION['rta'] = 'ok'){
            $message = "usuario creado satisfactoriamente";
            $clase = 'ok';
        }else{
            $message = "hubo un error en crear tu  cuente, por favor, intentalo  de nuveo";
            $clase = 'error';
        }
    }else{
        $message = "";
        $clase = '';
    }
    unset($_SESSION['rta']);
?>
<section class="">
    <div class="h1__box">
            <h1 class="poster__description--h1 poster__description--h1--canva h1__cita"><span class="poster__description--span poster__description--h1--canva h1__cita">LL</span><span class="poster__description--span2 poster__description--h1--canva h1__cita">ena</span><br>los siguientes datos:</h1>
    </div>
    <?php if(!empty($message)): ?>
        <p class="<?php echo $clase; ?>"><?php echo $message; ?></p>
    <?php endif; ?>
    
    <form class="form contact-form" action="formularios/registro.php" method="post">
        <div class="form__header">
            <!-- <a href="">
                <img class="left" src="assets/images/rght.png" alt="flecha">
            </a> -->
            <img class="form__header--img" src="assets/images/logolarge.png" alt="">
            <div>
                
            </div>
        </div>
        <div class="form__body">    
                <h2 class="form__h2 poster__description--h1" >Crea una cuenta</h2>
                <span class="form__span poster__description--h1" >¿Tienes una cuenta? <a class="form--text form--text1 poster__description--h1" href="index.php?seccion=login">Iniciar Sesion</a></span>
                <input name="email" class="input" type="email" placeholder="email" title="Email incorrecto"
                    pattern="[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-])+@[a-zA-Z0-9]([^@&%$\/\(\)=?¿!\.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?" required value="<?php echo $email; ?>" readonly>
                <!-- se pueden usar atributos para usar expresiones regulares para validar los inpiut  del formulario, es el atributo patern, donde en su valor pongo la expresion regular que quiero que cumpla el formulario, y con otroatributo llamado tittle , muestro el mensaje que quiero visualizar: -->
                <input name="name" class="input" type="text" placeholder="Nombre" title="Nombre sólo acepta letras y espacios en blanco" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" required>
                <input name="subname" class="input" type="text" placeholder="Apellido" title="Nombre sólo acepta letras y espacios en blanco" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" required>
                <input name="phone" class="input" type="tel" placeholder="telefono" title="numero incorrecto" pattern="[0-9]{7,10}" required>
                <div class="password_show">
                    <input id="contrasenia" name="password" class="show_password input input_one" type="password" placeholder="contraseña" title="La contraseña debe tener al entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula. Puede tener otros símbolos"
                        pattern="^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$" required>
                        <img class="img_show"  src="../assets/iconos/show.png" alt="">
                </div>
                <input id="confirm__contrasenia" name="confirmpassword" class="input" type="password" placeholder="confirmar contraseña" title="La contraseña debe Coincidir con la anterior, debe tener entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula. Puede tener otros símbolos"
                    pattern="^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$" required>
                    <input class="submit bottom bottom__big--a bottom__big bottom--orange " type="submit" value="Continuar">
                <div class="box__label">
                    <label class=""><input class="checkbox" type="checkbox" id="" value="" required >Acepto <a class="" href="index.php?seccion=static&cual=terminos y condiciones">Terminos y  Condiciones</a></label>
                </div>
                <a class="" href="">
                    <div class="form__boxayuda">
                        <img class="form__boxayuda--img" src="assets/images/whatsapp.png" alt="whatsapp">
                        <p class="form__boxayuda--p">¿Necesitas <br> ayuda?</p>
                    </div>
                </a>          
        </div>
    </form>
</section>

