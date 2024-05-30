<?php
if(isset($_GET['idProd'])){
    if(!empty($_GET['idProd'])){
        $id = $_GET['idProd'];
    }else{

    }
}else{

}
$cTextosProductos = <<<SQL
SELECT 
	*
FROM
    productos
 WHERE idproductos=?
SQL;
$stmtProd = $pdo->prepare($cTextosProductos);
// Especificamos el fetch mode antes de llamar a fetch()
$stmtProd->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
$stmtProd->execute([$id]);
//$productos = $stmtProd->fetchAll();
//var_dump($productos);
while ($rowProductos = $stmtProd->fetch()) {

    $precio = $rowProductos["precio"];
    $descuento = $rowProductos["descuento"];
    $img = $rowProductos["foto"];
    $id = $rowProductos["idproductos"];
    $descripcion = $rowProductos["descripcion"];
    $nombre = $rowProductos["nombre"];
    $color = $rowProductos["color"];
    $material = $rowProductos["material"];
    $marca = $rowProductos["marca"];
    $categoria = $rowProductos["categoria"];
?>
<section class="container container__block">
    <input type="hidden" id="producto">
    <div>
        <div class="categoria__producto">
            <p>inicio <span>/<?php echo $categoria; ?></span></p>
        </div>
        <!-- producto categoria varios -->
        <div class="producto producto__view">
            <div class="foto__producto responsiveDiv">
                <img class="foto" src="admin/<?php echo $img; ?>" alt="imagen">
            </div>
            <div class="descripcion__producto">
                <h2 class="h2 poster__description--h1 "><?php echo $nombre; ?></h2>
                <p class="nav__item nav__item--product nav__item--color"><?php echo $precio; ?></p>
                <p class="poster__description--h1 "><?php echo $descripcion; ?></p>
                <div class="talla">
                    <p class="bottom__gray">confirma el tamaño:</p>
                    <div class="medidas">
                    <input class="bottoms" type="submit" value="pequeño">
                    <input class="bottoms" type="submit" value="mediano">
                    <input class="bottoms" type="submit" value="grande">
                </div>
                <div>

                </div>
                <a class="lista_deseos" href="">
                        <img class="p__heart" src="assets/images/heart.png" alt="whatsapp">
                        <p class="p__lista">Guardar en mi lista</p>
                </a>
                <a class="ordenar__bottom" href="">
                    
                        <img class="form__boxayuda--img" src="assets/images/whatsapp.png" alt="whatsapp">
                        <p class="p__ordenar">Ordenar</p>
                    
                </a>
            </div>
            </div>
            
        </div>
        <div class="subsection">
            <h2 class="h2 h2--servicios">Descripcion:</h2>
            <p><?php echo $descripcion; ?></p>
            <div class="description--product">
                <h3 class="poster__description--h1">Color:</h3>
                <p class=""><?php echo $color; ?></p>
            </div>
            <div class="description--product">
                <h3 class="poster__description--h1">Material:</h3>
                <p><?php echo $material; ?></p>
            </div>
            <div class="description--product">
                <h3 class="poster__description--h1">Presentacion:</h3>
                <p>Material</p>
            </div>
            <div class="description--product">
                <h3 class="poster__description--h1">Marca:</h3>
                <p><?php echo $marca; ?></p>
            </div>
            <div class="description--product">
                <h3 class="poster__description--h1">Medidas tamaño pequeño:</h3>
                <ul>
                    <li>alto: xcm</li>
                    <li>largo: xcm</li>
                    <li>ancho: xcm</li>
                    <li>peso: xcm</li>
                </ul>
            </div>
            <div class="description--product">
                <h3 class="poster__description--h1">Medidas tamaño mediano:</h3>
                <ul>
                    <li>alto: xcm</li>
                    <li>largo: xcm</li>
                    <li>ancho: xcm</li>
                    <li>peso: xcm</li>
                </ul>
            </div>
            <div class="description--product">
                <h3 class="poster__description--h1">Medidas tamaño grande:</h3>
                <ul>
                    <li>alto: xcm</li>
                    <li>largo: xcm</li>
                    <li>ancho: xcm</li>
                    <li>peso: xcm</li>
                </ul>
            </div>
            
            </div>
    </div>
    <div class="subsection">
        <h2 class="h2 h2--servicios">Productos Relacionados</h2>
        <div class="description_services">
            <?php

            $cTextosProductos = <<<SQL
            SELECT 
                *
            FROM
                productos
             WHERE categoria=?
             LIMIT 0, 4
            SQL;
            $stmtProd = $pdo->prepare($cTextosProductos);
            // Especificamos el fetch mode antes de llamar a fetch()
            $stmtProd->setFetchMode(PDO::FETCH_ASSOC);
            // Ejecutamos
            $stmtProd->execute([$categoria]);
            //$productos = $stmtProd->fetchAll();
            //var_dump($productos);
            while ($rowProductos = $stmtProd->fetch()) {
                $precio = $rowProductos["precio"];
                $descuento = $rowProductos["descuento"];
                $img = $rowProductos["foto"];
                $id = $rowProductos["idproductos"];
                $descripcion = $rowProductos["descripcion"];
                $nombre = $rowProductos["nombre"];
                $color = $rowProductos["color"];
                $material = $rowProductos["material"];
                $marca = $rowProductos["marca"];
                $categoria = $rowProductos["categoria"];
            ?>
                    <div class="description_service--box">
                        <a class="enlace_producto" href="index.php?seccion=producto&idProd=<?php echo $id; ?>">
                            <div class="description_services--img">
                                <img class="img_preview-poster" src="admin/<?php echo $img; ?>" alt="imagen">
                            </div>
                                <div class="description_services--descr">
                                    <h2 class="h2_producto nav__item nav__item--color"><?php echo $nombre; ?></h2>
                                    <p class="p_posterPreview"><?php echo $descripcion; ?></p>
                                    <h2 class="precio nav__item nav__item--products nav__item--color"><?php echo $precio; ?></h2>
                                </div>
                        </a>  
                   </div>
            <?php
            };
            ?>
            </div>
    </div>
</section>
<?php
        };
?>