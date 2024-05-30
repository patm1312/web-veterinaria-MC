<?php
//incluyo el doumento segun el valor enviado  atravez de la solicitud ajax:
if($_GET['apellido'] == 'informacion1'){
    include("informacion1.php");
}else if($_GET['apellido'] == 'informacion2'){
    include("informacion2.php");
}
?>