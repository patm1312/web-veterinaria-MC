<form enctype="multipart/form-data" class="form contact-form" action="contenidos/publicaciones/acciones/addM.php" method="post">
        <div class="form__header">
            <img class="form__header--img" src="assets/images/logolarge.png" alt="imagen logo">
            <div>
            </div>
        </div>
        <div class="form__body">  
                <h2 class="form__h2" >Datos de Mascota:</h2>
                <p>Nombre de mascota:</p>
                <input name="tittle" class="input" type="name"  placeholder="Titulo de Publicacion" title="Nombre Invalido" pattern="[a-zA-Z ]{1,40}$" required>
                <p>
                    Especie:<br>
                    <input type="radio" name="especie" value="gato"> Gato<br>
                    <input type="radio" name="especie" value="perro"> Perro
                </p>
                <p>Raza de mascota:</p>
                <input name="raza" class="input" type="name"  placeholder="raza mascota" title="Raza Invalida" pattern="[a-zA-Z ]{1,40}$" required>
                <p>Fecha Nacimiento:</p>
                <input name="fechaN" class="input" type="datetime-local" required>
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
                <div id="input_file" class="">
                    <p>Sube una foto:</p>
                    <input class="" id="archivoDefault" type="file" name="imagen[]" accept=".png, .jpg, .jpeg" tittle="La imagen debe ser cuadrada como minimo">
                    <span class="messaje_form" id="span_input--default"></span>
                </div>
                <div class="bottom box__bottom box__bottom--login">
                    <input id="submit" class="" type="submit" value="Continuar">        
        </div>
    </form>