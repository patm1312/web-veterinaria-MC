<!-- tambien se oculta el filtro cundonoo hay ningun resultado, se hace con hiddenFiltro.js -->
<input type="hidden" id="filtroHidden">
<a class="hidden buton modalOpen hiddenFilter" href="">         
                    <img class="img_preview-poster modalOpen" src="assets/images/filtrar.png" alt="pruebaimagen">
                    <span class="h2--servicios modalOpen">Filtros</span>
            </a>
            <div class="description">
            <dialog class="filter__responsiveFather dialog hiddenFilter"><form method="post" class="filter__responsive" action=""> 
                <?php
                ?>
                <div class="filter__responsive__tittle">
                    <h2 class="h2 section__filter">Filtrar:</h2>
                    <a href="" class="modalClose cerrar">
                        <img class="cerrar hidden filter__responsive__tittle--close"  src="assets/images/close.png" alt="up">
                    </a>
                </div>
                    <div class="section__filter">
                        <a class="filtro__1" href=""> 
                            <div class="filtro__1 section__filter--filtro">
                                <h3  class="filtro__1 section__filter--h3">Especie:</h3>
                                <img class="filtro__1 up up__1 none__filter " src="assets/images/imgup.png" alt="up">
                                <img class="filtro__1 down down__1" src="assets/images/imgdow.png" alt="up">
                            </div>
                        </a>
                        <div class="box__filter--one none__filter">
                            <div class="section__filter--box">
                                <label class="option">Perro</label>
                                <input <?php echo $resultadoE =  $_SESSION['especie'] == 'perro' ? 'checked' : ''; ?> name="especie" class="option" type="radio" value="perro">
                            </div>
                            <div class="section__filter--box">
                                <label class="">Gato:</label>
                                <input <?php echo $resultadoE =  $_SESSION['especie'] == 'gato' ? 'checked' : ''; ?> name="especie" class="" type="radio" value="gato">
                            </div>
                        </div>
                        
                    </div>
                    <div class="section__filter">
                        <a class="filtro__2"  href=""> 
                            <div class=" filtro__dos section__filter--filtro">
                                <h3  class="filtro__2 section__filter--h3">Edad:</h3>
                                <img class="filtro__2 up up__2 none__filter " src="assets/images/imgup.png" alt="up">
                                <img class="filtro__2 down down__2 " src="assets/images/imgdow.png" alt="up">
                            </div>
                        </a>
                        <div class="box__filter--two none__filter">
                            <div class="section__filter--box">
                                <label  class="option">Adulto</label>
                                <input <?php echo $resultadoEd =  $_SESSION['edad'] == 'adulto' ? 'checked' : ''; ?> name="edad" class="option" type="radio" value="adulto">
                            </div>
                            <div class="section__filter--box">
                                <label class="">Cachorro:</label>
                                <input <?php echo $resultadoEd =  $_SESSION['edad'] == 'cachorro' ? 'checked' : ''; ?> name="edad" class="" type="radio" value="cachorro">
                            </div> 
                        </div>
                    </div>
                    
                    <div class="section__filter">
                        <a class="filtro_3 enlace_filtro"  href=""> 
                            <div class="section__filter--filtro">
                                <h3  class="filtro__3 section__filter--h3">Sexo:</h3>
                                <img class="filtro__3 up up__3 none__filter" src="assets/images/imgup.png" alt="up">
                                <img class="filtro__3 down down__3" src="assets/images/imgdow.png" alt="up">
                            </div>
                        </a>
                        <div class="box__filter--three none__filter">
                            <div class="section__filter--box">
                                <label class="option">Hembra</label>
                                <input <?php echo $resultadoS =  $_SESSION['sexo'] == 'hembra' ? 'checked' : ''; ?> name="sexo" class="option" type="radio" value="hembra">
                            </div>
                            <div class="section__filter--box">
                                <label class="">Macho:</label>
                                <input <?php echo $resultadoS =  $_SESSION['sexo'] == 'macho' ? 'checked' : ''; ?> name="sexo" class="" type="radio" value="macho">
                            </div>
                        </div>
                        
                        </div>
                        <div class="section__filter">
                            <a class="filtro__4"  href=""> 
                                <div class="section__filter--filtro">
                                    <h3  class="filtro__4 section__filter--h3">Talla:</h3>
                                    <img class="filtro__4 up none__filter up__4" src="assets/images/imgup.png" alt="up">
                                    <img class="filtro__4 down down__4" src="assets/images/imgdow.png" alt="up">
                                </div>
                            </a>
                            <div class="box__filter--four none__filter">
                                <div class="section__filter--box">
                                    <label class="option">Mediano</label>
                                    <input <?php echo $resultadoT =  $_SESSION['especie'] == 'perro' ? 'checked' : ''; ?> name="talla" class="option" type="radio" value="mediano">
                                </div>
                                <div class="section__filter--box">
                                    <label class="">Pequeño:</label>
                                    <input <?php echo $resultadoT =  empty($_SESSION['talla']) ? '' : 'checked'; ?> name="talla" class="" type="radio"
                                    value="pequeño">
                                </div>
                            </div>
                            
                        </div>
                        <div class="section__filter">
                            <a class="filtro__5 " href=""> 
                                <div class="section__filter--filtro">
                                    <h3  class="filtro__5 section__filter--h3">Esterelizado:</h3>
                                    <img class="filtro__5 up none__filter up__5" src="assets/images/imgup.png" alt="up">
                                    <img class="filtro__5 down down__5" src="assets/images/imgdow.png" alt="up">
                                </div>
                            </a>
                            <div class="box__filter--five none__filter">
                                <div class="section__filter--box">
                                    <label class="option">Si</label>
                                    <input <?php echo $resultadoEst =  $_SESSION['esterilizado'] == 'si' ? 'checked' : ''; ?> name="esterilizado" class="option" type="radio" value="si">
                                </div>
                                <div class="section__filter--box">
                                    <label class="">No</label>
                                    <input <?php echo $resultadoEst =  $_SESSION['esterilizado'] == 'no' ? 'checked' : ''; ?> name="esterilizado" class="" type="radio" value="no">
                                </div>
                            </div>
                            
                        </div>
                        <div class="section__filter">
                            <a class="filtro__6"  href=""> 
                                <div class="section__filter--filtro">
                                    <h3  class="filtro__6 section__filter--h3">Raza</h3>
                                    <img class="filtro__6 up none__filter up__6" src="assets/images/imgup.png" alt="up">
                                    <img class="filtro__6 down down__6 " src="assets/images/imgdow.png" alt="up">
                                </div>
                            </a>
                            <div class="box__filter--six none__filter">
                                <?php
                        
                                $cTextosMascRaza = <<<SQL
                                SELECT 
                                    raza
                                FROM
                                    PAdopta
                                WHERE estado=1
                                SQL;
                                
                                try {
                                $stmtMascR = $pdo->prepare($cTextosMascRaza);
                                // Especificamos el fetch mode antes de llamar a fetch()
                                $stmtMascR->setFetchMode(PDO::FETCH_ASSOC);
                                // Ejecutamos
                                
                                $stmtMascR->execute();
                                    //code...
                                } catch (\Throwable $th) {
                                    echo $th;
                                }
                                if($stmtMascR){
                                    echo '<div class="section__filter--box">
                                    <p>
                                    Raza:
                                        <select name="raza">
                                        <option></option>
                                        ';
                                        
                                while ($rowMascR = $stmtMascR->fetch()){ 
                                ?>
                                            <option <?php echo $resultado =  empty($_SESSION['raza']) ? '' : 'selected'; ?> ><?php echo $rowMascR['raza']; ?></option>
                                <?php
                                };
                                echo '</select>
                                </p>
                            </div>';
                            }else{
                                echo '<div class="section__filter--box">
                                    <p>
                                    Raza:
                                        <select name="raza">
                                        <option></option>
                                        ';
                                echo '</select>
                                </p>
                            </div>';
                            }
                                ?>
                            </div>
                            
                        </div>
                        <div class="bottom__box">
                        <input class="bottom bottom__aside modalClose" type="submit" value="Aplicar">
                        <a href="contenidos/contenido__servicios/contenido_adopta/limpiar_filtro.php">Limpiar</a>
                    </div>
                </form>
            </dialog>
                
             <aside class="aside_hiden hiddenFilter"></aside> 
                <div class="description_services description_services--adopt">
                <?php
if((isset($_POST['especie'])) || (isset($_POST['edad'])) || (isset($_POST['sexo'])) || (isset($_POST['talla'])) || (isset($_POST['esterilizado'])) || (isset($_POST['raza']))){

    if((!empty($_POST['especie'])) || (!empty($_POST['edad'])) || (!empty($_POST['sexo'])) || (!empty($_POST['talla'])) || (!empty($_POST['esterilizado'])) || (!empty($_POST['raza']))){
        $fecha_mascota = date("Y-d-m",strtotime($fecha_actual."- 1 year"));
        $edad_numero;
        //si hay alguna opcion que no esta vacio y  q ademas existe:
        $cTextosCantidadMasc = "SELECT * FROM PAdopta";
        $cTextosCantidadMasc = $cTextosCantidadMasc . ' WHERE ';

        $especie = isset($_POST['especie']) ? $_POST['especie']: $_SESSION['especie'];
        $_SESSION['especie'] = $especie;
        $edad = isset($_POST['edad']) ? $_POST['edad']:'';
        $_SESSION['edad'] = $edad;
        $sexo = isset($_POST['sexo']) ? $_POST['sexo']:'';
        $_SESSION['sexo'] = $sexo;
        $talla = isset($_POST['talla']) ? $_POST['talla']:'';
        $_SESSION['talla'] = $talla;
        $esterilizado = isset($_POST['esterilizado']) ? $_POST['esterilizado']:'';
        $_SESSION['esterilizado'] = $esterilizado;
        $raza = isset($_POST['raza']) ? $_POST['raza']:'';
        $_SESSION['raza'] = $raza;
        
        if($especie != ''){
            $filtro1 = " especie=:especie AND ";
        }else{
            $filtro1 = '';
        }
        if($edad != ''){
            if($edad == 'cachorro'){
                echo 'edad a cachorro';
                $filtro2 = "DATE_FORMAT(fechaNac,'%Y/%d%m')<:fechamascota AND ";
            }else{
                $filtro2 = "DATE_FORMAT(fechaNac,'%Y/%d%m') > :fechamascota AND ";
            }
        }else{
            $filtro2 = '';
        }
        if($sexo != ''){
            $filtro3 = "sexo=:sexo AND ";
        }else{
            $filtro3 = '';
        }
        if($talla != ''){
            $filtro4 = "talla=:talla AND ";
        }else{
            $filtro4 = '';
        }
        if($esterilizado != ''){
            $filtro5 = "esterilizado=:esterilizado AND ";
        }else{
            $filtro5 = '';
        }
        if($raza != ''){
            $filtro6 = "raza=:raza AND ";
        }else{
            $filtro6 = '';
        }
        $filtros = $filtro1 . $filtro2. $filtro3. $filtro4. $filtro5. $filtro6;
        //lo convierto en array para luego quitarekle el and que sobra al final
        $subC = explode(" ", $filtros);
        array_splice($subC, -2);
        $subCS = implode(" ", $subC); 
        $cTextosCantidadMasc = $cTextosCantidadMasc . $subCS;
        $cTextosCantidadMasc = $cTextosCantidadMasc . ' AND estado=1 ';
        $_SESSION['consulta'] = $cTextosCantidadMasc;
    }else{
        //cuando no tiene filtros hago una consulta general
        $cTextosCantidadMasc = !empty($_SESSION['consulta']) ? $_SESSION['consulta']: "SELECT * FROM PAdopta WHERE estado=1";
    }
}else{
    //cuando no tiene filtros hago una consulta general
    $cTextosCantidadMasc = !empty($_SESSION['consulta']) ? $_SESSION['consulta']: "SELECT * FROM PAdopta WHERE estado=1";
}
//pagina quese envia a travez de get cuando plso sobre la numeracion de  lapagina al final. (pag.1, pag.2 ...)
$pagina_actual = isset( $_GET['p'] ) ? $_GET['p'] : 1;
$cantPorPagina = 6;
//devuelve la cantidad de mascotas en adopcion 
$stmtCantM = $pdo->prepare($cTextosCantidadMasc);
// Especificamos el fetch mode antes de llamar a fetch()
$stmtCantM->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos, antes verificamos la informacion enviada o reservada en la session.
$especie = isset($_POST['especie']) ? $_POST['especie']: $_SESSION['especie'];
$edad = isset($_POST['edad']) ? $_POST['edad']: $_SESSION['edad'];
$sexo = isset($_POST['sexo']) ? $_POST['sexo']: $_SESSION['sexo'];
$talla= isset($_POST['talla']) ? $_POST['talla']: $_SESSION['talla'];
$raza = isset($_POST['raza']) ? $_POST['raza']: $_SESSION['raza'];
$esterilizado = isset($_POST['esterilizado']) ? $_POST['esterilizado']: $_SESSION['esterilizado'];
try {
    if($especie != ''){

        $stmtCantM->bindParam(':especie', $especie, PDO::PARAM_STR);
    }
    if($edad != ''){
        $stmtCantM->bindParam(':fechamascota', $fecha_mascota, PDO::PARAM_STR);
    }
    if($sexo != ''){
        $stmtCantM->bindParam(':sexo', $sexo, PDO::PARAM_STR);
    }
    if($talla != ''){
        $stmtCantM->bindParam(':talla', $talla, PDO::PARAM_STR);
    }
    if($esterilizado != ''){

        $stmtCantM->bindParam(':esterilizado', $esterilizado, PDO::PARAM_STR);
    }
    if($raza != ''){
        $stmtCantM->bindParam(':raza', $raza, PDO::PARAM_STR);
   
    }
    $stmtCantM->execute();
} catch (\Throwable $th) {
    echo $th;
}
$cantidad = 0;
while ($rowMmascot = $stmtCantM ->fetch()){   
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
$cTextosCantidadMasc = $cTextosCantidadMasc . $limites;
$stmtMasc = $pdo->prepare($cTextosCantidadMasc);
// Especificamos el fetch mode antes de llamar a fetch()
$stmtMasc->setFetchMode(PDO::FETCH_ASSOC);
if($especie != ''){
    $stmtMasc->bindParam(':especie', $especie, PDO::PARAM_STR);
}
if($edad != ''){
    $stmtMasc->bindParam(':fechamascota', $fecha_mascota, PDO::PARAM_STR);
}
if($sexo != ''){
    $stmtMasc->bindParam(':sexo', $sexo, PDO::PARAM_STR);
}
if($talla != ''){
    $stmtMasc->bindParam(':talla', $talla, PDO::PARAM_STR);
}
if($esterilizado != ''){
    $stmtMasc->bindParam(':esterilizado', $esterilizado, PDO::PARAM_STR);
}
if($raza != ''){
    $stmtMasc->bindParam(':raza', $raza, PDO::PARAM_STR);
}
try {
$stmtMasc->execute();

} catch (\Throwable $th) {
    echo $th;
}
$rowMasc = $stmtMasc->fetchAll();
$countR = count($rowMasc);
if($countR > 0){
    foreach ($rowMasc as $key => $value){ 
    $id = $value['idPAdopta'];
    $especie = $value['especie'];
    $raza = $value['raza'];
    $sexo = $value['sexo'];
    $talla = $value['talla'];
    $foto = $value['foto'];
    
 ?>
                    <div class="description_service--box">
                        <a href="index.php?seccion=adopta&seccionA=petA&id=<?php echo $id; ?>">
                            <div class="description_services--img">
                                <img class="img_preview-poster" src="admin/<?php echo $foto; ?>" alt="pets">
                            </div>
                                <div class="description_services--descr">
                                    <h2 class="nav__item--color description_item"><?php echo $especie; ?></h2>
                                    <p class="">raza: <span><?php echo $raza; ?></span></p>
                                    <p class=""><?php echo $sexo; ?></p>
                                    <p class="">talla: <?php echo $talla; ?><span></span></p>
                                </div>
                        </a>
                   </div>

<?php
    };
 }else{
?>
    <div class="img__dataNUll">
        <input type="hidden" id="habilitarFiltro">
        <img class="img__dataNUll--img" src="assets/ilustracion/nullimage.jpg" alt="imagenNull">
        <h2 class="poster__description--span2 h2__serv img__dataNUll--h2" >En este Momento no tenemos mascotsa disponibles</h2>
        <div class="bottom__box">

                        <a href="contenidos/contenido__servicios/contenido_adopta/limpiar_filtro.php">Regresar</a>
                    </div>
    </div>
    <?php
};
?>
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
				echo "href='index.php?seccion=adopta&p=$i'>pág. $i</a></li>";
			};
        ?>	
	    </ul>
	</div>
	<?php 
	endif; 	
    ?>
            
<!-- <button class="modalOpen">Abrir ventana modal</button>
<dialog id="modal">
   <h2>Este es el título de mi ventana modal</h2>
   <p>Este es un texto de ejemplo dentro de una ventana modal</p>
   <button class="modalClose">Cerrar</button>
</dialog> -->