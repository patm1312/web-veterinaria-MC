<?php

// try {
//     //code...
//     include('function/function.php');
// } catch (\Throwable $th) {
//     echo $th;
// }
//pagina quese envia a travez de get cuando plso sobre la numeracion de  lapagina al final. (pag.1, pag.2 ...)
$pagina_actual = isset( $_GET['p'] ) ? $_GET['p'] : 1;
$cantPorPagina = 6;
//devuelve la cantidad de usuarios 
$cTextos2 = "SELECT COUNT(idpublicaciones) AS TOTAL FROM publicaciones WHERE categoria = 'Pservicio' AND estado=1";
$stmt2 = $pdo->prepare($cTextos2);
// Especificamos el fetch mode antes de llamar a fetch()
$stmt2->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
try {
    $stmt2->execute();
} catch (\Throwable $th) {
    echo $th;
}

$row2 = $stmt2->fetch();
$cantResultados = $row2['TOTAL'];
//cuantas paginas son que debo mostar de acuerdo  a la cantidad de usuarios dividido  entre la cantidad por pagina que quiero mostrar
$cantPaginas = ceil($cantResultados / $cantPorPagina);
if( $pagina_actual > $cantPaginas ){
	$pagina_actual = $cantPaginas;
}
if( $pagina_actual < 1 ){
	$pagina_actual = 1;
}
$dondeInicio = ($pagina_actual - 1) * $cantPorPagina;
$cTextos = <<<SQL
SELECT 
	*
FROM
    publicaciones
WHERE categoria = ?
AND estado=1
LIMIT $dondeInicio, $cantPorPagina

SQL;

$categoria = 'Pservicio';
$stmt = $pdo->prepare($cTextos);
// Especificamos el fetch mode antes de llamar a fetch()
$stmt->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
try {
    $stmt->execute([$categoria]);
    //code...
} catch (\Throwable $th) {
    echo $th;
}
?>

<section class="container">
    <div class="h1__box">
        <img class="h1__box--img" src="assets/images/word.png" alt="logo">
        <h1 class="h1">Conozca Nuestros Productos y  Servicios</h1>
    </div>
    <div class="servicios">
        <?php
$variable = 0;
            while ($row = $stmt->fetch()){ 
                $variable += 1;
                
                  $id = $row['idpublicaciones'];
        ?>
        <div class="servicios__box">
            <div class="servicios__img--box">
                <img class="servicios__img " src="admin/<?php echo $row['foto'];?>" alt="perro">

            </div>
            <div class="servicios__box--container">
                <h2 class="h2 h2--servicios "><?php echo $row['titulo'];?></h2>
                <div class="box__preview">
                    <p class="preview poster__description--h1">
                        <?php 
                            $descripcion = $row['descripcion'];
                            //echo  $descripcion;
                             $preview = recortar_cadena($descripcion, 150);
                              echo $preview;
                        ?></p>
                </div>
                    <a class="bottom bottom--servicios bottom--orange" href="index.php?seccion=servicio&id=<?php echo $id; ?>">Saber Mas</a>
                
            </div>
        </div>
        <?php
            }
            ?>
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
                // http://localhost/veterinaria/admin/index.php?seccion=AdminUsuarios
				echo "href='index.php?seccion=servicios&p=$i'>pág. $i</a></li>";
			};
        ?>	
	    </ul>
	</div>
	<?php 
	endif; 	
    ?>
</section>