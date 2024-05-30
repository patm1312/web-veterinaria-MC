<?php
//script añadir mascota

?>
<input type="hidden" id="homeAdmin">
<form enctype="multipart/form-data" class="form contact-form" action="contenidos/user/acciones/addmasc.php" method="post">
        <div class="form__header">
            <!-- <a href="">
                <img class="left" src="assets/images/rght.png" alt="flecha">
            </a> -->
            <img class="form__header--img" src="assets/images/logolarge.png" alt="imagen logo">
            <div>
            </div>
        </div>
        <div class="form__body">    
                <h2 class="form__h2" >Datos de tu Mascota:</h2>
                <p class="poster__description--form">Nombre:</p>
                <input name="name" class="input" type="text" value="" placeholder="Nombre" title="nombre Invalido" pattern="[a-zA-Z ]{1,40}$" required>
                <p class="poster__description--form">Raza  de su mascota:</p>
                <input name="raza" class="input" type="text" value="" placeholder="Raza" title="raza Invalida" pattern="[a-zA-Z ]{1,40}$" required>
                <p class="poster__description--form">Color de su mascota:</p>
                <input name="color" class="input" type="text" value=" " placeholder="Color" title="color Invalido" pattern="[a-zA-Z ]{1,40}$" required>
                <p class="poster__description--form">Fecha Nacimiento:</p>
                <input name="fechaN" class="input" type="datetime-local" required>
                <p>
                <p class="parragraph_box poster__description--form">
                    
                    Especie:<br>
                    <input class="parragraph_box--input" type="radio" name="especie" value="gato"> Gato<br>
                    <input class="parragraph_box--input" type="radio" name="especie" value="perro"> Perro
                </p>
                <p class="parragraph_box poster__description--form">
                    sexo:<br>
                    <input class="parragraph_box--input"type="radio" name="sexo" value="Macho" >Macho<br>
                    <input class="parragraph_box--input" type="radio" name="sexo" value="Hembra" >Hembra
                </p>
                <p class="parragraph_box poster__description--form">
                    Talla:<br>
                    <input class="parragraph_box--input" type="radio" name="talla" value="pequeño">Pequeño<br>
                    <input class="parragraph_box--input" type="radio" name="talla" value="mediano">Mediano<br>
                    <input class="parragraph_box--input" type="radio" name="talla" value="grande">Grande
                </p>
                <p class="parragraph_box poster__description--form">
                    Esterilizado:<br>
                    <input class="parragraph_box--input"  type="radio" name="esterilizado" value="si">Si<br>
                    <input class="parragraph_box--input"  type="radio" name="esterilizado" value="no">No<br>
                </p>
                <div id="input_file" class="">
                    <p class="poster__description--form">Sube imagen de su mascota:</p>
                    <input class="" id="archivoDefault" type="file" name="imagen[]" accept=".png, .jpg, .jpeg" tittle="La imagen debe ser cuadrada como minimo">
                </div>
                    <input class="bottom__form bottom bottom--orange bottom__serv" type="submit" value="Continuar">
    </form>