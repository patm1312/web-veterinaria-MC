<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else{
        $_SESSION['rta_admin'] = "error";
        echo "<script>window.location.href='../../../index.php?seccion=AdminPublicaciones&accion=editarp&id=$id'</script>";
    }
    $cTextosMA = <<<SQL
    SELECT 
        *
    FROM
        PAdopta
    WHERE idPAdopta =?
    SQL;
try {
    $stmtMA = $pdo->prepare($cTextosMA);
    // Especificamos el fetch mode antes de llamar a fetch()
    //$stmt->fetch(PDO::FETCH_ASSOC);
    $stmtMA->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    $stmtMA->execute([$id]);
    //$rowM = $stmtM->fetch();
    //var_dump($rowM);
    $rowMA= $stmtMA->fetch();
} catch (\Throwable $th) {
    echo $th;
}
?>


    
<div class="info__personal">
<a href="index.php?seccion=adopta&seccionA=home">home</a>
<a>/</a>
<a href="index.php?seccion=adopta&seccionA=petA&id=<?php echo $id; ?>">Mascota</a>
            <div>
                <div class="box_linedonwn">
                    <h1 class="h2 h2__perfil">Datos de Mascota</h1>
                </div>
                <div class="img_perfil">
                    <img class="img_perfil--img" src="admin<?php echo $rowMA['foto'];?>" alt="pencil editar">
                </div>
            </div>
            <div class="info__personal--info">
                <table class="table">
                    <tr  class="tr">
                        <th class="th">NOMBRE</th>
                        <td class="td" ><?php echo $rowMA["nombre"];  ?></td>
                    </tr>
                    <tr class="tr">
                        <th class="th">Edad</th>
                        <td class="td" >
                            <?php
                              $fecha_nacimiento = $rowMA["fechaNac"];
                              $e = busca_edad($fecha_nacimiento);
                              echo $e[0] . ' años ' . ' y ' .  $e[1]  . ' meses';
                            ?>
                        </td>
                    </tr>
                    <tr class="tr">
                        <th class="th">Raza</th>
                        <td class="td" ><?php echo $rowMA['raza'];?></td>
                    </tr>
                    <tr class="tr">
                        <th class="th">Sexo:</th>
                        <td class="td" ><?php echo $rowMA['sexo'];?></td>
                    </tr>
                    <tr class="tr">
                        <th class="th">Color</th>
                        <td class="td" ><?php echo $rowMA['color'];?></td>
                    </tr>
                    <tr class="tr">
                        <th class="th">Tamaño</th>
                        <td class="td" ><?php echo $rowMA['tamanio'];?></td>
                    </tr>
                    <tr class="tr">
                        <th class="th">Especie:</th>
                        <td class="td" ><?php echo $rowMA['especie'];?></td>
                    </tr>
                    <tr class="tr">
                        <th class="th">Esterilizado:</th>
                        <td class="td" ><?php echo $rowMA['esterilizado'];?></td>
                    </tr>
                    
                </table>
            </div>
        </div>