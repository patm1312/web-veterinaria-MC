<form enctype="multipart/form-data" class="form contact-form" action="contenidos/publicaciones/acciones/addP.php" method="post">
        <div class="form__header">
            <!-- <a href="">
                <img class="left" src="assets/images/rght.png" alt="flecha">
            </a> -->
            <img class="form__header--img" src="assets/images/logolarge.png" alt="imagen logo">
            <div>
            </div>
        </div>
        <div class="form__body">  
                <h2 class="form__h2" >Datos de Publicacion:</h2>
                <p>Elige un titulo corto para tu nueva publicacion:</p>
                <input name="tittle" class="input" type="name"  placeholder="Titulo de Publicacion" title="Titulo  Invalido" pattern="^.{0,45}$+" required>
               
                <p>Elige una descripcion acorde  para tu nueva publicacion:</p>
                <textarea placeholder="Descripcion" name="textarea" rows="10" cols=""></textarea>

                <div id="input_file" class="">
                    <p>Elige una imagen acorde  para tu nueva publicacion:</p>
                    <input class="" id="archivoDefault" type="file" name="imagen[]" accept=".png, .jpg, .jpeg" tittle="La imagen debe ser cuadrada como minimo" required >
                    <span class="messaje_form" id="span_input--default"></span>
                </div>
                <div class="">
                    
                    <div>
                        <label>
                            <input name="cbox_slider" type="checkbox" id="slider" value="slider" />Elige una imagen (opcional) acorde  para tu nueva publicacion, esta se cargara en la seccion de slider, como  en la imagend e abajo:
                        </label>
                    </div>
                    
                    <img src="./contenidos/publicaciones/assets/default/slider.png" alt="imgSlider">
                    <input class="" id="archivoSlider" type="file" name="imagen[]" accept=".png, .jpg, .jpeg" tittle="formato de imagen  debe ser rectangular como minimo">
                    <span class="messaje_form" id="span_input--slider"></span>
                </div>
                <div class="bottom box__bottom box__bottom--login">
                    <input id="submit" class="" type="submit" value="Continuar">        
        </div>
    </form>