
        <div class="info__personal">
            <div>
                <div class="box_linedonwn">
                    <h1 class="h2 h2__perfil">Datos Personales</h1>
                    <a href="index.php?seccion=perfil&seccionUser=updateUser">
                        <div class="box_linedonwn--editar">
                            <p class="h2__perfil">Editar</p>
                            <img src="assets/images/editar.png" alt="editar">
                        </div>
                    </a>
                    
                </div>
                <div class="img_perfil">
                    <img src="<?php echo $rutaFotoP; ?>" class="img_perfil--img"  alt="imagen_usuario">
                </div>
            </div>

            <div class="info__personal--info">
       
                <table class="table">
                    <tr  class="tr">
                        <th class="th">NOMBRE</th>
                        <td class="td" ><?php echo $rowU['nombre']; ?></td>
                    </tr>
                    <tr class="tr">
                        <th class="th">APELLIDO</th>
                        <td class="td" ><?php echo $rowU['apellido']; ?></td>
                    </tr>
                    <tr class="tr">
                        <th class="th">TELEFONO</th>
                        <td class="td" ><?php echo $rowU['telefono']; ?></td>
                    </tr>
                    <tr class="tr">
                        <th class="th">TELEFONO SECUNDARIO</th>
                        <td class="td" ><?php echo $rowU['telefonosecundario']; ?></td>
                    </tr>
                    <tr class="tr">
                        <th class="th">correo</th>
                        <td class="td" ><?php echo $rowU['email']; ?></td>
                    </tr>
                    <tr class="tr">
                        <th class="th">direccion</th>
                        <td class="td" ><?php echo $rowU['direccion']; ?></td>
                    </tr>
                </table>
                <!-- <p class="info" > <span>Nombredepersona</span></p>
                <p class="info" > <span>Nombredepersona</span></p>
                <p class="info" >TELEFONO <span>Nombredepersona</span></p>
                <p class="info" >TELEFONO SECUNDARIO <span>Nombredepersona</span></p>
                <p class="info" >CORREO <span>Nombredepersona</span></p>
                <p class="info" >DIRECCION <span>Nombredepersona</span></p> -->
            </div>
        </div>

        <div class="info__mascotas">
            <div class="box_linedonwn">
                <h1 class="h2 h2__perfil">Mis Mascotas</h1>
            </div>

            <div class="box__flex">
            <?php
$cTextosMascota = <<<SQL
SELECT 
    *
FROM
    pacientes
WHERE usuario_idusuario =? AND estado = 1
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
     <?php
     
    while ($rowM = $stmtM->fetch()){
        $id = $rowM['idpacientes'];
?>
               <a class="box__flex-item box__flex-item--t" href="index.php?seccion=perfil&seccionUser=pets&id=<?php echo $id; ?>">
                    <div class="preview_mascota">
                        <img class="mascota_previewimg"  src="admin<?php echo $rowM["foto"]; ?>" alt="preview_mascota">
                        
                    </div>
                    <h1 class="preview_mascota--h1"><?php echo $rowM["nombre"];  ?></h1>
                </a>
                <?php
    };

?>  
                <a class="box__flex-item" href="index.php?seccion=perfil&seccionUser=petsAdd">
                    <div class="preview_mascota">
                        <img class="mascota_previewimg"  src="assets/images/addpet.png" alt="preview_mascota">
                        <h1>Registrar</h1>
                    </div>
                </a>
    
            </div>
                
        </div>
