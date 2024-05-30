<input type="hidden" id="AdminPublic">
<?php
//pagina quese envia a travez de get cuando plso sobre la numeracion de  lapagina al final. (pag.1, pag.2 ...)
$pagina_actual = isset( $_GET['p'] ) ? $_GET['p'] : 1;
$cantPorPagina = 15;
//devuelve la cantidad de usuarios 
$search;
//devuelve la cantidad de usuarios 
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
        $cTextos2 = <<<SQL
            SELECT COUNT(idPAdopta) AS TOTAL FROM PAdopta
            WHERE nombre LIKE :nombre 
        SQL;
    }else{
        $cTextos2 = "SELECT COUNT(idPAdopta) AS TOTAL FROM PAdopta WHERE estado=1";
    }
}else{
    $cTextos2 = "SELECT COUNT(idPAdopta) AS TOTAL FROM PAdopta WHERE estado=1";
}
$stmt2 = $pdo->prepare($cTextos2);
// Especificamos el fetch mode antes de llamar a fetch()
$stmt2->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
if(!empty($search)){
    $stmt2->bindParam(':nombre', $search, PDO::PARAM_STR);
}
try {
    $stmt2->execute();
    //code...
} catch (\Throwable $th) {
    echo  $th;
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
            *
        FROM
            PAdopta
        WHERE nombre LIKE :nombre
        LIMIT $dondeInicio, $cantPorPagina
        SQL;
    }else{
        $cTextos = <<<SQL
        SELECT 
            *
        FROM
            PAdopta WHERE estado=1
            LIMIT $dondeInicio, $cantPorPagina
        SQL;
    }
}else{
    $cTextos = <<<SQL
SELECT 
	*
FROM
    PAdopta WHERE estado=1
    LIMIT $dondeInicio, $cantPorPagina
SQL;
}
$stmt = $pdo->prepare($cTextos);
// Especificamos el fetch mode antes de llamar a fetch()
$stmt->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
if(!empty($search)){
    $stmt->bindParam(':nombre', $search, PDO::PARAM_STR);
}
try {
    $stmt->execute();
    //code...
} catch (\Throwable $th) {
    echo $th;
}





    // $cTextos2 = "SELECT COUNT(idPAdopta) AS TOTAL FROM PAdopta";
    // $stmt2 = $pdo->prepare($cTextos2);
    // // Especificamos el fetch mode antes de llamar a fetch()
    // $stmt2->setFetchMode(PDO::FETCH_ASSOC);
    // // Ejecutamos
    // $stmt2->execute();
    // $row2 = $stmt2->fetch();
    // $cantResultados = $row2['TOTAL'];
    // //cuantas paginas son que debo mostar de acuerdo  a la cantidad de usuarios dividido  entre la cantidad por pagina que quiero mostrar
    // $cantPaginas = ceil($cantResultados / $cantPorPagina);

    // if( $pagina_actual > $cantPaginas ){
    // 	$pagina_actual = $cantPaginas;
    // }
    // if( $pagina_actual < 1 ){
    // 	$pagina_actual = 1;
    // }

    // $dondeInicio = ($pagina_actual - 1) * $cantPorPagina;
    // $cTextos = <<<SQL
    // SELECT 
    // 	*
    // FROM
    //     PAdopta
    // LIMIT $dondeInicio, $cantPorPagina
    // SQL;
    // $stmt = $pdo->prepare($cTextos);
    // // Especificamos el fetch mode antes de llamar a fetch()
    // $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // // Ejecutamos
    // $stmt->execute();
?>
<div class="info__personal" id="search"> 
    <input type="hidden" id="homeAdmin">
    <a class="a__aniadirP" href="index.php?seccion=AdminPublicaciones&accion=addM">
        <div class='aniadir-publicacion'>
            <img class="aniadir-publicacion-img" src="../assets/images/mas.png" alt="mas">
            <p>Añadir Nueva Mascota</p>
        </div>
    </a>
    <div class="info__personal--info dog">
        <!-- //el id de la tabla corresponde a cada clase de el enlace de ver  que es un usuario, se identifica por un numero -->
        <div>
            <h1>LIstado  de Mascotas en Adopcion</h1>
            <table class='table--admin' ">
                <tr  class=''>
                    <th class='thVac--admin'>Numero</th>
                    <th class='thVac--admin'>nombre</th>
                    <th class='thVac--admin'>Especie</th>
                    <th class='thVac--admin'>Raza</th>
                    <th class='thVac--admin'>Edad</th>
                    <th class='thVac--admin'>Sexo</th>
                    <th class='thVac--admin'>Talla</th>
                    <th class='thVac--admin'>Esterilizado</th>
                    <th class='thVac--admin'>Color</th>
                    <th class='thVac--admin'>foto</th>
                    <th class='thVac--admin'>estado</th>
                    <th class='thVac--admin'>Acciones</th>
                </tr>
<?php
$numero = 0;

            while ($row = $stmt->fetch()){    
                $numero += 1;     
?>
                <tr class='trVac--admin'>
                    <td class='tdVac--admin' >
                        <a class="AdminPublic__<?php echo $row["idPAdopta"];  ?>">
                            <?php echo $row["idPAdopta"];  ?>
                        </a>
                    </td>
                    <td class='tdVac--admin' ><?php echo $row["nombre"];  ?></td>
                    <td class='tdVac--admin' ><?php echo $row["especie"];  ?></td>
                    <td class='tdVac--admin' ><?php echo $row["raza"];  ?></td>
                    <td class='tdVac--admin' >
                        
                        <?php
                         $fecha_nacimiento = $row["fechaNac"];
                         $e = busca_edad($fecha_nacimiento);
                                echo $e[0] . ' años ' . ' y ' .  $e[1]  . ' meses';  
                        ?>
                    </td>
                    <td class='tdVac--admin' ><?php echo $row["sexo"];  ?></td>
                    <td class='tdVac--admin' ><?php echo $row["talla"];  ?></td>
                    <td class='tdVac--admin' ><?php echo $row["esterilizado"];  ?></td>
                    <td class='tdVac--admin' ><?php echo $row["color"];  ?></td>
                    <td class='tdVac--admin' >
                        <a class="openImg" href="" >
                            <!-- //pongo el icono de una imagen, cuando el usuario  le di click se recupera la ruta guardada en el input oculto que se abre la imagen  -->
                            <img class="openImg" src="contenidos/publicaciones/assets/default/img.png" alt="preview">
                            <input  type="hidden" value="<?php echo $row['foto'];?>">
                        </a>
                    </td>
                    <td class='tdVac--admin' ><?php echo $row["estado"];  ?></td>
                    <td class='tdVac--admin' >
                        <div class="acciones__table">
                            <div class="acciones__table-editar" >
                                <a href="index.php?seccion=AdminPublicaciones&accion=editarm&id=<?php echo $row["idPAdopta"] ;?>">
                                    <img src="../assets/images/lapiz.png" alt="lapiz">
                                    
                                </a>
                                
                            </div>
                            <div class="acciones__table-eliminar" >
                                <a href="index.php?seccion=AdminPublicaciones&accion=eraseM&id=<?php echo $row["idPAdopta"] ;?>">
                                    <img src="../assets/images/cruz.png" alt="cruz">
                                    
                                </a>
                                
                            </div>
                        </div>
                    </td>
                </tr>

    <?php
 };
?>
        </table>
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
                // http://localhost/veterinaria/admin/index.php?seccion=AdminUsuarios
				echo "href='index.php?seccion=AdminPublicaciones&accion=listadoM&p=$i'>pág. $i</a></li>";
			};
        ?>	
	    </ul>
	</div>
	<?php 
	endif; 	
    ?>
    	         
</div>