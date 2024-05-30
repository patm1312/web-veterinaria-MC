<?php
//por defecto muestro el listado  de las publicaciones
$accion = isset( $_GET['accion'] ) ?  $_GET['accion'] : 'listadoP';
if(isset($_GET['s'])){
    if($_GET['s'] == 0){
        unset($_SESSION['search']);
    }
 }
 ?>
 <div class="menuAdmin">
<a class="menuAdmin--a" href='index.php?seccion=AdminPublicaciones&accion=listadoP'><h2 class='h2 h2--servicios inline' >Listado de Publicaciones</h2></a>
<a class="menuAdmin--a" href='index.php?seccion=AdminPublicaciones&accion=listadoM'><h2 class='h2 h2--servicios inline' >Listado de Mascotas</h2></a>
</div>
<?php
if(isset($_GET['s'])){
    if($_GET['s'] == 0){
        //echo' elimina s';
        unset($_SESSION['search']);
    }else{
        //echo' NOelimina s';
    }
 }else{
    //echo 'NO existe get s';
 }
switch( $accion ){
	//formulario para borrar una publicacion
	case 'eraseP': include( 'formularios/deleteP.php' ); break;
	case 'eraseM': include( 'formularios/deleteM.php' ); break;
	//formulario para borrar una publicacion
	case 'erasePS': include( 'formularios/deletePS.php' ); break;
	//formulario para editar una publicacion
	case 'editarp': include( 'formularios/editar_p.php' ); break;
	case 'editarm': include( 'formularios/editarm.php' ); break;
	case 'editarpS': include( 'formularios/editar_pS.php' ); break;
	//formulario para borrar una publicacion de contenidos de publicacion.
	case 'editarPServ': include( 'formularios/editarPServ.php' ); break;
	//formulario para bagregar nueva una publicacion
    case 'addP': include( 'formularios/agregarP.php' ); break;
	case 'addM': include( 'formularios/agregarM.php' ); break;
	//formulario para bagregar nueva una publicacion de contendio  de publicacion
	case 'addpServ': include( 'formularios/agregarpServ.php' ); break;
	case 'listadoP': include( 'contenidos/contenido_publicaciones/publicaciones.php' ); break;
    case 'listadoM': include( 'contenidos/contenido_publicaciones/mascotas.php' ); break;
}
?>