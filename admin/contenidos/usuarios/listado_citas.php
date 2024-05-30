<div>
<?php
$cTexto  = <<<SQL
UPDATE cita SET estado = IF(fechaCita < now(), 0, 1);
SQL;
$stmU = $pdo->prepare($cTexto);
//$stmU->setFetchMode(PDO::FETCH_ASSOC);

try {
    $stmU->execute();
} catch (\Throwable $th) {
    echo $th;
}
//pagina quese envia a travez de get cuando plso sobre la numeracion de  lapagina al final. (pag.1, pag.2 ...)
$pagina_actual = isset( $_GET['p'] ) ? $_GET['p'] : 1;
$cantPorPagina = 10;
//devuelve la cantidad de usuarios 
$search;
//devuelve la cantidad de usuarios 
if(isset($_POST['filtroCitas']) || (isset($_SESSION['filtroCitas']))){
    
    if((!empty($_POST['filtroCitas'])) || (!empty($_SESSION['filtroCitas']))){
        
        if(!empty($_POST['filtroCitas'])){
            $filtroCitas = $_POST['filtroCitas'];  
            $_SESSION['filtroCitas'] = $filtroCitas;
            //$filtroCitas = '%' . $filtroCitas . '%';
        }
        if(!empty($_SESSION['filtroCitas'])){
            $filtroCitas = $_SESSION['filtroCitas'];
            //$filtroCitas = '%' . $filtroCitas . '%';
        }

        if($filtroCitas == 'Dia'){
            $Today = new DateTime();
            $intervalo = new DateInterval('P1D');
            $Today->add($intervalo);
            $todayAdd =  $Today->format('Y-m-d H:i:s') . "\n";
            $cTextos2 = <<<SQL
            SELECT COUNT(idcita) AS TOTAL FROM cita
            WHERE fechaCita < :filtro AND fechaCita > NOW()
        SQL;
        }else if($filtroCitas == 'Semana'){
            $Today = new DateTime();
            $intervalo = new DateInterval('P7D');
            $Today->add($intervalo);
            $todayAdd =  $Today->format('Y-m-d H:i:s') . "\n";
            $cTextos2 = <<<SQL
            SELECT COUNT(idcita) AS TOTAL FROM cita
            WHERE fechaCita < :filtro AND fechaCita > NOW()
        SQL;
        }else if($filtroCitas == 'In-activas'){
            $Today = new DateTime();
            $intervalo = new DateInterval('P30D');
            $Today->add($intervalo);
            $todayAdd =  $Today->format('Y-m-d H:i:s') . "\n";
            $cTextos2 = <<<SQL
            SELECT COUNT(idcita) AS TOTAL FROM cita
            WHERE fechaCita < :filtro AND estado = 0
        SQL;
        }else if($filtroCitas == 'Perdidas'){
            $Today = new DateTime();
            $intervalo = new DateInterval('P30D');
            $Today->add($intervalo);
            $todayAdd =  $Today->format('Y-m-d H:i:s') . "\n";
            $cTextos2 = <<<SQL
            SELECT COUNT(idcita) AS TOTAL FROM cita
            WHERE fechaCita < :filtro  AND exito = 0
        SQL;
        }else if($filtroCitas == 'Todo'){
            unset($_SESSION['filtroCitas']);
            $cTextos2 = "SELECT COUNT(idcita) AS TOTAL FROM cita WHERE estado=1";
            $filtroCitas = '';
        }
    }else{
        $cTextos2 = "SELECT COUNT(idcita) AS TOTAL FROM cita WHERE estado=1";
    }
}else{

    $cTextos2 = "SELECT COUNT(idcita) AS TOTAL FROM cita WHERE estado=1";
}
$stmt2 = $pdo->prepare($cTextos2);
// Especificamos el fetch mode antes de llamar a fetch()
$stmt2->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
if(!empty($filtroCitas)){
    $stmt2->bindParam(':filtro', $todayAdd, PDO::PARAM_STR);
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
if(isset($_POST['filtroCitas']) || (isset($_SESSION['filtroCitas']))){
    if((!empty($_POST['filtroCitas'])) || (!empty($_SESSION['filtroCitas']))){
        if(!empty($_POST['filtroCitas'])){
            $filtroCitas = $_POST['filtroCitas'];
            $_SESSION['filtroCitas'] = $filtroCitas;
        }
        if(!empty($_SESSION['filtroCitas'])){
            $filtroCitas = $_SESSION['filtroCitas'];
        }
        $_SESSION['filtroCitas'] = $filtroCitas;
        // $cTextos = <<<SQL
        // SELECT 
        //     *
        // FROM
        //     cita
        // WHERE nombre LIKE :nombre
        // LIMIT $dondeInicio, $cantPorPagina
        // SQL;





        if($filtroCitas == 'Dia'){
            $Today = new DateTime();
            $intervalo = new DateInterval('P1D');
            $Today->add($intervalo);
            $todayAdd =  $Today->format('Y-m-d H:i:s') . "\n";
            $cTextos = <<<SQL
            SELECT * FROM cita
            WHERE fechaCita < :filtro AND fechaCita > NOW()
            LIMIT $dondeInicio, $cantPorPagina
        SQL;
        }else if($filtroCitas == 'Semana'){
            $Today = new DateTime();
            $intervalo = new DateInterval('P7D');
            $Today->add($intervalo);
            $todayAdd =  $Today->format('Y-m-d H:i:s') . "\n";
            $cTextos = <<<SQL
            SELECT * FROM cita
            WHERE fechaCita < :filtro AND fechaCita > NOW()
            LIMIT $dondeInicio, $cantPorPagina
        SQL;
        }else if($filtroCitas == 'In-activas'){
            $Today = new DateTime();
            $intervalo = new DateInterval('P30D');
            $Today->add($intervalo);
            $todayAdd =  $Today->format('Y-m-d H:i:s') . "\n";
            $cTextos = <<<SQL
            SELECT * FROM cita
            WHERE fechaCita < :filtro AND estado = 0
            LIMIT $dondeInicio, $cantPorPagina
        SQL;
        }else if($filtroCitas == 'Perdidas'){
            $Today = new DateTime();
            $intervalo = new DateInterval('P30D');
            $Today->add($intervalo);
            $todayAdd =  $Today->format('Y-m-d H:i:s') . "\n";
            $cTextos = <<<SQL
            SELECT * FROM cita
            WHERE fechaCita < :filtro  AND exito = 0
            LIMIT $dondeInicio, $cantPorPagina
        SQL;
        }else if($filtroCitas == 'Todo'){
            unset($_SESSION['filtroCitas']);
            $cTextos = "SELECT * FROM cita WHERE estado=1 LIMIT
             $dondeInicio, $cantPorPagina";
            $filtroCitas = '';
        }
    }else{
        $cTextos = <<<SQL
        SELECT 
            *
        FROM
            cita WHERE estado=1
            LIMIT $dondeInicio, $cantPorPagina
        SQL;
    }
}else{
    $cTextos = <<<SQL
SELECT 
	*
FROM
    CitasPacientes WHERE estado=1
    LIMIT $dondeInicio, $cantPorPagina
SQL;
}
$stmt = $pdo->prepare($cTextos);
// Especificamos el fetch mode antes de llamar a fetch()
$stmt->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
if(!empty($filtroCitas)){
    $stmt->bindParam(':filtro', $todayAdd, PDO::PARAM_STR);
}
try {
    $stmt->execute();
    //code...
} catch (\Throwable $th) {
    echo $th;
}

?>





























<?php
    // $idU = $row['idusuario'];
    // $idM = $rowM['idpacientes'];
    // $cTextosCita = <<<SQL
    // SELECT 
    //     *
    // FROM
    //     CitasPacientes
    // WHERE estado = 1
    // SQL;
    // $stmtC = $pdo->prepare($cTextosCita);
    // $stmtC->setFetchMode(PDO::FETCH_ASSOC);
    
    // try {
    //     $stmtC->execute();
    //     $rowC = $stmtC->fetchAll(PDO::FETCH_ASSOC);
    // } catch (\Throwable $th) {
    //     echo $th;
    // }
    $rowC = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="producto">
                        <p>div</p>
                        <table class='tableVac '>
                            <tr  class='trVac'>
                                <th colspan="7" class='thVac thVac--color'>
                                    Citas
                                    <form id="filtroCita" action="index.php?seccion=AdminUsuarios&accionUserCitas=listadoCitas" method="POST">
                                        <!-- <input class="input_filter" name="filtroCitas" type="button" value="Dia">
                                        <input class="input_filter" name="filtroCitas" type="button" value="Semana">
                                        <input class="input_filter" name="filtroCitas" type="button" value="In-Activas">
                                        <input class="input_filter" name="filtroCitas" type="button" value="Perdidas"> -->
                                        <p>

                                        Favorite sport:

                                        <select name="filtroCitas">
                                        <option>Todo</option>

                                        <option>Dia</option>

                                        <option>Semana</option>

                                        <option>In-activas</option>

                                        <option>Perdidas</option>

                                        </select>

                                        <input type="submit" value="Filtrar">

                                        </p>
                                       
                                    </form>
                                </th>
                            </tr>
                            <tr  class='trVac'>
                                <th colspan="" class='thVac thVac--color'>Nombre</th>
                                <th colspan="" class='thVac thVac--color'>Descripcion</th>
                                <th colspan="" class='thVac thVac--color'>Fecha Alta</th>
                                <th colspan="" class='thVac thVac--color'>Fecha de Cita</th>
                                <th colspan="" class='thVac thVac--color'>Exito</th>
                                <th colspan="" class='thVac thVac--color'>Estado</th>
                                <th colspan="" class='thVac thVac--color'>Acciones</th>
                            </tr>
<?php

foreach ($rowC as $key2 => $value2){
    $fechaAlta =  $value2['fechaAlta'];
    $fechaCita =  $value2['fechaCita'];
    $idCita =  $value2['idcita'];
    $descripcion =  $value2['descripcion'];
    $exito =  $value2['exito'];
    $nombre =  $value2['nombre'];
    $pacientes_idpacientes =  $value2['pacientes_idpacientes'];
    $estado =  $value2['estado'];
?>
                            <tr class='trVac'>
                                <td class='tdVac tdVac--color' ><?php echo $nombre;  ?></td>
                                <td class='tdVac tdVac--color' ><?php echo $descripcion;  ?></td>        
                                <td class='tdVac tdVac--color' ><?php echo $fechaAlta;  ?></td>              
                                <td class='tdVac tdVac--color' ><?php echo $fechaCita;  ?></td>                                  
                                <td class='tdVac tdVac--color' ><?php echo $exito;  ?></td>                       
                                <td class='tdVac tdVac--color' ><?php echo $estado;  ?></td>                   
                                <td colspan="2" class='tdVac tdVac--color' >
                                    <a href="index.php?seccion=AdminUsuarios&accion=UserCitas&accionUserCitas=editarCita&idPc=<?php echo $pacientes_idpacientes;?>&idC=<?php echo $idCita;?>">
                                        <img src="../assets/images/editar.png" alt="editar">
                                    </a>
                                    <a href="index.php?seccion=AdminUsuarios&accion=UserCitas&accionUserCitas=deleteCita&idPc=<?php echo $pacientes_idpacientes ;?>&idC=<?php echo $idCita;?>">
                                        <img src="../assets/images/closed.png" alt="cruz">             
                                    </a>
                                </td>
                            </tr>
                       
<?php
    };

?>  
 </table>

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
				echo "href='index.php?seccion=AdminUsuarios&accionUserCitas=listadoCitas&p=$i'>pág. $i</a></li>";
			};
        ?>	
	    </ul>
	</div>
	<?php 
	endif; 	
    ?>
                    </div>
