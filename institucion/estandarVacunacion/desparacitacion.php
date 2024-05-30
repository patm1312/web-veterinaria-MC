<?php
    $idPdes = $rowDesp['idPlanDesparacitacion'];
?>
<form method="post" id="calendario" action="contenidos/usuarios/acciones/updateDesp.php?idPdes=<?php echo $idPdes;?>" class="calendario border_prueba__table">
<table class="tableVac ">
        <tr  class="trVac">
            <th class="thVac" >
                <img class="imgVac" src="assets/images/catVac.png" alt="dog">
            </th>
            <th class="thVac thVac--tittle" colspan="5">
                <span class="tittleTable poster__description--span poster__description--h1--canva">C</span><span class="tittleTable poster__description--span2 poster__description--h1--canva">alendario  de Desparacitacion de <?php echo $rowM["nombre"];  ?></span>
            </th>
        </tr>
        <tr  class="trVac">
            <th class="thVac thVac--color">Frecuencia</th>
            <th class="thVac thVac--color">Dosis</th>
        </tr>
        <tr class="trVac ">
            <th class="thVac thVac--block">21 Dias</th>
            <td class="tdVac " >
            <input name="d1"  <?php echo $resultado =  empty($rowDesp['d1']) ? '' : 'checked'; ?> class="calendarioVD desparacitacion<?php echo $rowM["idpacientes"];  ?>" type="checkbox" id="cbox1" value="<?php echo $rowDesp['21Dias']; ?>" />
            </td>
        </tr>
        <tr class="trVac">
            <th class="thVac thVac--block">Semana 5</th>
            <td class="tdVac " >
            <input name="d2"  <?php echo $resultado =  empty($rowDesp['d2']) ? '' : 'checked'; ?> class="calendarioVD desparacitacion<?php echo $rowM["idpacientes"];  ?>" type="checkbox" id="cbox1" value="<?php echo $rowDesp['semana 5']; ?>" />
            </td>
        </tr>
        <tr class="trVac">
            <th class="thVac thVac--block">Semana 7</th>
            <td class="tdVac" >
            <input name="d3"  <?php echo $resultado =  empty($rowDesp['d3']) ? '' : 'checked'; ?> class="calendarioVD desparacitacion<?php echo $rowM["idpacientes"];  ?>" type="checkbox" id="cbox1" value="<?php echo $rowDesp['Semana7']; ?>" />
            </td>
        </tr>
        <tr class="trVac">
            <th class="thVac thVac--block">Semana 9</th>
            <td class="tdVac" >
            <input name="d4"  <?php echo $resultado =  empty($rowDesp['d4']) ? '' : 'checked'; ?> class="calendarioVD desparacitacion<?php echo $rowM["idpacientes"];  ?>" type="checkbox" id="cbox1" value="<?php echo $rowDesp['semana 9']; ?>" />
            </td>
        </tr>
        <tr class="trVac">
            <th class="thVac thVac--block">3 meses</th>
            <td class="tdVac" >
            <input name="d5"  <?php echo $resultado =  empty($rowDesp['d5']) ? '' : 'checked'; ?> class="calendarioVD desparacitacion<?php echo $rowM["idpacientes"];  ?>" type="checkbox" id="cbox1" value="<?php echo $rowDesp['3meses']; ?>" />
            </td>
        </tr>
        <tr class="trVac">
            <th class="thVac thVac--block">4 meses</th>
            <td class="tdVac" >
            <input name="d6"  <?php echo $resultado =  empty($rowDesp['d6']) ? '' : 'checked'; ?> class="calendarioVD desparacitacion<?php echo $rowM["idpacientes"];  ?>" type="checkbox" id="cbox1" value="<?php echo $rowDesp['4meses']; ?>" />
            </td>
        </tr>
        <tr class="trVac">
            <th class="thVac thVac--block">5 meses</th>
            <td class="tdVac" >
            <input name="d7"  <?php echo $resultado =  empty($rowDesp['d7']) ? '' : 'checked'; ?> class="calendarioVD desparacitacion<?php echo $rowM["idpacientes"];  ?>" type="checkbox" id="cbox1" value="<?php echo $rowDesp['5meses']; ?>" />
            </td>
        </tr>
        <tr class="trVac">
            <th class="thVac thVac--block">Cada 3 Meses</th>
            <td class="tdVac" >
            <input name="d8"  <?php echo $resultado =  empty($rowDesp['d8']) ? '' : 'checked'; ?> class="calendarioVD desparacitacion<?php echo $rowM["idpacientes"];  ?>" type="checkbox" id="cbox1" value="<?php echo $rowDesp['cada 3 meses']; ?>" />
            </td>
        </tr>
        <tr class="trVac">
            <th class="thVac thVac--block">Proxima Dosis:</th>
            <td class="tdVac"  ><span>Proxima :</span>
                <p>
                    <?php echo $rowDesp['proximaDosisD']; ?>
                </p>
                <p>
                    Fecha: <?php echo $rowDesp['proximaDosisF']; ?>
                </p>
                <input name="fechaP" type="hidden" value="<?php echo $rowDesp['ProximaDosisF'];?>"/>
                <input name="Dosis" type="hidden" value="<?php echo $rowDesp['proximaDosisD'];?>"/>
                <?php
                   if($_SESSION['nivel_usuario'] == 'administrador'){
                    if($_SESSION['seguridad_modificar'] == 'true'){
                ?>
                 <input class="input_desparacitacion<?php echo $rowM["idpacientes"];  ?> none__filter aplicarPlan" type="submit" value="Aplicar">
                 <?php
                    }
                   }else{
                    echo 'no admin';
                   }
                ?>
               
            </td>
        </tr>
    </table>
</form>