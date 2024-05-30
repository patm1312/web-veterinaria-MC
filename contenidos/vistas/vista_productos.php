<?php
 $enlace = $_SERVER['HTTP_REFERER'];
 $accion_enlace;
 $dominio = strstr($enlace, "admin");
 if($dominio){
    //echo 'encontro admin';
    if($var_accion_producto){
        $accion_enlace_add = 'index.php?seccion=AdminProductos&accion=addProducto';
        $accion_enlace_path = 'index.php?seccion=AdminProductos&accion=editarProducto';
    }else{
        
    }
    $imagen_oferta = '../assets/iconos/oferta.png';
    $path_imagen_producto;
 }else{
    //echo 'estoy  en la pagina index';
    $accion_enlace_path = 'index.php?seccion=producto';
    $imagen_oferta = 'assets/iconos/oferta.png';
    $path_imagen_producto = 'admin/';
 }
 while ($rowProductos = $stmtProd->fetch(PDO::FETCH_ASSOC)){
    $id = $rowProductos["idproductos"];
    $accion_enlace = $accion_enlace_path . '&idProd=' .  $id;
    $descuento = $rowProductos["descuento"];
    $imagen_producto =  $path_imagen_producto . $rowProductos['foto'];
?>
<div class="description_service--box">
        <img class="oferta__descuento--img" src="<?php echo $imagen_oferta; ?>" alt="oferta">
        <p class="oferta__descuento poster__description--h1" >
        <?php echo $descuento;?><br>
        </p>
        <span class="oferta__descuento--dto">D.to</span>
    <a class="enlace_producto" href="<?php echo $accion_enlace; ?>">
        <div class="description_services--img">
            <img class="img_preview-poster" src="<?php echo $imagen_producto; ?>" alt="imagen">
        </div>
            <div class="description_services--descr">
                <h2 class="h2_producto nav__itemp nav__item--color"><?php echo $rowProductos['nombre']; ?></h2>
                <p class="p_posterPreview poster__description--h1"><?php echo $rowProductos['descripcion']; ?></p>
                <h2 class="precio nav__itemp nav__item--products nav__item--color"><?php echo $rowProductos['precio']; ?></h2>
            </div>
    </a>
   
</div>

<?php

 }
        if(($_SESSION['nivel_usuario'] == 'administrador') && ($dominio) && ($var_accion_producto)){
?>
<div class="description_service--box">
    <a href="<?php echo $accion_enlace_add; ?>"> 
        <div class="description_services--img">
            <img class="img_preview-poster" src="contenidos/productos/assets/default/mas.png" alt="añadir">
        </div>
            <div class="description_services--descr">
                <h2 class="nav__item nav__item--products nav__item--color">Añadir Producto</h2>
            </div>
    </a>
   
</div>
<?php
        }
?>