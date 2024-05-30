<input type="hidden" id="AdminPublic">
<?php
//pagina quese envia a travez de get cuando plso sobre la numeracion de  lapagina al final. (pag.1, pag.2 ...)
$pagina_actual = isset( $_GET['p'] ) ? $_GET['p'] : 1;
$cantPorPagina = 6;
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
            SELECT COUNT(idpublicaciones) AS TOTAL FROM publicaciones 
            WHERE descripcion LIKE :descripcion 
            OR categoria LIKE :descripcion 
            OR titulo LIKE :descripcion
        SQL;
    }else{
        $cTextos2 = "SELECT COUNT(idpublicaciones) AS TOTAL FROM publicaciones WHERE estado=1";
    }
}else{
    $cTextos2 = "SELECT COUNT(idpublicaciones) AS TOTAL FROM publicaciones WHERE estado=1";
}
$stmt2 = $pdo->prepare($cTextos2);
// Especificamos el fetch mode antes de llamar a fetch()
$stmt2->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
if(!empty($search)){
    $stmt2->bindParam(':descripcion', $search, PDO::PARAM_STR);
    $stmt2->bindParam(':descripcion', $search, PDO::PARAM_STR);
    $stmt2->bindParam(':descripcion', $search, PDO::PARAM_STR);
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
            publicaciones
        WHERE descripcion LIKE :descripcion OR categoria LIKE :descripcion OR titulo LIKE :descripcion
        LIMIT $dondeInicio, $cantPorPagina
        SQL;
    }else{
        $cTextos = <<<SQL
        SELECT 
            *
        FROM
            publicaciones WHERE estado=1
        LIMIT $dondeInicio, $cantPorPagina
        SQL;
    }
}else{
    $cTextos = <<<SQL
SELECT 
	*
FROM
    publicaciones WHERE estado=1
LIMIT $dondeInicio, $cantPorPagina
SQL;
}
$stmt = $pdo->prepare($cTextos);
// Especificamos el fetch mode antes de llamar a fetch()
$stmt->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
if(!empty($search)){
    $stmt->bindParam(':descripcion', $search, PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $search, PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $search, PDO::PARAM_STR);
}
try {
    $stmt->execute();
    //code...
} catch (\Throwable $th) {
    echo $th;
}
?>
<div id="search" class="info__personal"> 
    <input type="hidden" id="homeAdmin">
    <a class="a__aniadirP" href="index.php?seccion=AdminPublicaciones&accion=addP">
        <div class='aniadir-publicacion'>
            <img class="aniadir-publicacion-img" src="../assets/images/mas.png" alt="mas">
            <p>Añadir Nueva Publicacion</p>
        </div>
    </a>
    <div class="info__personal--info dog">
        <!-- //el id de la tabla corresponde a cada clase de el enlace de ver  que es un usuario, se identifica por un numero -->
        <div>
            <table class='table--admin' >
                <tr  class=''>
                    <th class='thVac--admin'>Numero</th>
                    <th class='thVac--admin'>Titulo</th>
                    <th class='thVac--admin'>SubTitulo</th>
                    <th class='thVac--admin'>Descripcion</th>
                    <th class='thVac--admin'>Foto</th>
                    <th class='thVac--admin'>Precio</th>
                    <th class='thVac--admin'>Descuento</th>
                    <th class='thVac--admin'>Categoria</th>
                    <th class='thVac--admin'>Fecha de Alta</th>
                    <th class='thVac--admin'>Estado</th>
                    <th class='thVac--admin'>Espacio</th>
                    <th class='thVac--admin'>Acciones</th>
                </tr>
<?php
            while ($row = $stmt->fetch()){ 
                  
?>
                <tr class='trVac--admin'>
                    <td class='tdVac--admin' >
                        <a href="" class="AdminPublic__<?php echo $row["idpublicaciones"];  ?>">
                            <?php echo $row["idpublicaciones"];  ?>
                        </a>
                    </td>
                    <td class='tdVac--admin' ><?php echo $row["titulo"];  ?></td>
                    <td class='tdVac--admin' ><?php echo $row["subtitulo"];  ?></td>
                    <td class='tdVac--admin' ><?php echo $row["descripcion"];  ?></td>
                    <td class='tdVac--admin' >
                        <a class="openImg" href="" >
                            <!-- //pongo el icono de una imagen, cuando el usuario  le di click se recupera la ruta guardada en el input oculto que se abre la imagen  -->
                            <img class="openImg" src="contenidos/publicaciones/assets/default/img.png" alt="preview">
                            <input  type="hidden" value="<?php echo $row['foto'];?>">
                        </a>
                    </td>
                    <td class='tdVac--admin' ><?php echo $row["precio"];  ?></td>
                    <td class='tdVac--admin' ><?php echo $row["descuento"];  ?></td>
                    <td class='tdVac--admin' ><?php echo $row["categoria"];  ?></td>
                    <td class='tdVac--admin' ><?php echo $row["Fecha de Alta"];  ?></td>
                    <td class='tdVac--admin' ><?php echo $row["estado"];  ?></td>
                    <td class='tdVac--admin' >
                        <?php echo $row["espacio"]; ?>
                        <a class="openImg" href="">
                            <img class="openImg" src="contenidos/publicaciones/assets/default/img.png" alt="foto">
                            <input  type="hidden" value="<?php echo $row['fotoSlider'];?>">
                        </a>
                    </td>
                    <td class='tdVac--admin' >
                        <div class="acciones__table">
                            <div class="acciones__table-editar" >
                                <a href="index.php?seccion=AdminPublicaciones&accion=editarp&id=<?php echo $row["idpublicaciones"] ;?>">
                                    <img src="../assets/images/lapiz.png" alt="lapiz">
                                </a>
                            </div>
                            <div class="acciones__table-eliminar" >
                                <a href="index.php?seccion=AdminPublicaciones&accion=eraseP&id=<?php echo $row["idpublicaciones"] ;?>">
                                    <img src="../assets/images/cruz.png" alt="cruz">
                                    
                                </a>
                                
                            </div>
                        </div>
                    </td>
                </tr>
<!-- //consulta para subpublicaciones de cada ulicacion: -->
<?php
    $publcacion = $row["idpublicaciones"];
    $cTextosPs = <<<SQL
    SELECT 
        *
    FROM
        PServicio
    WHERE
        publicaciones_idpublicaciones = $publcacion
    SQL;
    $stmtPs = $pdo->prepare($cTextosPs);
    // Especificamos el fetch mode antes de llamar a fetch()
    $stmtPs->setFetchMode(PDO::FETCH_ASSOC);
    //Ejecutamos
    $stmtPs->execute();
    $numberPS = $row["idpublicaciones"];
    while ($rowS = $stmtPs->fetch()){
        if($rowS){
            $numberPS += 0.1;
?>
            <tr class=' AdminPublicTable__<?php echo $row["idpublicaciones"]; ?> none__filter'>
                <td class='td__admin--ps' ><?php echo $numberPS;  ?></td>
                <td class='td__admin--ps' ><?php echo $rowS["titulo"]; echo $rowS["idPservicio"]; ?></td>
                <td class='td__admin--ps' ><?php echo $rowS["subtitulo"];  ?></td>
                <td class='td__admin--ps' ><?php echo $rowS["parrafo"];  ?></td>
                <td class='td__admin--ps' >
              
                    <a class="openImg" href="" >
                        <!-- //pongo el icono de una imagen, cuando el usuario  le di click se recupera la ruta guardada en el input oculto que se abre la imagen  -->
                        <img class="openImg" src="contenidos/publicaciones/assets/default/img.png" alt="preview">
                        <input id="<?php echo $numberPS; ?> " type="hidden" value="<?php echo $rowS['imagen'];?>">
                    </a>
                    <?php //echo $rowS["imagen"];  ?>
                </td>
                <td class='td__admin--ps' ></td>
                <td class='td__admin--ps' ></td>
                <td class='td__admin--ps' ></td>
                <td class='td__admin--ps' ><?php echo $rowS["fechaAlta"];  ?></td>
                <td class='td__admin--ps' ><?php echo $rowS["estado"];  ?></td>
                <td class='td__admin--ps' ></td>
                <td class='td__admin--ps' >
                <div class="acciones__table">
                            <div class="acciones__table-editar" >
                                <a href="index.php?seccion=AdminPublicaciones&accion=editarpS&idp=<?php echo $row["idpublicaciones"];?>&idPS=<?php echo $rowS["idPservicio"];?>">
                                    <img src="../assets/images/lapiz.png" alt="lapiz">
                                    
                                </a>
                                
                            </div>
                            <div class="acciones__table-eliminar" >
                                <a href="index.php?seccion=AdminPublicaciones&accion=erasePS&idp=<?php echo $row["idpublicaciones"];?>&idPS=<?php echo $rowS["idPservicio"];?>">
                                    <img src="../assets/images/cruz.png" alt="cruz">
                                    
                                </a>
                                
                            </div>
                        </div>
                </td>
            </tr>
<?php
        }
    };
?>
                <tr  class='AdminPublicTable__<?php echo $row["idpublicaciones"]; ?> none__filter'>
                    <td colspan="12" class='td__admin--ps' >
                        <div class='aniadir'>
                            <a href="index.php?seccion=AdminPublicaciones&accion=addpServ&p=<?php echo $row["idpublicaciones"];?>">
                                <img src="../assets/images/mas.png" alt="mas">
                                <p>añadir contenido  a publicacion</p>
                            </a>
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
				echo "href='index.php?seccion=AdminPublicaciones&p=$i'>pág. $i</a></li>";
			};
        ?>	
	    </ul>
	</div>
	<?php 
	endif; 	
    ?>
    	         
</div>
