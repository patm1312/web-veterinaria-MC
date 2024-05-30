<?php
//pagina quese envia a travez de get cuando plso sobre la numeracion de  lapagina al final. (pag.1, pag.2 ...)
$pagina_actual = isset( $_GET['p'] ) ? $_GET['p'] : 1;
$cantPorPagina = 3;
//devuelve la cantidad de usuarios 
$cTextos2 = "SELECT COUNT(idusuario) AS TOTAL FROM usuarios";
$stmt2 = $pdo->prepare($cTextos2);
// Especificamos el fetch mode antes de llamar a fetch()
$stmt2->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
$stmt2->execute();
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
    usuarios
LIMIT $dondeInicio, $cantPorPagina
SQL;
$stmt = $pdo->prepare($cTextos);
// Especificamos el fetch mode antes de llamar a fetch()
$stmt->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
$stmt->execute();
?>
<div class="info__personal"> 
    <input type="hidden" id="homeAdmin">
    <h2 class="h2 h2--servicios" >Listado de usuarios</h2>
    <div class="info__personal--info dog">
        <?php
            while ($row = $stmt->fetch()){
        ?>
        <div class="contenedor">
            <div class="box_linedonwn">
                <h1 class="h2 h2__perfil"><?php echo $row["nombre"];  ?></h1>
                <a href="index.php?seccion=perfil&seccionUser=updateUser">
                </a>
                    <!-- //esta clase identifica a cada usuario,  -->
                <a href="" class="user__<?php echo $row['idusuario'];?>">
                    <div class="user__<?php echo $row['idusuario'];?>box_linedonwn--editar">
                        <p id="up__<?php echo $row['idusuario'];?>" class="user__<?php echo $row['idusuario'];?> h2__perfil">Ver</p> 
                        </div>
                </a>
                
            </div>
        </div>  
            <!-- //el id de la tabla corresponde a cada clase de el enlace de ver  que es un usuario, se identifica por un numero -->
        <div class="div none__filter" id="<?php echo $row["idusuario"] ?>" >
            <p class='bottom__gray bottom__gray--margin'>datos de <?php echo $row["nombre"];  ?>
                 <a href="index.php?seccion=AdminUsuarios&accion=editarUser&id=<?php echo $row["idusuario"] ;?>">
                    <img src="../assets/images/editar.png" alt="editar">
                </a>
                <a href="index.php?seccion=AdminUsuarios&accion=eraseU&id=<?php echo $row["idusuario"] ;?>">
                    <img src="../assets/images/closed.png" alt="cruz">          
                </a>
            </p>
            <table class='tableVac ' ">
                <tr  class='trVac'>
                    <th class='thVac thVac--color'></th>
                        <th class='thVac thVac--color'>Descripcion</th>
                    </tr>
                    <tr class='trVac'>
                        <th class='thVac thVac--block'>Nombre</th>
                        <td class='tdVac tdVac--color' ><?php echo $row["nombre"];  ?></td>
                    </tr>
                    <tr class='trVac'>
                        <th class='thVac thVac--block'>Direccion</th>
                        <td class='tdVac tdVac--color' ><?php echo $row["direccion"];  ?></td>
                    </tr>
                    <tr class='trVac'>
                        <th class='thVac thVac--block'>Telefono</th>
                        <td class='tdVac tdVac--color' ><?php echo $row["telefono"];  ?></td>
                    </tr>
                    <tr class='trVac'>
                        <th class='thVac thVac--block'>Telefono Secundario</th>
                        <td class='tdVac tdVac--color' ><?php echo $row["telefonosecundario"];  ?></td>
                    </tr>
                    <tr class='trVac'>
                        <th class='thVac thVac--block'>Fecha de Alta</th>
                        <td class='tdVac tdVac--color' ><?php echo $row["fechaAlta"];  ?></td>
                    </tr>
                    <tr class='trVac'>
                        <th class='thVac thVac--block'>Foto de portada</th>
                        <td class='tdVac tdVac--color' >
                            <?php echo $row["fotoPortada"]; ?>
                            <a class="openImg" href="" >
                                <!-- //pongo el icono de una imagen, cuando el usuario  le di click se recupera la ruta guardada en el input oculto que se abre la imagen  -->
                                <img class="openImg" src="contenidos/publicaciones/assets/default/img.png" alt="preview">
                                <input  type="hidden" value="<?php echo $row['fotoPortada'];?>">
                            </a>
                        </td>
                    </tr>
                    <tr class='trVac'>
                        <th class='thVac thVac--block'>Foto de perfil</th>
                        <td class='tdVac tdVac--color' >
                            <a class="openImg" href="" >
                                <!-- //pongo el icono de una imagen, cuando el usuario  le di click se recupera la ruta guardada en el input oculto que se abre la imagen  -->
                                <img class="openImg" src="contenidos/publicaciones/assets/default/img.png" alt="preview">
                                <input  type="hidden" value="<?php echo $row['foto'];?>">
                            </a>
                            <?php echo $row["foto"];  ?>
                        </td>
                    </tr>
                    <tr class='trVac'>
                        <th class='thVac thVac--block'>Estado de cuenta</th>
                        <td class='tdVac tdVac--color' ><?php echo $row["estado"];  ?></td>
                    </tr>
                    <tr class='trVac'>
                        <th class='thVac thVac--block'>Apellido</th>
                        <td class='tdVac tdVac--color' ><?php echo $row["apellido"];  ?></td>
                    </tr>
                    <tr class='trVac'>
                        <th class='thVac thVac--block'>Email</th>
                        <td class='tdVac tdVac--color' ><?php echo $row["email"];  ?></td>
                    </tr>
                </table>
<?php
    $idU = $row['idusuario'];
    $cTextosMascota = <<<SQL
    SELECT 
        *
    FROM
        pacientes
    WHERE usuario_idusuario =?
    SQL;

    $stmtM = $pdo->prepare($cTextosMascota);
    // Especificamos el fetch mode antes de llamar a fetch()
    //$stmt->fetch(PDO::FETCH_ASSOC);
    $stmtM->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    $stmtM->execute([$idU]);
    //$rowM = $stmtM->fetch();
    //var_dump($rowM);
?>

    <p class='bottom__gray bottom__gray--margin'>Datos  de Mascotas
    </p>
<?php

    while ($rowM = $stmtM->fetch()){
?>
            <div class="producto">
            <table class='tableVac '>
                <tr  class='trVac'>
                    <th colspan="3" class='thVac thVac--color'>Datos de Mascota : <?php echo $rowM["nombre"];  ?></th>
                </tr>
                <tr class='trVac'>
                    <th rowspan="8" class='thVac thVac--block'>
                        <!-- <img src="./contenidos/usuarios/assets/imgMascotas/1701913347854.png" alt="yy"> -->
                        <img class="openImg" src=".<?php echo $rowM["foto"];  ?>" alt="previewfoto">
                    </th>
                </tr>
                <tr class='trVac'>
                    <th class='thVac thVac--block'>Nombre</th>
                    <td class='tdVac tdVac--color' ><?php echo $rowM["nombre"];  ?></td>
                </tr>
                <tr class='trVac'>
                    <th class='thVac thVac--block'>Raza</th>
                    <td class='tdVac tdVac--color' ><?php echo $rowM["raza"];  ?></td>
                </tr>
                <tr class='trVac'>
                    <th class='thVac thVac--block'>Color</th>
                    <td class='tdVac tdVac--color' ><?php echo $rowM["color"];  ?></td>
                </tr>
                <tr class='trVac'>
                    <th class='thVac thVac--block'>Edad</th>
                    <td class='tdVac tdVac--color' ><?php echo $rowM["edad"];  ?></td>
                </tr>
                <tr class='trVac'>
                    <th class='thVac thVac--block'>Fecha Registro:</th>
                    <td class='tdVac tdVac--color' ><?php echo $rowM["fechaAlta"];  ?></td>
                </tr>
                <tr class='trVac'>
                    <th class='thVac thVac--block'>Documentos:</th>
                    <td class='tdVac tdVac--color' >documento descargar</td>
                </tr>
                <tr class='trVac'>
                    <th class='thVac thVac--block'>Estado:</th>
                    <td class='tdVac tdVac--color' ><?php echo $rowM["estado"];  ?></td>
                </tr>
                <tr class='trVac'>
                    <th class='thVac thVac--block'>Acciones::</th>
                    <td colspan="2" class='tdVac tdVac--color' >
                        <a href="index.php?seccion=AdminUsuarios&accion=editarMascota&idM=<?php echo $rowM["idpacientes"] ;?>&idU=<?php echo $idU;?>">
                            <img src="../assets/images/editar.png" alt="editar">
                        </a>
                        <a href="index.php?seccion=AdminUsuarios&accion=eraseM&idM=<?php echo $rowM["idpacientes"] ;?>&idU=<?php echo $idU;?>">
                            <img src="../assets/images/closed.png" alt="cruz">             
                        </a>
                    </td>
                </tr>
                </table>
            </div>
            <div>
            <?php
    $idU = $row['idusuario'];
    $idM = $rowM['idpacientes'];
    $cTextosCita = <<<SQL
    SELECT 
        *
    FROM
        CitasPacientes
    WHERE pacientes_idpacientes =?
    SQL;

    $stmtC = $pdo->prepare($cTextosCita);
    // Especificamos el fetch mode antes de llamar a fetch()
    //$stmt->fetch(PDO::FETCH_ASSOC);
    $stmtC->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    $stmtC->execute([$idM]);
  
?>
<?php

    while ($rowC = $stmtC->fetch()){
?>
                <div class="producto">
                    <table class='tableVac '>
                    <tr  class='trVac'>
                    <th colspan="2" class='thVac thVac--color'>Cita de <?php echo $rowC["nombre"];  ?></th>
                    </tr>
                    <tr class='trVac'>
                        <th class='thVac thVac--block'>Nombre Paciente:</th>
                        <td class='tdVac tdVac--color' ><?php echo $rowC["nombre"];  ?></td>
                    </tr>
                    <tr class='trVac'>
                        <th class='thVac thVac--block'>Descripcion</th>
                        <td class='tdVac tdVac--color' ><?php echo $rowC["descripcion"];  ?></td>
                    </tr>
                    <tr class='trVac'>
                        <th class='thVac thVac--block'>Fecha Alta</th>
                        <td class='tdVac tdVac--color' ><?php echo $rowC["fechaAlta"];  ?></td>
                    </tr>
                    <tr class='trVac'>
                        <th class='thVac thVac--block'>Fecha Cita:</th>
                        <td class='tdVac tdVac--color' ><?php echo $rowC["fechaCita"];  ?></td>
                    </tr>
                    <tr class='trVac'>
                        <th class='thVac thVac--block'>Exito</th>
                        <td class='tdVac tdVac--color' ><?php echo $rowC["exito"];  ?></td>
                    </tr>
                    <tr class='trVac'>
                        <th class='thVac thVac--block'>estado</th>
                        <td class='tdVac tdVac--color' ><?php echo $rowC["estado"];  ?></td>
                    </tr>
                    <tr class='trVac'>
                        <th class='thVac thVac--block'>Acciones::</th>
                        <td colspan="2" class='tdVac tdVac--color' >
                            <a href="index.php?seccion=AdminUsuarios&accion=editarCita&idPc=<?php echo $rowC["pacientes_idpacientes"] ;?>&idC=<?php echo $rowC["idcita"];?>">
                                <img src="../assets/images/editar.png" alt="editar">
                            </a>
                            <a href="index.php?seccion=AdminUsuarios&accion=deleteCita&idPc=<?php echo $rowC["pacientes_idpacientes"] ;?>&idC=<?php echo $rowC["idcita"];?>">
                                <img src="../assets/images/closed.png" alt="cruz">             
                            </a>
                        </td>
                    </tr>
                </table>
                </div>
<?php
  };
?>  
            </div>
            <?php
               $cTextosH = <<<SQL
               SELECT 
                   *
               FROM
                   HistoriasMedicas
               WHERE idpacientes =?
               SQL;
           
               $stmtH = $pdo->prepare($cTextosH);
               // Especificamos el fetch mode antes de llamar a fetch()
               //$stmt->fetch(PDO::FETCH_ASSOC);
               $stmtH->setFetchMode(PDO::FETCH_ASSOC);
               // Ejecutamos
               $stmtH->execute([$idM]);

            ?>
            <div class="producto">
            <table class='table--admin' >
                <tr  class=''>
                    <th class='thVac--admin'>Numero</th>
                    <th class='thVac--admin'>Antecendentes:</th>
                    <th class='thVac--admin'>Diagnostico</th>
                    <th class='thVac--admin'>Hospitalizacion</th>
                    <th class='thVac--admin'>Fecha Ingreso:</th>
                    <th class='thVac--admin'>Fecha Alta</th>
                    <th class='thVac--admin'>Documentos</th>
                    <th class='thVac--admin'>Prescripcion:</th>
                    <th class='thVac--admin'>Fecha de Alta</th>
                    <th class='thVac--admin'>Acciones:</th>
                </tr>
            <?php

while ($rowH = $stmtH->fetch()){
    echo 'wile';
?>
<tr >
    <th>Historia de <?php echo $rowH["nombre"];  ?></th>
</tr>
            <tr class='trVac--admin'>
                    <td class='tdVac--admin' >
                       1
                    </td>
                    <td class='tdVac--admin' ></td>
                    <td class='tdVac--admin' ><?php echo $rowH["diagnostico"];  ?></td>
                    <td class='tdVac--admin' ><?php echo $rowH["hospitalizacion"];  ?></td>
                    <td class='tdVac--admin' ><?php echo $rowH["diagnostico"];  ?></td>
                    <td class='tdVac--admin' ><?php echo $row["fechaIngreso"];  ?></td>
                    <td class='tdVac--admin' ><?php echo $row["fechaAlta"];  ?></td>
                    <td class='tdVac--admin' ><?php echo $row["documentos"];  ?></td>
                    <td class='tdVac--admin' ><?php echo $row["prescripcion"];  ?></td>
                    <td class='tdVac--admin' >
                        <div class="acciones__table">
                            <div class="acciones__table-editar" >
                                <a href="index.php?seccion=AdminPublicaciones&accion=editarH&id=<?php echo $row["idpublicaciones"] ;?>">
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
<?php
  };
?>
</table>
</div>
            </div>
<?php
  };
?>
            <p class='bottom__gray bottom__gray--margin'>PLan de Vacunas de .. <?php echo $row["nombre"];  ?><a href="">
                        <img src="../assets/images/editar.png" alt="editar">
                </a></p>
            <div class="producto">
            <?php 
                $variable = 'gato';
                if($variable == 'gato'){
                    include("../institucion/estandarVacunacion/vacunaciongato.php");
                }
            ?>
            </div> 
            <p class='bottom__gray bottom__gray--margin'>PLan de Desparacitacion de .. <?php echo $row["nombre"];  ?><a href="">
                        <img src="../assets/images/editar.png" alt="editar">
                </a></p>
            <div class="producto">
            <?php 
                $variable = 'gato';
                if($variable == 'gato'){
                    echo "es un gato";
                    include("../institucion/estandarVacunacion/desparacitacion.php");
                    echo $variableprueba;
                }
            ?>
            </div>
            <p class='bottom__gray bottom__gray--margin'>Productos  de.. <?php echo $row["nombre"];  ?><a href="">
                        <img src="../assets/images/editar.png" alt="editar">
                </a></p>
            <div class="producto">
            <table class='tableVac ' ">
                <tr  class='trVac'>
                    <th colspan="3" class='thVac thVac--color'>Datos de Producto : tal..</th>
                </tr>
                <tr class='trVac'>
                    <th rowspan="7" class='thVac thVac--block'>foto</th>
                </tr>
                <tr class='trVac'>
                    <th class='thVac thVac--block'>Nombre</th>
                    <td class='tdVac tdVac--color' >Garu</td>
                </tr>
                <tr class='trVac'>
                    <th class='thVac thVac--block'>Descripcion:</th>
                    <td class='tdVac tdVac--color' >raza</td>
                </tr>
                <tr class='trVac'>
                    <th class='thVac thVac--block'>Precio:</th>
                    <td class='tdVac tdVac--color' >color</td>
                </tr>
                <tr class='trVac'>
                    <th class='thVac thVac--block'>Fecha de Alta:</th>
                    <td class='tdVac tdVac--color' >fecha alta</td>
                </tr>
                </table>
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
                // echo "href='index.php?seccion=AdminUsuarios&p=$i'>pág. $i</a></li>";
				echo "href='index.php?seccion=AdminUsuarios&p=$i'>pág. $i</a></li>";
			};
        ?>	
	    </ul>
	</div>
	<?php 
	endif; 	
    ?>
    	         
</div>
