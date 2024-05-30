<?php
    $idVac = $rowV['idplanvacunacion'];
?>
<!-- //este formulario que contiene una tbla muestra informacion de plan de vacunacion de una mascota, se carga para cada mascota que tiene un usuario, aqui contiene una tabla para un perro: se envia a updatelanvacunacionperro con el id que coresponde a el plande vacunacion del paciente: -->
<form method="post" id="calendario" action="contenidos/usuarios/acciones/updateVacunacionP.php?idPvac=<?php echo $idVac;?>" class="calendario border_prueba__table">
    <table class="tableVac">
        <tr  class="trVac">
            <th class="thVac" rowspan="3">
                <img class="imgVac" src="assets/images/dogVac.png" alt="dog">
            </th>
            <th class="thVac thVac--tittle" colspan="5">
                <span class="tittleTable poster__description--span poster__description--h1--canva">C</span><span class="tittleTable poster__description--span2 poster__description--h1--canva">alendario  de Vacunacion <?php echo $tituloTablaV; ?></span>

            </th>
            
        </tr>
        <tr>
            <th class="thVac thVac--color" colspan="5">Semana</th>
        </tr>
        <tr  class="trVac">
            <th class="thVac thVac--color">6-8</th>
            <th class="thVac thVac--color">8-10</th>
            <th class="thVac thVac--color">10-12 (arreglar otro)</th>
            <th class="thVac thVac--color">3 Meses</th>
            <th class="thVac thVac--color">Anual</th>
        </tr>
        <tr class="trVac">
            <th class="thVac thVac--block">Parvovirus-Moquillo</th>
            <td class="tdVac tdVac--color" >
            <input name="vac1"  <?php echo $resultado = empty($rowV['vacuna1']) ? '' : 'checked'; ?> class="calendarioVD vacunacion<?php echo $rowM["idpacientes"];  ?>" type="checkbox" id="cbox1" value="<?php echo $rowV['vacuna1']; ?>" />
            </td>
            <td class="tdVac" ></td>
            <td class="tdVac" ></td>
            <td class="tdVac" ></td>
            <td class="tdVac" ></td>
        </tr>
        <tr class="trVac">
            <th class="thVac thVac--block">Refuerzo y Hepatitis para la influenza</th>
            <td class="tdVac " ></td>
            <td class="tdVac tdVac--color" >
            <input name="vac2"  <?php echo $resultado = empty($rowV['vacuna2']) ? '' : 'checked'; ?> class="calendarioVD vacunacion<?php echo $rowM["idpacientes"];  ?>" type="checkbox" id="cbox2" value="<?php echo $rowV['vacuna2']; ?>" />
            </td>
            </td>
            <td class="tdVac" ></td>
            <td class="tdVac" ></td>
            <td class="tdVac" ></td>
        </tr>
        <tr class="trVac">
            <th class="thVac thVac--block">Tercer Refuerzo- Leptospira</th>
            <td class="tdVac" ></td>
            <td class="tdVac" ></td>
            <td class="tdVac tdVac--color" >
            <input name="vac3"  <?php echo $resultado = empty($rowV['vacuna3']) ? '' : 'checked'; ?> class="calendarioVD vacunacion<?php echo $rowM["idpacientes"];  ?>" type="checkbox" id="cbox3" value="<?php echo $rowV['vacuna3']; ?>" />
            </td>
            </td>
            <td class="tdVac" ></td>
            <td class="tdVac" ></td>
        </tr>
        <tr class="trVac">
            <th class="thVac thVac--block">Rabia</th>
            <td class="tdVac" ></td>
            <td class="tdVac" ></td>
            <td class="tdVac" ></td>
            <td class="tdVac tdVac--color" >
            <input  name="vac4" <?php echo $resultado = empty($rowV['vacuna4']) ? '' : 'checked'; ?> class="calendarioVD vacunacion<?php echo $rowM["idpacientes"];  ?>"  type="checkbox" id="cbox4" value="<?php echo $rowV['vacuna4']; ?>" />
            </td>
            </td>
            <td class="tdVac" ></td>
        </tr>
        <tr class="trVac">
            <th class="thVac thVac--block">Polivalente-Refuerzo Anual</th>
            <td class="tdVac" ></td>
            <td class="tdVac" ></td>
            <td class="tdVac" ></td>
            <td class="tdVac" ></td>
            <td class="tdVac tdVac--color" >
            <input name="vac5"  <?php echo $resultado = empty($rowV['vacuna5']) ? '' : 'checked'; ?> class="calendarioVD vacunacion<?php echo $rowM["idpacientes"];  ?>"  type="checkbox" id="cbox5" value="<?php echo $rowV['vacuna5']; ?>" />
            </td>
            </td>
        </tr>
        <tr class="trVac">
            <th class="thVac thVac--block">Proxima Dosis:</th>
            <td class="tdVac" colspan="5" >
                <p><?php echo $rowV['ProximaDosis']; ?></p>
                <p>Fecha: <?php echo $rowV['fechaProxima']; ?></p>
                <input name="fechaP" type="hidden" value="<?php echo $rowV['fechaProxima'];?>"/>
                <input name="Dosis" type="hidden" value="<?php echo $rowV['ProximaDosis'];?>"/>
                <?php
                   if($_SESSION['nivel_usuario'] == 'administrador'){
                    if($_SESSION['seguridad_modificar'] == 'true'){
                ?>
                <input class="input_vacunacion<?php echo $rowM["idpacientes"];  ?> none__filter aplicarPlan" type="submit" value="Aplicar">
                <?php
                    };
                }
                            ?>

            </td>
        </tr>
    </table>
</form>
<?php
$rowV = '';
$stmtV->closeCursor();
?>
    