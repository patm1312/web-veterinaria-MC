
<?php
    if(isset($_GET['idProd'])){
        $dato_consulta = $_GET['idProd'];
    }else{
        //no sale el mensaje
        $_SESSION['rta_admin'] == 'DateNull';
        echo "<script>window.location.href='../../../veterinaria/admin/index.php?seccion=AdminProductos'</script>";
    }
    //consulto la bd con la publicacion a la que quiero editar para autocomplear en el formulario:
    $c = "SELECT nombre, categoria, descripcion, precio, color, material, marca, foto, descuento,estado, espacio FROM productos WHERE idproductos=?";
    //preparar la consulta:
    try {
            $stmt = $pdo->prepare($c);
        // Especificamos el fetch mode antes de llamar a fetch()
        //uso metodo execute con el metodo array para vincular el parametro a consultar:
        $stmt->execute([$dato_consulta]);
        // $row = $stmt->fetch();
        $p = $stmt->fetchAll();
    } catch (\Throwable $th) {
        echo $th;
    }
    $nombre;
    $descripcion;
    $estado;
    $categoria;
    $foto;
    $precio;
    $color;
    $material;
    $marca;
    $descuento;
    $espacio;
     foreach($p as $r){
             $nombre =  $r->nombre;
             $descripcion =  $r->descripcion;
             $foto =  $r->foto;
             $categoria =  $r->categoria;
             $estado =  $r->estado;
             $precio =  $r->precio;
             $color =  $r->color;
             $material =  $r->material;
             $marca =  $r->marca;
             $descuento =  $r->descuento;
             $espacio =  $r->espacio;
            }
    $_SESSION['foto'] =  $foto;
?>
<input type="hidden" id="homeAdmin">
<form enctype="multipart/form-data" class="form contact-form" action="contenidos/productos/acciones/updateProducto.php?id=<?php echo $dato_consulta;?>" method="post">
        <div class="form__header">
            <img class="form__header--img" src="assets/images/logolarge.png" alt="imagen logo">
            <div>
            </div>
        </div>
        <div class="form__body">    
                <h2 class="form__h2" >Datos de Producto:</h2>

                <p>EDita el nombre del producto:</p>
                    <input value="<?php echo $nombre; ?>" name="tittle" class="input" type="name"  placeholder="nombre del producto" title="nombre invalido" pattern="^.{0,45}$" required >
                <p>Edita la marca del producto:</p>
                    <input value="<?php echo $marca; ?>" name="marca" class="input" type="name"  placeholder="marca del producto" title="marca invalida" pattern="^.{0,45}$" required>
                <p>Edita el  precio para el producto:</p>
                    <input value="<?php echo $precio; ?>" name="price" class="input" type="text"  placeholder="precio" title="precio invalido debe ser como 20.000" pattern="^[0-9]{1,3}(?:\.[0-9]{3})*(?:,[0-9]{1,2})?$" required>
                <p>Edita el descuento para el producto: (opcional)</p>
                    <input value="<?php echo $descuento; ?>" name="descuento" class="input" type="text"  placeholder="descuento " title="Descuento invalido,  debe ser como 20%" pattern="^(-)?\d{1,2}(\.\d{1,2})?%$" required>
                <p>Edita el color para el producto: (opcional)</p>
                    <input value="<?php echo $color; ?>" name="color" class="input" type="text"  placeholder="color">
                <p>
                    Edita la categoria:<br>
                    <input type="radio" name="categoria" value="farmacia" <?php echo $resultado =  $categoria == 'farmacia' ? 'checked' : ''; ?>> Farmacia<br>
                    <input type="radio" name="categoria" value="alimento" <?php echo $resultado =  $categoria == 'alimento' ? 'checked' : ''; ?>> Alimento<br>
                    <input type="radio" name="categoria" value="accesorios/juguetes" <?php echo $resultado =  $categoria == 'accesorios/juguetes' ? 'checked' : ''; ?>> Accesorios/juguetes<br>
                    <input <?php echo $resultado =  $categoria == 'ropa' ? 'checked' : ''; ?> type="radio" name="categoria" value="ropa"> Ropa
                 </p>
                 <p>
                    Espacio en carrusel de anuncios:<br>
                    <input type="radio" name="espacio" value="ad" <?php echo $resultado =  $espacio == 'ad' ? 'checked' : ''; ?>> Anuncios<br>
                    <input type="radio" name="espacio" value="none" <?php echo $resultado =  $espacio == 'none' ? 'checked' : ''; ?>>No<br>
                 </p>
                 
                 <p>Elige una descripcion acorde  para tu producto:</p>
                    <textarea placeholder="Descripcion" name="textarea" rows="10" cols="">
                    <?php echo $descripcion; ?>
                    </textarea>
                <div id="input_file" class="">
                    <p>Actualiza imagen de tu producto:</p>
                    <input class="" id="archivoDefault" type="file" name="imagen[]" accept=".png, .jpg, .jpeg" tittle="La imagen debe ser cuadrada como minimo">
                    <div>
                        <a href="" class="openImg">
                            <img class="openImg" src="contenidos/publicaciones/assets/default/img.png" alt="foto">
                            <!-- //aqu guardo la rutade la imagen para recuperarla, se puede mostar haciendo click en la imagen visualizar, se usa js. y readIumg.php abre la imagen. -->
                            <input  type="hidden" value="<?php echo $foto;?>">
                        </a>
                    </div>
                    <span class="messaje_form" id="span_input--default"></span>
                </div>
                <p>
                    Elimanar Producto:<br>
                    <input <?php echo $resultadoP =  $estado == 0 ? 'checked' : ''; ?> type="radio" name="eliminar" value="0"> Borrar<br>
                    <input <?php echo $resultadoP =  $estado == 1 ? 'checked' : ''; ?> type="radio" name="eliminar" value="1"> Conservar<br>
                 </p>
                <div class="bottom box__bottom box__bottom--login">
                    <input id="submit" class="" type="submit" value="Continuar">        
                </div>
    </form>