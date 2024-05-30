
<?php
if(isset($_GET['id'])){
    if(!empty($_GET['id'])){

        $cTextos = <<<SQL
SELECT 
	*
FROM
    publicaciones
WHERE idpublicaciones = ?
SQL;
$id = $_GET['id'];
$stmt = $pdo->prepare($cTextos);
// Especificamos el fetch mode antes de llamar a fetch()
$stmt->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
try {
    $stmt->execute([$id]);

    //code...
} catch (\Throwable $th) {
    echo $th;
}
$cTextosPs = <<<SQL
SELECT 
	*
FROM
    PServicio
WHERE publicaciones_idpublicaciones = ?
SQL;
$stmtPs = $pdo->prepare($cTextosPs);
// Especificamos el fetch mode antes de llamar a fetch()
$stmtPs->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
try {
    $stmtPs->execute([$id]);

    //code...
} catch (\Throwable $th) {
    echo $th;
}
    }else{

    }
}else{

}
?>

<section class="container container__block">
    <input type="hidden" id="producto">
    <?php
$cadenaT;
$letra1 ;
            while ($row = $stmt->fetch()){ 
                $titulo = $row['titulo'];
                $trimmed = trim($titulo);
                
                $first;       
                $longitud = mb_strlen($trimmed, 'UTF-8'); // Obtener la longitud del texto en caracteres UTF-8
                // Recorrer el texto e imprimir cada carácter
                
                for ($i = 0; $i < 1; $i++) {
                    $caracter = mb_substr($trimmed, $i, 1, 'UTF-8'); // Obtener el carácter en la posición $i
                    $first = $caracter;
                   
                }
                
                $cadenaT = str_replace($first, '', $trimmed);
           
        ?>
            <div class="poster__description">
                <h1 class="poster__description--h1 poster__description--h1--canva"><span class="poster__description--span poster__description--h1--canva"><?php echo $first; ?></span><span class="poster__description--span2 poster__description--h1--canva"><?php echo $cadenaT; ?></span><br></h1>
                <div class="publicacion">
                    <div class="foto__producto responsiveDiv">
                        <img class="foto" src="admin/<?php echo $row['foto']; ?>" alt="imagen">
                        
                    </div>
                    <p class="poster__description--p"><?php echo $row['descripcion']; ?></p>
                </div>
            </div>
            <?php
            $titulo;
            $subtitulo;
            $foto;
            $parrafo;
            if($stmtPs){
                try {
                    // $rowPs = $stmtPs->fetch();
                    //var_dump($rowPs);
                } catch (\Throwable $th) {
                    echo $th;
                }
                // foreach ($rowPs as $key => $value) {
                //     $titulo =  $rowPs['titulo'];
                //     $subtitulo=  $rowPs['subtitulo'];
                //     $foto =  $rowPs['imagen'];
                //     $parrafo =  $rowPs['parrafo'];
                   
                // };
                $syle  = 0;
                while ( $rowPs = $stmtPs->fetch()){
                // if($rowPs > 0){
                    $style += 1;
                  
            
                
            ?>
          
                    <article class="container container__block subservicio <?php echo $resultado =  $style%2==0  ? '' : 'subservicio__bg'; ?>">
                    <?php
                    if($style%2==0){
                        
                    ?>
                    
                    <?php
                    }else{
                        ?>
                    <img class="subservicio__hueso" src="assets/ilustracion/hueso.png" alt="imagen">
                    <?php
                    }
                    ?>
                        <h2 class="h2 line__down"><?php echo $rowPs['titulo']; ?></h2>
                                <h2 class="h2--servicios "><?php echo $rowPs['subtitulo']; ?></h2>
                        <div class="producto">   
                            <div class="foto__producto responsiveDiv">
                                    <img class="foto" src="admin/<?php echo $rowPs['imagen']; ?>" alt="imagen">
                            </div> 
                            <div class="descripcion__producto">  
                                <p class="poster__description--p poster__description--serv" ><?php echo $rowPs['parrafo']; ?></p>
                            </div>
                        </div>
                    </article>
                <?php
                };
                ?>

<?php

            };
?>
            </section>
<?php

        };
?>
