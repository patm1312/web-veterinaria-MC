<?php
    //pagina quese envia a travez de get cuando plso sobre la numeracion de  lapagina al final. (pag.1, pag.2 ...)
    $search;
    if(isset($_POST['search']) || (isset($_SESSION['search']))){
        if((!empty($_POST['search'])) || (!empty($_SESSION['search']))){
            if(!empty($_POST['search'])){
                $search = $_POST['search'];
                $_SESSION['search'] = $search;
                $search = '%' . $search . '%';
            }
            if(!empty($_SESSION['search'])){
                $search = $_SESSION['search'];
                $search = '%' . $search . '%';
            }
            $_SESSION['search'] = $search;
            $cTextos2 = <<<SQL
                SELECT COUNT(idproductos) AS TOTAL FROM productos
                WHERE nombre LIKE :descripcion
                OR categoria LIKE :descripcion
                OR  precio LIKE :descripcion
                OR  descripcion LIKE :descripcion
            SQL;
        }else{
            $cTextos2 = <<<SQL
            SELECT COUNT(idproductos) AS TOTAL FROM productos WHERE estado=1
            SQL;
        }
    }else{
        $cTextos2 = <<<SQL
            SELECT COUNT(idproductos) AS TOTAL FROM productos WHERE estado=1
            SQL;
    }
try {
    $stmt2 = $pdo->prepare($cTextos2);
    // Especificamos el fetch mode antes de llamar a fetch()
    $stmt2->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    if(!empty($search)){
        $stmt2->bindParam(':descripcion', $search, PDO::PARAM_STR);
    }
    $stmt2->execute();
} catch (\Throwable $th) {
    echo $th;
}
    $row2 = $stmt2->fetch();
    $cantResultados = $row2['TOTAL'];
    $pagina_actual = isset( $_GET['p'] ) ? $_GET['p'] : 1;
    $cantPorPagina = 15;
    //cuantas paginas son que debo mostar de acuerdo  a la cantidad de usuarios dividido  entre la cantidad por pagina que quiero mostrar
    $cantPaginas = ceil($cantResultados / $cantPorPagina);
    if( $pagina_actual > $cantPaginas ){
        $pagina_actual = $cantPaginas;
    }
    if( $pagina_actual < 1 ){
        $pagina_actual = 1;
    }
    $dondeInicio = ($pagina_actual - 1) * $cantPorPagina;
?>
<div id="search" class="info__personal border_prueba--contenedor"> 
    <div class="producto">
        <div class="description_services">
            <?php
                // Ejecutamos
                if(isset($_POST['search']) || (isset($_SESSION['search']))){
                    if((!empty($_POST['search'])) || (!empty($_SESSION['search']))){
                        if(!empty($_POST['search'])){
                            $search = $_POST['search'];
                            $_SESSION['search'] = $search;
                        }
                        if(!empty($_SESSION['search'])){
                            $search = $_SESSION['search'];
                        }
                        $_SESSION['search'] = $search;
                        $search = '%' . $search . '%';
                        $cTextos = <<<SQL
                           SELECT 
                            * FROM productos
                            WHERE nombre LIKE :descripcion
                            OR categoria LIKE :descripcion
                            OR  precio LIKE :descripcion
                            OR  descripcion LIKE :descripcion
                            LIMIT $dondeInicio, $cantPorPagina
                        SQL;
                    }else{
                        $cTextos = <<<SQL
                            SELECT * FROM productos WHERE estado=1
                            LIMIT $dondeInicio, $cantPorPagina
                        SQL;
                    }
                }else{
                    $cTextos = <<<SQL
                        SELECT * FROM productos WHERE estado=1
                        LIMIT $dondeInicio, $cantPorPagina
                SQL;
                }
                try{
                $stmtProd = $pdo->prepare($cTextos);
                // Especificamos el fetch mode antes de llamar a fetch()
                $stmtProd->setFetchMode(PDO::FETCH_ASSOC);
                // Ejecutamos
                if(!empty($search)){
                    $stmtProd->bindParam(':descripcion', $search, PDO::PARAM_STR);
                    $stmtProd->bindParam(':descripcion', $search, PDO::PARAM_STR);
                    $stmtProd->bindParam(':descripcion', $search, PDO::PARAM_STR);
                }
                    $stmtProd->execute();
                    //code...
                } catch (\Throwable $th) {
                    echo $th;
                }

                if($stmtProd){
                    echo '<section class="container container__block">';
                    echo '<div class="description_services">';
                    //variable para este documento en especifico.
                    $var_accion_producto = true;
                    include("../contenidos/vistas/vista_productos.php");
                    echo '</div>';
                }else{
                    echo 'aqui aparecen los productos asociados a cada usuario';
                }
            ?>
        </div>
    </div>       
</div>
<?php 
    if( $cantPaginas > 1 ):
?>
        <div class="paginador">
            <ul class="paginador__ul">
            <?php 
                for( $i = 1; $i <= $cantPaginas; $i++ ){
                    echo "<li class='paginador__li'><a ";
                    if( $pagina_actual == $i ){
                        echo 'class="actual" ';
                    }
                    // echo "href='index.php?seccion=AdminUsuarios&p=$i'>pág. $i</a></li>";
                    echo "href='index.php?seccion=AdminProductos&p=$i'>pág. $i</a></li>";
                };
            ?>	
            </ul>
        </div>
        <?php 
        endif; 	
        ?>  