<?php
session_start();
include('configuracion/conexion.php');
if((isset($_POST['producto']))){
    if((!empty($_POST['producto']))){
        //si hay alguna opcion que no esta vacio y  q ademas existe:
        $cTextosCantidadProd = "SELECT * FROM productos";
        $cTextosCantidadProd = $cTextosCantidadProd . ' WHERE ';

        $producto = isset($_POST['producto']) ? $_POST['producto']: $_SESSION['producto'];
        $_SESSION['producto'] = $producto;
        if($producto != ''){
            $filtro1 = " categoria=:producto AND ";
        }else{
            $filtro1 = '';
        }
        $filtros = $filtro1;
        //lo convierto en array para luego quitarekle el and que sobra al final
        $subC = explode(" ", $filtros);
        array_splice($subC, -2);
        $subCS = implode(" ", $subC); 
        $cTextosCantidadProd = $cTextosCantidadProd . $subCS;
        $cTextosCantidadProd = $cTextosCantidadProd . ' AND estado=1';
        $_SESSION['consultaProd'] = $cTextosCantidadProd;
        if($producto == 'todos'){
            $cTextosCantidadProd =  "SELECT * FROM productos WHERE estado=1";
            unset($_SESSION['consultaProd']);
        }
    }else{
        //cuando no tiene filtros hago una consulta general
        $cTextosCantidadProd = !empty($_SESSION['consultaProd']) ? $_SESSION['consultaProd']: "SELECT * FROM productos WHERE estado=1";
    }
}else{
    //cuando no tiene filtros hago una consulta general
    $cTextosCantidadProd = !empty($_SESSION['consultaProd']) ? $_SESSION['consultaProd']: "SELECT * FROM productos WHERE estado=1";
}
    //pagina quese envia a travez de get cuando plso sobre la numeracion de  lapagina al final. (pag.1, pag.2 ...)
    $pagina_actual = isset( $_GET['p'] ) ? $_GET['p'] : 1;
    $cantPorPagina = 9;
    try {
    $stmt2 = $pdo->prepare($cTextosCantidadProd);
    // Especificamos el fetch mode antes de llamar a fetch()
    $stmt2->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos, antes verificamos la informacion enviada o reservada en la session.
    $producto = isset($_POST['producto']) ? $_POST['producto']: $_SESSION['producto'];
    if($producto == 'todos'){
        $producto = '';
    }
    if($producto != ''){
        $stmt2->bindParam(':producto', $producto, PDO::PARAM_STR);
    }
    // Ejecutamos
        $stmt2->execute();
    } catch (\Throwable $th) {
        echo  $th;
    }
    $cantidad = 0;
    while ($rowCantp = $stmt2 ->fetch()){   
        $cantidad  += 1;
    }
    $cantResultados = $cantidad;
    //esta consulta anterior se da para verificar la cantidad de resultados devueltos por el filtro, para lograr haer el paginadr con esso filtros
    //cuantas paginas son que debo mostar de acuerdo  a la cantidad de usuarios dividido  entre la cantidad por pagina que quiero mostrar
    $cantPaginas = ceil($cantResultados / $cantPorPagina);
    if( $pagina_actual > $cantPaginas ){
        $pagina_actual = $cantPaginas;
    }
    if( $pagina_actual < 1 ){
        $pagina_actual = 1;
    }
    $dondeInicio = ($pagina_actual - 1) * $cantPorPagina;
    $limites = ' LIMIT '. $dondeInicio .', '. $cantPorPagina;
    //aqui se hace la consulta real para mostrar los resultados
    $cTextosCantidadProd = $cTextosCantidadProd . $limites;
$stmtProd = $pdo->prepare($cTextosCantidadProd);
// Especificamos el fetch mode antes de llamar a fetch()
$stmtProd->setFetchMode(PDO::FETCH_ASSOC);
if($producto == 'todos'){
    $producto = '';
}
if($producto != ''){
    $stmtProd->bindParam(':producto', $producto, PDO::PARAM_STR);
}
try {
    $stmtProd->execute();
} catch (\Throwable $th) {
    echo $th;
}
?>
<section class="container container__block">
    <input type="hidden" id="input_send_form">
    <input type="hidden" id="productos">
                 <h2 class="h2 h2--servicios bottom__gray">productos</h2>
                 <div class="tittle_productos">
                    <h2 class="info_result">Resultado de busqueda: <span class="info_result"><?php echo $cantidad; ?> productos encontrados</span></h2>
                    <form action="" method="post" class="filtro_productos">
                        <p class="poster__description--h1">
                            Ordenar:
                             <select class="select_filter" name="producto">
                                <option class="filter_prod filter_prod--all" <?php echo $resultado =  $_SESSION['producto'] == 'todos' ? 'selected' : ''; ?>>todos</option>
                                <option class="filter_prod" <?php echo $resultado =  $_SESSION['producto'] == 'alimento' ? 'selected' : ''; ?> >alimento</option>
                                <option class="filter_prod" <?php echo $resultado =  $_SESSION['producto'] == 'farmacia' ? 'selected' : ''; ?>>farmacia</option>
                                <option class="filter_prod"<?php echo $resultado =  $_SESSION['producto'] == 'accesorios/juguetes' ? 'selected' : ''; ?>>accesorios/juguetes</option>
                                <option class="filter_prod" <?php echo $resultado =  $_SESSION['producto'] == 'ropa' ? 'selected' : ''; ?>>ropa</option>
                            </select>
                        </p>
                        <!-- <input class="bottom bottom__aside modalClose" type="submit" value="Aplicar"> -->
                    </form>
                 </div>
                 <div class="description_services">

                 <?php
                // $cTextosProd = <<<SQL
                // SELECT * FROM productos
                // LIMIT $dondeInicio, $cantPorPagina
                // SQL;
                // try {
                // $stmtProd = $pdo->prepare($cTextosProd);
                // // Especificamos el fetch mode antes de llamar a fetch()
                // $stmtProd->setFetchMode(PDO::FETCH_ASSOC);
                // // Ejecutamos
               
                //     $stmtProd->execute();
                // } catch (\Throwable $th) {
                   
                //     echo $th;
                   
                // }
                // //$rowProd = $stmtProd->fetch();
                if($stmtProd){
                    include("contenidos/vistas/vista_productos.php");
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
                    echo "href='index.php?seccion=productos&p=$i'>pág. $i</a></li>";
                };
            ?>	
            </ul>
        </div>
        <?php 
        endif; 	
        ?>  
</section>