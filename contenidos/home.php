<?php
$cTextosSlider = <<<SQL
SELECT 
	*
FROM
    publicaciones
WHERE  espacio = :espacio
AND estado=1
SQL;
$espacio = 'slider';
$stmtSlider = $pdo->prepare($cTextosSlider);
// Especificamos el fetch mode antes de llamar a fetch()
$stmtSlider->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
$stmtSlider->bindParam(':espacio', $espacio, PDO::PARAM_STR);
try {
    $stmtSlider->execute();
    //code...
} catch (\Throwable $th) {
    echo $th;
}
?>
<section class="section__slider">
    <a href="#" class="previos">&laquo;</a>
    <a href="#" class="next">&raquo;</a>
    <?php
    $enlace;
    while ($rowSlider = $stmtSlider->fetch()){
        $imagenS = $rowSlider['fotoSlider'];
    
        $categoria = $rowSlider['categoria'];
        $id = $rowSlider['idpublicaciones'];
        if($categoria == 'cita'){
            $enlace = 'index.php?seccion=cita';
        }else if($categoria == 'Padopta'){
            $enlace = 'index.php?seccion=adopta';
        }else if($categoria == 'Pservicio'){
            $enlace = 'index.php?seccion=servicio&id=' . $id;
        }
       
    ?>
                       <a class="slider-slide" href="<?php echo $enlace; ?>">
                            <img class="sliderImg" src="admin/<?php echo $imagenS ; ?>" alt="">
                        </a>
    <?php
    };
    ?>
                        <!-- <a class="slider-slide" href="index.php?seccion=cita">
                            <img class="sliderImg" src="assets/images/slider_cita.png" alt="ddfd">
                        </a>
                        <a class="slider-slide" href="index.php?seccion=adopta">
                            <img class="sliderImg" src="assets/images/AdoptaPoster.png" alt="rrrrr">
                        </a> -->
</section>
<section class="container poster poster__1"> 
<img class="cruz cruz_2" src="assets/ilustracion/cruzbg.png" alt="cruz" >
    <img class="cruz cruz_1" src="assets/ilustracion/cruzbg.png" alt="cruz" >
    <img class="huella huella_1" src="assets/ilustracion/huella-bg.png" alt="huella" srcset="">
    <img class="huella huella_2" src="assets/ilustracion/huella-bg.png" alt="huella" srcset="">
    <img class="huella huella_3" src="assets/ilustracion/huella-bg.png" alt="huella" srcset="">
    <img class="huella huella_4" src="assets/ilustracion/huella-bg.png" alt="huella" srcset="">
    <img class="huella huella_5--bottom" src="assets/ilustracion/huella-bg.png" alt="huella" srcset="">
    <img class="huella huella_6--bottom" src="assets/ilustracion/huella-bg.png" alt="huella" srcset="">
    <img class="huella huella_7--bottom" src="assets/ilustracion/huella-bg.png" alt="huella" srcset="">
    <img class="huella huella_8--bottom" src="assets/ilustracion/huella-bg.png" alt="huella" srcset="">
<input type="hidden" id="home">
        <div class="poster__description">
            <div class="">
                <h1 class="poster__description--h1 poster__description--h1--canva"><span class="poster__description--span poster__description--h1--canva">M</span><span class="poster__description--span2 poster__description--h1--canva">undo</span><br>Canino</h1>
            </div>
            <img class="poster__description--img poster__img--menor" src="assets/images/lococatHome.png" alt="gato">
            
            <p class="poster__description--p">Nuestra clinica veterinaria ofrece sus productos  y servicios con calidad en la ciudad de Cúcuta, nuestra amplia experiencia de nuestro médico certificado y  grupo  de trabajo sabemos darle a tu mascota lo mejor cuando lo  necesita, ven y contáctanos , conocénos como trabajamos para la salud y  bienestar de tu mascota.</p>
         
            
            <a class=" bottom bottom--orange bottom__serv" href="index.php?seccion=cita">Hacer una cita</a>
        </div>

        <img class="poster__description--img poster__img--mayor" src="assets/images/lococatHome.png" alt="gato">
        <!-- <div class="poster__description--box">
           
            <img class="poster__description--img" src="assets/images/lococatHome.png" alt="gato">
        </div> -->
</section>
<?php
$cTextosProductos = <<<SQL
SELECT 
	*
FROM
    productos
 WHERE espacio=? AND estado=1
SQL;
$stmtProd = $pdo->prepare($cTextosProductos);
// Especificamos el fetch mode antes de llamar a fetch()
$stmtProd->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
$dato_consulta = 'ad';
$stmtProd->execute([$dato_consulta]);
//$productos = $stmtProd->fetchAll();
//var_dump($productos);
?>
<section class="add">
    <h2 class="h2">!Ahorra con nuestras Ofertas¡</h2>
    <div class="add__container">
        <div class="carrusell">
<?php
$imagen_oferta = 'assets/iconos/oferta.png';
$box = 0;
while ($rowProductos = $stmtProd->fetch()) {
$box = $box + 1;
    $precio = $rowProductos["precio"];
    $descuento = $rowProductos["descuento"];
    $img = $rowProductos["foto"];
    $id = $rowProductos["idproductos"];
?>
            <div class="add__container--box add__containerBox--width"   id="box<?php echo $box; ?>">
                <img class="oferta__descuento--img ad__oferta" src="<?php echo $imagen_oferta; ?>" alt="oferta">
                <p class="oferta__descuento ad__desc" >
                <?php echo $descuento;?></p>
                <span class="oferta__descuento--dto ad__span">D.to</span>
                <a href="index.php?seccion=producto&idProd=<?php echo $id; ?>" class="a__ad">
                
                    <img class="ad__img" src="admin/<?php echo $img; ?>" alt="imagenProducto">
                    <div class="add__containerBox--description">
                        <div class="add__containerBoxDescription">
                            <p class="add__containerBox--p">$<?php echo $precio; ?></p>
                        </div>
                    </div>
                </a>
            </div>
<?php
        };
?>
            <!-- <div class="add__container--box " id="box2">
            <a href="index.php?seccion=productos">
                <img class="add__containerOfert--img" src="assets/images/20.png" alt="">
                <img class="add__containerImg" src="assets/images/guacal.png" alt="">
                <div class="add__containerBox--description">
                    <div class="add__containerBoxDescription">
                        <p class="add__containerBox--p">$ 25.000</p>
                    </div>
                </div>
            </a>
            </div>
            <div class="add__container--box " id="box3">
                <a href="index.php?seccion=productos">
                    <img class="add__containerOfert--img" src="assets/images/20.png" alt="">
                    <img class="add__containerImg" src="assets/images/guacal.png" alt="">
                    <div class="add__containerBox--description">
                        <div class="add__containerBoxDescription">
                            <p class="add__containerBox--p">$ 25.000</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="add__container--box " id="box4">
                <a href="index.php?seccion=productos">
                    <img class="add__containerOfert--img" src="assets/images/20.png" alt="">
                    <img class="add__containerImg" src="assets/images/guacal.png" alt="">
                    <div class="add__containerBox--description">
                        <div class="add__containerBoxDescription">
                            <p class="add__containerBox--p">$ 25.000</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="add__container--box " id="box5">
                <a class="a__Add" href="index.php?seccion=productos">
                    <img class="add__containerOfert--img" src="assets/images/20.png" alt="">
                    <img class="add__containerImg" src="assets/images/guacal.png" alt="">
                    <div class="add__containerBox--description">
                        <div class="add__containerBoxDescription">
                            <p class="add__containerBox--p">$ 25.000</p>
                        </div>
                    </div>
                </a>
            </div>
                <div class="add__container--box " id="box6">
                    <a href="index.php?seccion=productos">
                        <img class="add__containerOfert--img" src="assets/images/20.png" alt="">
                        <img class="add__containerImg" src="assets/images/guacal.png" alt="">
                        <div class="add__containerBox--description">
                            <div class="add__containerBoxDescription">
                                <p class="add__containerBox--p">$ 25.000</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="add__container--box " id="box7">
                    <a href="index.php?seccion=productos">
                            <img class="add__containerOfert--img" src="assets/images/20.png" alt="">
                            <img class="add__containerImg" src="assets/images/guacal.png" alt="">
                            <div class="add__containerBox--description">
                                <div class="add__containerBoxDescription">
                                    <p class="add__containerBox--p">$ 25.000</p>
                                </div>
                            </div>
                    </a>
                    </div>
            <div class="add__container--box " id="box8">
                <a href="index.php?seccion=productos">
                    <img class="add__containerOfert--img" src="assets/images/20.png" alt="">
                    <img class="add__containerImg" src="assets/images/guacal.png" alt="">
                    <div class="add__containerBox--description">
                        <div class="add__containerBoxDescription">
                            <p class="add__containerBox--p">$ 25.000</p>
                        </div>
                    </div>
                </a>
            </div>
                <div class="add__container--box " id="box9">
                    <a href="index.php?seccion=productos">
                        <img class="add__containerOfert--img" src="assets/images/20.png" alt="">
                        <img class="add__containerImg" src="assets/images/guacal.png" alt="">
                        <div class="add__containerBox--description">
                            <div class="add__containerBoxDescription">
                                <p class="add__containerBox--p">$ 25.000</p>
                            </div>
                        </div>
                    </a>
                </div> -->
            </div>
    </div>
</section>

<?php
$cTextosPreview = <<<SQL
SELECT 
	*
FROM
    publicaciones
WHERE categoria = :categoria 
OR  idpublicaciones =:id1
OR idpublicaciones =:id2
SQL;
$id1 = 54;
$id2 = 56;
$stmtpreview = $pdo->prepare($cTextosPreview);
// Especificamos el fetch mode antes de llamar a fetch()
$stmtpreview->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
$stmtpreview->bindParam(':categoria', $categroia, PDO::PARAM_STR);
$stmtpreview->bindParam(':id1', $id1, PDO::PARAM_STR);
$stmtpreview->bindParam(':id2', $id2, PDO::PARAM_STR);
try {
    $stmtpreview->execute();
    //code...
} catch (\Throwable $th) {
    echo $th;
}
$valueP;
while ($rowpreview = $stmtpreview->fetch()){
    $tituloP = $rowpreview['titulo'];
    $descripcionP = $rowpreview['descripcion'];
    if(strlen($descripcionP) > 70) {
        $valueP = substr($descripcionP, 0, 200) . '...';
    }
    $foto = $rowpreview['foto'];
    $idP = $rowpreview['idpublicaciones'];
?>
    <section class="container poster poster__vacunacion"> 
    <img class="responsiveDiv img__servicio-prevM" src="admin<?php echo $foto; ?>" alt="gato">
        <div class="poster__description--servicio">
            <h2 class="poster__description--h1 poster__description--h1--canva poster__p--servicio"><?php echo $tituloP; ?></h2>
            <img class="responsiveDiv img__servicio-prevm" src="admin<?php echo $foto; ?>" alt="gato">
            <p class="poster__description--p "><?php echo $valueP; ?></p> 
            
            <div class="bottom bottom__big--div bottom__big bottom--orange">
                <a class="bottom bottom__big--a bottom__big bottom--orange" href="index.php?seccion=servicio&id=<?php echo $idP; ?>">Saber Mas</a>
            </div>
        </div>
        
    </section>
<?php
};
?>
<section class="position__section corp">
    <div class="corp__header">
        <h1 class="h2 poster__description--h1">Valores Corporativos</h1>
        <img class="corp__header--img" src="assets/iconos/valor.png" alt="valor">

    </div>
    <div class="corp__container">
        <div class="corp__container--box">
            <div>
                <img class="corp__container--img" src="assets/iconos/res.png" alt="responsabilidad">
            </div>
            <div class="corp__container--desc">
                <h2 class="h2 h2--servicios corp__h2">Responsabilidad</h2>
                <p class="poster__description--h1 copr__h1">Nuestro trabajo  es usar la medicina preventiva para el tratamiento médico preventivo, curativo o quirúrgico, la prescripción de vacunas, medicamentos y cualquier otro tratamiento para conservar la salud en los animales y  evitar la transmision de enfermerdades zoonoticas a su familia.</p>
            </div>
        </div>
        <div class="corp__container--box">
            <div>
                <img class="corp__container--img" src="assets/iconos/love.png" alt="responsabilidad">
            </div>
            <div class="corp__container--desc">
                <h2 class="h2 h2--servicios corp__h2">Amor</h2>
                <p class="poster__description--h1 copr__h1">El amor por los animales es tan grande que acaban siendo uno más en la familia, por eso, es nuestro  valor fundamental para nuestro servicio fomentando el principìo de todo cambio  social.</p>
            </div>
        </div>
        <div class="corp__container--box">
            <div>
                <img class="corp__container--img" src="assets/iconos/coh.png" alt="responsabilidad">
            </div>
            <div class="corp__container--desc">
                <h2 class="h2 h2--servicios corp__h2">Coherencia</h2>
                <p class="poster__description--h1 copr__h1">Como agente de coherencia con la realidad del conocimiento de la medicina veterinaria, bienestar y salud animal, seguridad alimentaria y salud pública mantenemos nuestro pensar, hablar y  actuar con el fin de promover la salud  e integridad de nustras mascotas.</p>
            </div>
        </div>
        <div class="corp__container--box">
            <div>
                <img class="corp__container--img" src="assets/iconos/respeto.png" alt="responsabilidad">
            </div>
            <div class="corp__container--desc">
                <h2 class="h2 h2--servicios corp__h2">Respeto</h2>
                <p class="poster__description--h1 copr__h1">
                    Son claves para conseguir un cuidado más respetuoso de los animales en nuestro  centro veterinario  Mndo  Canino y brindar  una mejor atención a los propietarios, respentando  todos los puntos de vista de nuestro equipo  y  clientes.</p>
            </div>
        </div>
        <div class="corp__container--box">
            <div>
                <img class="corp__container--img" src="assets/iconos/compromiso.png" alt="responsabilidad">
            </div>
            <div class="corp__container--desc">
                <h2 class="h2 h2--servicios corp__h2">Compromiso</h2>
                <p class="poster__description--h1 copr__h1">Porque ser médico veterinario tiene grandes alcances en nuestra sociedad; y detrás de una mascota sana, de la salud pública, nuestro compromiso es contribuir al bienestar animal vocación al servicio de toda la comunidad. </p>
            </div>
        </div>
        <div class="corp__container--box">
            <div>
                <img class="corp__container--img" src="assets/iconos/pers.png" alt="responsabilidad">
            </div>
            <div class="corp__container--desc">
                <h2 class="h2 h2--servicios corp__h2">Perseverancia</h2>
                <p class="poster__description--h1 copr__h1">Nuestro trabajo es usar la medicina preventiva para el tratamiento médico preventivo, curativo o quirúrgico, la prescripción de vacunas, medicamentos y cualquier otro tratamiento para el bienestar de tu mascota.</p>
            </div>
        </div>
        
    </div>
</section>
<section class="position__section">

    <div class="box--serv">
        <div class="box__serv--tittle">
            <img class="icon__serv" src="assets/iconos/emergencia.png" alt="emergencia" srcset="">
            <div>
                <h1 class="poster__description--span size__h1--serv" >Emergencias</h1>
                <h2 class="poster__description--span2 h2__serv" >Atencion Inmediata</h2>
            </div>
        </div>
        <div class="description--emer">
            <p class="p__serv--e" >En nuestra Clinica Mundo Canino siempre estaremos dispuesto a atender a tu mascota cuando mas  lo necesita, por lo que nuestro servicio de urgencias de 24 horas sigue abierto. Antes de venir llamar a los siguientes numeros: </p>
            <div class="box--serv__phone">
                <img class="icon__phone" src="assets/iconos/phone.png" alt="phone" srcset="">
                <p class=" p__serv--e" >3153704398 - 3002130903</p>
            </div>
         
                    <a class="bottom bottom__big--a bottom__big bottom--orange bottom__serv" href="index.php?seccion=cita">Agendar Cita</a>
            
        </div>
        
    </div>
    <div class="poster_3 urgencias__none">

</div>
<img class=" img__urgencias urgencias__block urgencias__none" src="assets/images/revicion.jpg" alt="urgencias">
</section>
<section>
    <div class="ifrem">
        <div>
            <h2 class="h2">Ubicanos</h2>
        </div>
           <div class="ifrem--box">
                <iframe  src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d988.0085736749793!2d-72.49630073050395!3d7.8914809995082065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zN8KwNTMnMjkuMyJOIDcywrAyOSc0NC40Ilc!5e0!3m2!1ses!2sco!4v1686268363796!5m2!1ses!2sco" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
</section>

