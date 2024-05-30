<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else{
        $_SESSION['rta_admin'] = "error";
        echo "<script>window.location.href='../../../index.php?seccion=AdminPublicaciones&accion=editarp&id=$id'</script>";
    }
    $cTextosMascota = <<<SQL
    SELECT 
        *
    FROM
        pacientes
    WHERE idpacientes =?
    SQL;
try {
    $stmtM = $pdo->prepare($cTextosMascota);
    // Especificamos el fetch mode antes de llamar a fetch()
    //$stmt->fetch(PDO::FETCH_ASSOC);
    $stmtM->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    $stmtM->execute([$id]);
    //$rowM = $stmtM->fetch();
    //var_dump($rowM);
    $rowM = $stmtM->fetch();
} catch (\Throwable $th) {
    echo $th;
}
?>


    
<div id="abrir_imagen" class="info__personal">
            <div>
                <div class="box_linedonwn">
                    <h1 class="h2 h2__perfil">Datos de Mascota</h1>
                    <a href="index.php?seccion=perfil&seccionUser=updateMascota&id=<?php echo $id; ?>">
                        <div class="box_linedonwn--editar">
                            <p class="h2__perfil">Editar</p>
                            <img src="assets/images/editar.png" alt="editar">
                        </div>
                    </a>
                    
                </div>
                <div class="img_perfil">
                    <img class="img_perfil--img" src="admin<?php echo $rowM['foto'];?>" alt="pencil editar">
                </div>
            </div>
            <div class="info__personal--info">
                <table class="table">
                    <tr  class="tr">
                        <th class="th">NOMBRE</th>
                        <td class="td" ><?php echo $rowM["nombre"];  ?></td>
                    </tr>
                    <tr class="tr">
                        <th class="th">Edad</th>
                        <td class="td" >
                            <?php 
                                $fecha_nacimiento = $rowM["fechaNac"];
                                $e = busca_edad($fecha_nacimiento);
                                echo $e[0] . ' años ' . ' y ' .  $e[1]  . ' meses';
                            ?>
                        </td>
                    </tr>
                    <tr class="tr">
                        <th class="th">Raza</th>
                        <td class="td" ><?php echo $rowM['raza'];?></td>
                    </tr>
                    <tr class="tr">
                        <th class="th">Sexo:</th>
                        <td class="td" ><?php echo $rowM['sexo'];?></td>
                    </tr>
                    <tr class="tr">
                        <th class="th">Color</th>
                        <td class="td" ><?php echo $rowM['color'];?></td>
                    </tr>
                    <tr class="tr">
                        <th class="th">Tamaño</th>
                        <td class="td" ><?php echo $rowM['talla'];?></td>
                    </tr>
                    <tr class="tr">
                        <th class="th">Especie:</th>
                        <td class="td" ><?php echo $rowM['especie'];?></td>
                    </tr>
                    <tr class="tr">
                        <th class="th">Esterilizado:</th>
                        <td class="td" ><?php echo $rowM['esterilizado'];?></td>
                    </tr>
                    
                </table>
            </div>
        </div>
        <div class="info__mascotas">
            <div class="box_linedonwn">
                <h1 class="h2 h2__perfil">Plan de Vacunacion</h1>
            </div>
            <div class="producto">
                <?php 
                    $variable = $rowM["especie"];
                    if($variable == 'gato'){
                        $cTextosV = <<<SQL
                        SELECT 
                            *
                        FROM
                            PlanVacunacion
                        WHERE idpacientes =?
                        SQL;
                        $stmtV = $pdo->prepare($cTextosV);
                        // Especificamos el fetch mode antes de llamar a fetch()
                        //$stmtV->fetch(PDO::FETCH_ASSOC);
                        $stmtV->setFetchMode(PDO::FETCH_ASSOC);
                          // Ejecutamos
                          $stmtV->execute([$id]);
                            $rowV = $stmtV->fetch();
                            $tituloTabla;
                        if( $rowV){
                            $tituloTablaV = ' de ' . $rowV["nombre"];
                        }else{
                            $tituloTablaV = '';
                        }
                        include("institucion/estandarVacunacion/vacunaciongato.php");
                    }else if($variable == 'perro'){
                        $cTextosH = <<<SQL
                        SELECT 
                            *
                        FROM
                            PlanVacunacion
                        WHERE idpacientes =?
                        SQL;
                        $stmtV = $pdo->prepare($cTextosH);
                        // Especificamos el fetch mode antes de llamar a fetch()
                        //$stmtV->fetch(PDO::FETCH_ASSOC);
                        $stmtV->setFetchMode(PDO::FETCH_ASSOC);
                        // Ejecutamos
                            $stmtV->execute([$id]);
                            $rowV = $stmtV->fetch();
                            $tituloTablaV;
                        if( $rowV){
                            $tituloTablaV = ' de ' . $rowV["nombre"];
                        }else{
                            $tituloTablaV = '';
                        }
                        include("institucion/estandarVacunacion/vacunacionperro.php");
                    }
                ?>
                </div>
            <div class="box_linedonwn">
                <h1 class="h2 h2__perfil">Plan de Desparacitacion</h1>
            </div>
            <?php 
                $cTextosDesp = <<<SQL
                SELECT 
                    *
                FROM
                    PlanDesparacitacion
                WHERE pacientes_idpacientes = ?
                SQL;
                $stmtDesp = $pdo->prepare($cTextosDesp);
                // Especificamos el fetch mode antes de llamar a fetch()
                //$stmtV->fetch(PDO::FETCH_ASSOC);
                $stmtDesp->setFetchMode(PDO::FETCH_ASSOC);
                // Ejecutamos
                try {
                    $stmtDesp->execute([$id]);
                } catch (\Throwable $th) {
                    echo $th;
                }
                    $rowDesp = $stmtDesp->fetch();
                    include("institucion/estandarVacunacion/desparacitacion.php");
                ?>
            <!-- <table class="tableVac">
                    <tr  class="trVac">
                        <th class="thVac" >
                            <img class="imgVac" src="assets/images/catVac.png" alt="dog">
                        </th>
                        <th class="thVac thVac--tittle" colspan="5">
                            <span class="tittleTable poster__description--span poster__description--h1--canva">C</span><span class="tittleTable poster__description--span2 poster__description--h1--canva">alendario  de Desparacitacion</span>
                        </th>
                    </tr>
                    <tr  class="trVac">
                        <th class="thVac thVac--color">Frecuencia</th>
                        <th class="thVac thVac--color">Dosis</th>
                        
                    </tr>
                    <tr class="trVac ">
                        <th class="thVac thVac--block">21 Dias</th>
                        <td class="tdVac " ></td>
                    </tr>
                    <tr class="trVac">
                        <th class="thVac thVac--block">Semana 5</th>
                        <td class="tdVac " ></td>
                    </tr>
                    <tr class="trVac">
                        <th class="thVac thVac--block">Semana 7</th>
                        <td class="tdVac" ></td>
                    </tr>
                    <tr class="trVac">
                        <th class="thVac thVac--block">Semana 9</th>
                        <td class="tdVac" ></td>
                    </tr>
                    <tr class="trVac">
                        <th class="thVac thVac--block">3 meses</th>
                        <td class="tdVac" ></td>
                    </tr>
                    <tr class="trVac">
                        <th class="thVac thVac--block">4 meses</th>
                        <td class="tdVac" ></td>
                    </tr>
                    <tr class="trVac">
                        <th class="thVac thVac--block">5 meses</th>
                        <td class="tdVac" ></td>
                    </tr>
                    <tr class="trVac">
                        <th class="thVac thVac--block">Cada 3 Meses</th>
                        <td class="tdVac" ></td>
                    </tr>
                    <tr class="trVac">
                        <th class="thVac thVac--block">Proxima Dosis:</th>
                        <td class="tdVac"  ><span>rabia: fecha</span></td>
                    </tr>
                </table> -->
        </div>
  <div class="box_linedonwn">
                <h1 class="h2 h2__perfil">Certificados</h1>
            </div>
<div class="producto">
<?php
         $cTextosMH = <<<SQL
         SELECT 
             documentos
         FROM
             HistorialMedico
         WHERE pacientes_idpacientes =? AND documentos != "NULL"
         SQL;
     try {
         $stmtMH = $pdo->prepare($cTextosMH);
         // Especificamos el fetch mode antes de llamar a fetch()
         //$stmt->fetch(PDO::FETCH_ASSOC);
         $stmtMH->setFetchMode(PDO::FETCH_ASSOC);
         // Ejecutamos
         $stmtMH->execute([$id]);
         //$rowM = $stmtM->fetch();
         $rowMH = $stmtMH->fetchAll();
     } catch (\Throwable $th) {
         echo $th;
     }


     if($rowMH){
        foreach ($rowMH as $key => $value) {
            $documentos =  $value['documentos'];
            if($documentos != ''){
                $str = substr($documentos, -3);
                if($str == 'pdf'){
                    ?>
                    <a href="https://mundocaninovet.online/admin/contenidos/usuarios/assets/documents/view.php?file=<?php echo $documentos;?>" target="_blank">
                <img src="contenidos/user/assets/img/default/docs.png" alt="cruz">
            </a>
            <?php
                }else{
                    ?>
                    <a class="openImg" href="" >
                        <!-- //pongo el icono de una imagen, cuando el usuario  le di click se recupera la ruta guardada en el input oculto que se abre la imagen  -->
                        <img class="openImg" src="contenidos/user/assets/img/default/img.png" alt="preview">
                        <input  type="hidden" value="<?php echo $documentos;?>">
                    </a>
<?php
                }
            ?>
            <?php
            };
        }
     }else{
        echo 'No hay nada para mostrar';
     }
     ?>
     
 
</div>

