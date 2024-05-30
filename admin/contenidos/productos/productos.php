<a  href="/admin/index.php?seccion=AdminProductos">
<div>
<h2 class="h2 h2--servicios inline" >Listado de Productos</h2>
</div>
</a>

<?php
//este sirve para cuando este valos sea ceor, entonces elimine el buscador y  muestre tosod los resultados nuevamente y sin filtro.
 if(isset($_GET['s'])){
    if($_GET['s'] == 0){
        unset($_SESSION['search']);
    }
 }
 //seccionque se va a cargar en la pagina de homeadmin como pagina de control, controla los usuarios,. si no hay ningun dato por get entonces por defecro  cargo la administracion de usuarios
 $section = isset($_GET['accion']) ? $_GET['accion']:'productosIndex';
 switch($section){
     //pagina que se encarga de administrar los productos
     case "productosIndex": include("contenidos/productos/contenidos/indexPoductos.php");
     break;
     //pagina que se encarga de editar contendo de usuarios
     case "editarProducto": include("contenidos/productos/formularios/updateproducto.php");
     break;
     case "addProducto": include("contenidos/productos/formularios/addproducto.php");
     break;
     case "editarMascota": include("contenidos/usuarios/formularios/editarM.php");
     break;
     case "eraseM": include("contenidos/usuarios/formularios/deleteM.php");
     break;
     case "editarCita": include("contenidos/usuarios/formularios/editarC.php");
     break;
     case "deleteCita": include("contenidos/usuarios/formularios/deleteC.php");
     break;
     case "editarH": include("contenidos/usuarios/formularios/editarH.php");
     break;
     case "deleteH": include("contenidos/usuarios/formularios/deleteH.php");
     break;
     case "addH": include("contenidos/usuarios/formularios/addH.php");
     break;
     default: 
         echo "<p class='error'>La sección solicitada ($section), no existe</p>";
         include( 'contenidos/usuarios/users.php');
     break;
 }
?>
