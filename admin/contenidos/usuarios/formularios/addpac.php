<section class="">
    <div class="h1__box">
            <h1 class="poster__description--h1 poster__description--h1--canva h1__cita"><span class="poster__description--span poster__description--h1--canva h1__cita">R</span><span class="poster__description--span2 poster__description--h1--canva h1__cita">egistra tu mascota </span><br>con Nosotros</h1>
    </div>
    <?php
$id = $_GET['id'];

?>
    <form enctype="multipart/form-data" class="form contact-form" action="contenidos/usuarios/acciones/addpac.php?id=<?php echo $id; ?>" method="post">
        <div class="form__header">
            <img class="form__header--img" src="assets/images/logolarge.png" alt="logo">
            <div>
                
            </div>
        </div>
        <div class="form__body">    
                <h2 class="form__h2" >Datos de Mascota</h2>
                <p>Nombre de mascota:</p>
                <input name="tittle" class="input" type="name"  placeholder="Titulo de Publicacion" title="Nombre Invalido" pattern="[a-zA-Z ]{1,40}$" required>
                <p>
                    Especie:<br>
                    <input type="radio" name="especie" value="gato"> Gato<br>
                    <input type="radio" name="especie" value="perro"> Perro
                </p>
                <p>Fecha Nacimiento:</p>
                <input name="fechaN" class="input" type="datetime-local" required>
                <!-- <input name="edadMes" class="input" type="text" pattern="^(0?[1-9]|1[0-2])$" placeholder="Meses" title="Mes invalido" required> -->

                <input name="color" class="input" type="name"  placeholder="Color" title="color invalido" pattern="[a-zA-Z ]{1,40}$" required>
                <p>
                    sexo:<br>
                    <input type="radio" name="sexo" value="Macho">Macho<br>
                    <input type="radio" name="sexo" value="Hembra">Hembra
                </p>
                <p>
                    Talla:<br>
                    <input type="radio" name="talla" value="pequeño">Pequeño<br>
                    <input type="radio" name="talla" value="mediano">Mediano<br>
                    <input type="radio" name="talla" value="grande">Grande
                </p>
                <p>
                    Esterilizado:<br>
                    <input type="radio" name="esterilizado" value="si">Si<br>
                    <input type="radio" name="esterilizado" value="no">No<br>
                </p>
                <input name="raza" class="input" type="text" placeholder="raza">
                <!-- <textarea name="caract" class="textarea" name="textarea" rows="5" cols="" placeholder="caraceristicas adicionales"></textarea> -->
                
                    <div id="input_file" class="">
                    <p>Sube una foto:</p>
                    <input class="" id="archivoDefault" type="file" name="imagen[]" accept=".png, .jpg, .jpeg" tittle="La imagen debe ser cuadrada como minimo">
                    <span class="messaje_form" id="span_input--default"></span>
                </div>
                <div class="bottom box__bottom box__bottom--login">
                    <input id="submit" class="" type="submit" value="Continuar">        
        </div>
                <div class="box__label">
                    <label class=""><input class="" type="checkbox" id="" value="">Acepto <a class="" href="">Terminos y  Condiciones</a></label>
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

