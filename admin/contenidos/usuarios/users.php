<?php
    //pagina quese envia a travez de get cuando plso sobre la numeracion de  lapagina al final. (pag.1, pag.2 ...)
    $pagina_actual = isset( $_GET['p'] ) ? $_GET['p'] : 1;
    $cantPorPagina = 15;
    //devuelve la cantidad de usuarios 
    //$cTextos2 = "SELECT COUNT(idusuario) AS TOTAL FROM usuarios";
$search;
    if(isset($_POST['search']) || (isset($_SESSION['search']))){
        if((!empty($_POST['search'])) || (!empty($_SESSION['search']))){
            if(!empty($_POST['search'])){
                $search = $_POST['search'];
                $_SESSION['search'] = $search;
                $search = '' . $search . '';
            }
            if(!empty($_SESSION['search'])){
                $search = $_SESSION['search'];
                $search = '' . $search . '';
            }
            $_SESSION['search'] = $search;
            $cTextos2 = <<<SQL
            SELECT 
                COUNT(idusuario) AS TOTAL
            FROM
                usuarios
            WHERE nombre=:nombre
            SQL;
        }else{
            $cTextos2 = <<<SQL
            SELECT 
                COUNT(idusuario) AS TOTAL
            FROM
                usuarios
            SQL;
        }
    }else{
        $cTextos2 = <<<SQL
            SELECT 
                COUNT(idusuario) AS TOTAL
            FROM
                usuarios
            SQL;
    }
try {
    $stmt2 = $pdo->prepare($cTextos2);
    // Especificamos el fetch mode antes de llamar a fetch()
    $stmt2->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    if(!empty($search)){
        $stmt2->bindParam(':nombre', $search, PDO::PARAM_STR);
    }
    $stmt2->execute();
} catch (\Throwable $th) {
    echo $th;
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
    $cTextos;
    //para el buscador, si existe un buscador, se enviara la palabra a buscar  por emdio  del formulario, aqui se guarda y se almacena en una variable de session , con el fin de que el la misma busqueda sea vigente en los botones de paginador, 
    if(isset($_POST['search']) || (isset($_SESSION['search']))){
        if((!empty($_POST['search'])) || (!empty($_SESSION['search']))){
            if(!empty($_POST['search'])){
                $search = $_POST['search'];
                $_SESSION['search'] = $search;
                $search = '' . $search . '';
            }
            if(!empty($_SESSION['search'])){
                $search = $_SESSION['search'];
                $search = '' . $search . '';
            }
            $_SESSION['search'] = $search;
            $cTextos = <<<SQL
            SELECT 
                *
            FROM
                usuarios
            WHERE nombre=:nombre
            LIMIT $dondeInicio, $cantPorPagina
            SQL;
        }else{
            $cTextos = <<<SQL
            SELECT 
                *
            FROM
                usuarios
            LIMIT $dondeInicio, $cantPorPagina
            SQL;
        }
    }else{
        $cTextos = <<<SQL
            SELECT 
                *
            FROM
                usuarios
            LIMIT $dondeInicio, $cantPorPagina
            SQL;
    }

    $stmt = $pdo->prepare($cTextos);
    // Especificamos el fetch mode antes de llamar a fetch()
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    if(!empty($search)){
        $stmt->bindParam(':nombre', $search, PDO::PARAM_STR);
    }
    $stmt->execute();
?>
    <div id="search" class="info__personal border_prueba--contenedor"> 
        <input type="hidden" id="homeAdmin">

        <div class="info__personal--info dog border_prueba">
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
<?php
try {
    // function buscaedad(){
    //     echo 'edad';
    //    }
} catch (\Throwable $th) {
    echo $th;
}
$idM;
    while ($rowM = $stmtM->fetch()){
    $idM = $rowM["idpacientes"];
    
?>
<p class='bottom__gray bottom__gray--margin'>Datos  de <?php echo $rowM["nombre"];  ?></p>
                <div class="producto">
                    <table class='tableVac '>
                        <tr  class='trVac'>
                            <th colspan="3" class='thVac thVac--color'><?php echo $rowM["nombre"];  ?></th>
                        </tr>
                        <tr class='trVac'>
                            <th rowspan="8" class='thVac thVac--block'>
                                <!-- <img src="./contenidos/usuarios/assets/imgMascotas/1701913347854.png" alt="yy"> -->
                                <img class="openImg mascota_previewimg" src=".<?php echo $rowM["foto"];  ?>" alt="previewfoto">
                            </th>
                        </tr>
                        <tr class='trVac'>
                            <th class='thVac thVac--block'>Nombre</th>
                            <td class='tdVac tdVac--color' ><?php echo $rowM["nombre"];  ?></td>
                        </tr>
                        <tr class='trVac'>
                            <th class='thVac thVac--block'>Raza</th>
                            <td class='tdVac tdVac--color' >
                                <?php echo $rowM["raza"]; ?>
                            </td>
                        </tr>
                        <tr class='trVac'>
                            <th class='thVac thVac--block'>Color</th>
                            <td class='tdVac tdVac--color' ><?php echo $rowM["color"];  ?></td>
                        </tr>
                        <tr class='trVac'>
                            <th class='thVac thVac--block'>Edad</th>
                            <td class='tdVac tdVac--color' >
                                <?php 
                                $fecha_nacimiento = $rowM["fechaNac"];
                                $e = busca_edad($fecha_nacimiento);
                                echo $e[0] . ' años ' . ' y ' .  $e[1]  . ' meses';
                                 ?> 
                            </td>
                        </tr>
                        <tr class='trVac'>
                            <th class='thVac thVac--block'>Fecha Registro:</th>
                            <td class='tdVac tdVac--color' ><?php echo $rowM["fechaAlta"];  ?></td>
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
<?php
    $cTextosH = <<<SQL
    SELECT 
        *
    FROM
        HistorialMedico
    WHERE pacientes_idpacientes =? AND estado=1
    SQL;

    $stmtH = $pdo->prepare($cTextosH);
    // Especificamos el fetch mode antes de llamar a fetch()
    //$stmt->fetch(PDO::FETCH_ASSOC);
    $stmtH->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
        $stmtH->execute([$idM]);
        //$rowH = $stmtH->fetch();
        $tituloTabla;
  if($stmtH){
    $tituloTabla = 'Historias clinicas de '. $rowM["nombre"];
  }else{
    $tituloTabla = 'Historias Clinicas de ' . $rowM["nombre"];
  }
  $rowH = $stmtH->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- //como tien el atributo x-data, alpine lo tratara como un componente, alpine la variable open con el valor true, se ejecuta la funcion data, con el metodo resize , escuche cuando la ventana se rdimensiona, con el modificador window, con la variable open, se inicializa en true,  cada vez que se cambia la dimesnion se cambia el valor de la variable..-->
<!-- utilizo operador ternario, donde verifico el ancho de la pantalla si es mayor a 768px, accediendo a la propiedad outerWidth, si es verdadeero, es true y  si es falso es false: x-data="{open: true}" @resize.window="open = window.outerWidth > 768 ? true :false" , x-show="!open" , x-show="open"-->
                <div id="Hmedico"  class="producto" >
                    <!-- tabla se muestra en pantallas pequeñas -->
                    <!-- con la directiva x-show de alpnie muestro esta tabla si es  falso com valor en la variableopen -->
                    <table class="HmedicoS noneH" id="" >
                    <tr>
                            <th class='thVac--admin' colspan="12"><?php echo $tituloTabla;  ?></th>
                        </tr>
                        <?php
                        if( $stmtH){
                            $hospitalizacion;
                            foreach ($rowH as $key => $value) {
                                $diagnostico =  $value['diagnostico'];
                                $fechaIngreso =  $value['fechaIngreso'];
                                $hospitalizacion =  $value['hospitalizacion'];
                                $fechaAlta =  $value['fechaAlta'];
                                $documentos =  $value['documentos'];
                                $prescripciones = $value['prescripciones'];
                                $fechaRegistro =  $value['fechaRegistro'];
                                $fechaUpdate =  $value['fechaUpdate'];
                                $id =  $value['idHistorialMedico'];
                        ?>
                        <tr class='trVac--admin'>
                            <td class='tdVac--admin tdVac--admin--responsive'>
                                <div>
                                    <h2>Fecha de Registro:</h2>
                                    <p class="tdVac--admin--p" ><?php echo $fechaRegistro;  ?></p>
                                </div>
                                <div>
                                    <h2>Nombre:</h2>
                                    <p class="tdVac--admin--p" ><?php echo $rowM["nombre"];  ?></p>
                                </div>
                                <div>
                                    <h2 class="h2__table--responsive">Prescripciones:</h2>
                                    <p class="tdVac--admin--p" ><?php echo $prescripciones;  ?></p>
                                </div>
                                <div>
                                    <h2>Diagnostico:</h2>
                                    <p class="tdVac--admin--p" ><?php
                                     echo $diagnostico ; ?>
                                     </p>
                                </div>
                                <div>
                                    <h2>Hospitalizacion:</h2>
                                    <p class="tdVac--admin--p"><?php echo $hospitalizacion;  ?></p>
                                </div>
                                <div>
                                    <h2>Fecha de Ingreso:</h2>
                                    <p class="tdVac--admin--p" ><?php echo $fechaIngreso;  ?></p>
                                </div>
                                <div>
                                    <h2>Fecha de Alta:</h2>
                                    <p class="tdVac--admin--p" ><?php echo $fechaAlta;  ?></p>
                                </div>
                                <div>
                                    <h2>Documentos:</h2>
                                    <div class="acciones__table">
                                        <div class="acciones__table-editar" >
                                        
                                        </div>
                                        <div class="acciones__table-eliminar" >
                                            <?php
                                                if($documentos != ''){
                                                        $str = substr($documentos, -3);
                                                            if($str == 'pdf'){
                                                            ?>
                                                            <a href="https://mundocaninovet.online/admin/contenidos/usuarios/assets/documents/view.php?file=<?php echo $documentos;?>" target="_blank">
                                                            <img src="contenidos/usuarios/assets/imgDefault/docs.png" alt="cruz">
                                                            </a>
                                                         <?php
                                                            }else{
                                                            ?>
                                                            <a class="openImg" href="" >
                                                            <!-- //pongo el icono de una imagen, cuando el usuario  le di click se recupera la ruta guardada en el input oculto que se abre la imagen  -->
                                                            <img class="openImg" src="contenidos/publicaciones/assets/default/img.png" alt="preview">
                                                            <input  type="hidden" value="<?php echo $documentos;?>">
                                                            </a>
                                                            <?php
                                                                    }
                                                                ?>
                                                                                    
                                                             <a href="index.php?seccion=AdminUsuarios&accion=deleteDoc&idH=<?php echo $id;?>&file=<?php echo $documentos;?>">
                                                            <img src="../assets/images/cruz.png" alt="cruz">
                                                                                    </a>
                                                                                    <?php
                                                                                    };
                                                                                    ?>
                                            
                                        </div>
                                </div>





                               </div>
                               </div>
                                <div>
                                    <h2>Ultima Actualizacion:</h2>
                                    <p class="tdVac--admin--p" ><?php echo $fechaUpdate ;  ?></p>
                                </div>
                                <div>
                                    <h2>Estado:</h2>
                                    <p class="tdVac--admin--p" ><?php echo $rowH["fechaUpdate"];  ?></p>
                                </div>
                        </td>
                            <td class='tdVac--admin'>
                                <div class="acciones__table">
                                    <div class="acciones__table-editar" >
                                        <a href="index.php?seccion=AdminUsuarios&accion=editarH&idH=<?php echo $id ;?>">
                                            <img src="../assets/images/lapiz.png" alt="lapiz">
                                        </a>
                                    </div>
                                    <div class="acciones__table-eliminar" >
                                        <a href="index.php?seccion=AdminUsuarios&accion=deleteH&idH=<?php echo $id;?>">
                                            <img src="../assets/images/cruz.png" alt="cruz">
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <?php
                                };
                            ?>
                        </tr>
                        <?php
                        }else{
                          
                        };
                        ?>
                           <tr>
                            <td colspan="12" class='td__admin--ps' >
                                <div class='aniadir'>
                                    <a href="index.php?seccion=AdminUsuarios&accion=addH&idP=<?php echo $rowM["idpacientes"];?>">
                                        <img src="../assets/images/mas.png" alt="mas">
                                        <p>añadir Historia</p>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <!-- //tabla que se muestra en pantallas grandes -->
                              <!-- con la directiva x-show de alpnie muestro esta tabla si es  true com valor en la variableopenclass="noneH" -->
                    <table id=""  class='HmedicoB table--admin noneH' >
                        <tr>
                            <th class='thVac--admin' colspan="12"><?php echo $tituloTabla;  ?></th>
                        </tr>
                        <?php
                        if( $stmtH){
                        ?>
                        <tr>
                            <th class='thVac--admin'>Numero</th>
                            <th class='thVac--admin'>fecha Registro:</th>
                            <th class='thVac--admin'>Nombre:</th>
                            <th class='thVac--admin'>Prescripciones:</th>
                            <th class='thVac--admin'>Diagnostico</th>
                            <th class='thVac--admin'>Hospitalizacion</th>
                            <th class='thVac--admin'>Fecha Ingreso:</th>
                            <th class='thVac--admin'>Fecha Alta</th>
                            <th class='thVac--admin'>Documentos</th>
                            <th class='thVac--admin'>Ultima Actualizacion:</th>
                            <th class='thVac--admin'>Estado:</th>
                            <th class='thVac--admin'>Acciones:</th>
                        </tr>
                        <?php
                        
                        foreach ($rowH as $key => $value) {
                            $fechaIngreso =  $value['fechaIngreso'];
                            $hospitalizacion =  $value['hospitalizacion'];
                            $fechaAlta =  $value['fechaAlta'];
                            $documentos =  $value['documentos'];
                            $prescripciones = $value['prescripciones'];
                            $diagnostico = $value['diagnostico'];
                            $fechaRegistro =  $value['fechaRegistro'];
                            $fechaUpdate =  $value['fechaUpdate'];
                            $id =  $value['idHistorialMedico'];
                        ?>
                        <tr class='trVac--admin'>
                            <td class='tdVac--admin' >
                            </td>
                            <td class='tdVac--admin td_h' ><p><?php echo $fechaRegistro;  ?></p></td>
                            <td class='tdVac--admin td_h' ><p><?php echo $rowM["nombre"];  ?></p></td>
                            <td class='tdVac--admin td_h' ><p><?php echo $prescripciones;  ?></p></td>
                            <td class='tdVac--admin td_h' ><p><?php echo $diagnostico;  ?></p></td>
                            <td class='tdVac--admin td_h' ><p><?php echo $hospitalizacion;  ?></p></td>
                            <td class='tdVac--admin td_h' ><p><?php echo $fechaIngreso;  ?></p></td>
                            <td class='tdVac--admin td_h' ><p><?php echo $fechaAlta;  ?></p></td>
                            <td class='tdVac--admin td_h' >
                            <div class="acciones__table">
                                        <div class="acciones__table-editar" >
                                        
                                        </div>
                                        <div class="acciones__table-eliminar" >
                                            <?php
                                            if($documentos != ''){
                                                $str = substr($documentos, -3);
                                                if($str == 'pdf'){
                                                    ?>
                                                    <a href="https://mundocaninovet.online/admin/contenidos/usuarios/assets/documents/view.php?file=<?php echo $documentos;?>" target="_blank">
                                                <img src="contenidos/usuarios/assets/imgDefault/docs.png" alt="cruz">
                                            </a>
                                            <?php
                                                }else{
                                                    ?>
                                                    <a class="openImg" href="" >
                                                        <!-- //pongo el icono de una imagen, cuando el usuario  le di click se recupera la ruta guardada en el input oculto que se abre la imagen  -->
                                                        <img class="openImg" src="contenidos/publicaciones/assets/default/img.png" alt="preview">
                                                        <input  type="hidden" value="<?php echo $documentos;?>">
                                                    </a>
                            <?php
                                                }
                                            ?>
                                            
                                            <a href="index.php?seccion=AdminUsuarios&accion=deleteDoc&idH=<?php echo $id;?>&file=<?php echo $documentos;?>">
                                                <img src="../assets/images/cruz.png" alt="cruz">
                                            </a>
                                            <?php
                                            };
                                            ?>
                                        </div>
                                </div>
                            </td>
                            <td class='tdVac--admin' ><?php echo $fechaUpdate;  ?></td>
                            <td class='tdVac--admin' >pendiente actualizar vista hiatorias para poner estado</td>
                            <td class='tdVac--admin'>
                                <div class="acciones__table">
                                    <div class="acciones__table-editar" >
                                        <a href="index.php?seccion=AdminUsuarios&accion=editarH&idH=<?php echo $id ;?>">
                                            <img src="../assets/images/lapiz.png" alt="lapiz">
                                        </a>
                                    </div>
                                    <div class="acciones__table-eliminar" >
                                        <a href="index.php?seccion=AdminUsuarios&accion=deleteH&idH=<?php echo $id ;?>">
                                            <img src="../assets/images/cruz.png" alt="cruz">
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
        <?php 
        }
        ?>
<?php
};
?>
                        <tr>
                            <td colspan="12" class='td__admin--ps' >
                                <div class='aniadir'>
                                    <a href="index.php?seccion=AdminUsuarios&accion=addH&idP=<?php echo $rowM["idpacientes"];?>">
                                        <img src="../assets/images/mas.png" alt="mas">
                                        <p>añadir Historia</p>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </table>
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
                          $stmtV->execute([$idM]);
                            $rowV = $stmtV->fetch();
                            $tituloTabla;
                        if( $rowV){
                            $tituloTablaV = ' de ' . $rowV["nombre"];
                        }else{
                            $tituloTablaV = '';
                        }
                        include("../institucion/estandarVacunacion/vacunaciongato.php");
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
                            $stmtV->execute([$idM]);
                            $rowV = $stmtV->fetch();
                            $tituloTablaV;
                        if( $rowV){
                            $tituloTablaV = ' de ' . $rowV["nombre"];
                        }else{
                            $tituloTablaV = '';
                        }
                        include("../institucion/estandarVacunacion/vacunacionperro.php");
                    }
                ?>
                </div>
                <div class="producto">
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
                    $stmtDesp->execute([$idM]);
                } catch (\Throwable $th) {
                    echo $th;
                }
                    $rowDesp = $stmtDesp->fetch();
                    include("../institucion/estandarVacunacion/desparacitacion.php");
                ?>
                </div>
               
<?php
//agregar mascota a usuario
    };
    ?>
<a class="a__aniadirP" href="index.php?seccion=AdminUsuarios&accion=addPac&id=<?php echo $idU; ?>">
        <div class='aniadir-publicacion'>
            <img class="aniadir-publicacion-img" src="../assets/images/mas.png" alt="mas">
            <p>Añadir Nueva Mascota</p>
        </div>
    </a>
    <?php
?>            
<div class="producto">
<div class="description_services">
    <?php
    $cTextosProd = <<<SQL
        SELECT usuarios.nombre, productos.nombre, productos.descripcion, productos.precio, productos.descuento, productos.foto
        FROM productos
        JOIN productos_has_usuario
            ON productos_has_usuario.productos_idproductos = productos.idproductos
        JOIN usuarios
            ON usuarios.idusuario = productos_has_usuario.usuario_idusuario
        where usuarios.idusuario = ?    
    SQL;
    $stmtProd = $pdo->prepare($cTextosProd);
    // Especificamos el fetch mode antes de llamar a fetch()
    
    $stmtProd->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    try {
        $stmtProd->execute([$idU]);
    } catch (\Throwable $th) {
        echo $th;
    }
    if($stmtProd){
        $var_accion_producto = false;
        include("../contenidos/vistas/vista_productos.php");
    }else{
        echo 'aqui aparecen los productos asociados a cada usuario';
    }
    ?>
                 </div>
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