<?php
//por defecto muestro el listado  de las publicaciones
$accion = isset( $_GET['accionUserCitas'] ) ?  $_GET['accionUserCitas'] : 'listadoUsuarios';
?>
    <div class="menuAdmin">
        <a class="menuAdmin--a" href='index.php?seccion=AdminUsuarios&accionUserCitas=listadoUsuarios'><h2 class='h2 h2--servicios inline' >Listado de Usuarios</h2></a>
        <a class="menuAdmin--a" href='index.php?seccion=AdminUsuarios&accionUserCitas=listadoCitas'><h2 class='h2 h2--servicios inline' >Listado de Citas</h2></a>
    </div>
<?php
switch( $accion ){
	//listado de citas
	case 'listadoCitas': include( 'listado_citas.php' ); break;
	//listado de usuarios
	case 'listadoUsuarios': include( 'users.php' ); break;
	case "addcita": include("formularios/addcita.php");
	break;
	case "editarCita": include("formularios/editarC.php");
	break;
	case "deleteCita": include("formularios/deleteC.php");
	break;
	
}
?>