<?php
$sectionAdopta = isset($_GET['seccionA']) ? $_GET['seccionA']:'home';
// if(isset($_GET['seccionA'])){
//     $sectionAdopta = isset($_GET['seccionA']);
// }else{
//     $sectionAdopta = 'home';

// }
$cTextosAdopta = <<<SQL
SELECT 
	*
FROM
    publicaciones
WHERE categoria = 'Padopta'
SQL;
$stmtAdopta = $pdo->prepare($cTextosAdopta);
// Especificamos el fetch mode antes de llamar a fetch()
$stmtAdopta->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
try {
    $stmtAdopta->execute();
    //code...
} catch (\Throwable $th) {
    echo $th;
}
?>
<section class="container container__block">
<!-- <a href="index.php?seccion=adopta&seccionA=home">home</a> -->
    <input type="hidden" id="adopta_mascota">
            <div class="poster__description">
                <h1 class="poster__description--h1 poster__description--h1--canva"><span class="poster__description--span poster__description--h1--canva">A</span>dopta o <span class="poster__description--span2 poster__description--h1--canva">Apadrina</span><br></h1>
                <?php
    $enlace;
    while ($rowAdopta = $stmtAdopta->fetch()){
        $parrafo= $rowAdopta['descripcion'];
?>
                <p class="poster__description--p"><?php echo $parrafo; ?></p>
            </div>
    
<?php
    };
    try {
        include("contenidos/contenido_servicios/contenido__adopta/home.php");
        //code...
    } catch (\Throwable $th) {
        echo $th;
    }
    switch($sectionAdopta){
        case "home": include("contenidos/contenido__servicios/contenido_adopta/home.php");
        break;
        case "petA": include("contenidos/contenido__servicios/contenido_adopta/pets.php");
        break;
        default: 
            echo "<p class='error'>La sección solicitada ($section), no existe</p>";
            include( 'contenidos/contenido__servicios/contenido_adopta/home.php"');
    }
?>

</section>