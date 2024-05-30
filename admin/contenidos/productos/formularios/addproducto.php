
<form enctype="multipart/form-data" class="form contact-form" action="contenidos/productos/acciones/addProducto.php" method="post">
        <div class="form__header">
            <img class="form__header--img" src="assets/images/logolarge.png" alt="imagen logo">
            <div>
            </div>
        </div>
        <div class="form__body">  
                <h2 class="form__h2" >Datos del producto:</h2>

                <p>Elige un nombre para el producto:</p>
                    <input name="tittle" class="input" type="name"  placeholder="nombre del producto" title="nombre invalido" pattern="^.{0,45}$" required>

                <p>Elige la marca del producto:</p>
                    <input name="marca" class="input" type="name"  placeholder="marca del producto" title="marca invalida" pattern="^.{0,45}$" required>

                <p>Elige un precio para el producto:</p>
                    <input name="price" class="input" type="text"  placeholder="precio" title="precio invalido debe ser como 20.000" pattern="^[0-9]{1,3}(?:\.[0-9]{3})*(?:,[0-9]{1,2})?$" required>

                <p>Elige un descuento para el producto: (opcional)</p>
                    <input name="descuento" class="input" type="text"  placeholder="descuento " title="Descuento invalido,  debe ser como 20%" pattern="^(-)?\d{1,2}(\.\d{1,2})?%$" required>

                <p>Elige un color para el producto: (opcional)</p>
                    <input name="color" class="input" type="text"  placeholder="color">
                <p>
                    Elige una categoria:<br>
                    <input type="radio" name="categoria" value="farmacia"> Farmacia<br>
                    <input type="radio" name="categoria" value="alimento"> Alimento<br>
                    <input type="radio" name="categoria" value="accesorios/juguetes"> Accesorios/juguetes<br>
                    <input type="radio" name="categoria" value="ropa"> Ropa
                 </p>
                <p>Elige una descripcion acorde  para tu nueva producto:</p>
                <textarea placeholder="Descripcion" name="textarea" rows="10" cols=""></textarea>

                <div id="input_file" class="">
                    <p>Elige una imagen acorde  para tu nueva producto:</p>
                    <input class="" id="archivoDefault" type="file" name="imagen[]" accept=".png, .jpg, .jpeg" tittle="La imagen debe ser cuadrada como minimo">
                    <span class="messaje_form" id="span_input--default"></span>
                </div>
                <div class="bottom box__bottom box__bottom--login">
                    <input id="submit" class="" type="submit" value="Continuar">        
        </div>
    </form>