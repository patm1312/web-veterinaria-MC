<?php
session_start();
$_SESSION['seguridad_modificar'] = 'true';
    include('../configuracion/conexion.php');
    include('../function/function.php');
    //seccionque se va a cargar en la pagina de index como pagina de control, controla las publicaciones, los usuarios y los productos. si no hay ningun dato por get entonces por defecro  cargo la administracion de usuarios
    $section = isset($_GET['seccion']) ? $_GET['seccion']:'AdminUsuarios';
    //aqui  es la seguridad de la lapgina, si nio hay niugun dato de un usuario  administrador guardado  en una sesion, entonces no dbeeria ver esta pagina, lo redirijo  a loguearse o a lapagina de index raiz.
        if(isset($_SESSION['user_id'])){
            if($_SESSION['nivel_usuario'] == 'administrador'){
                //echo "<script>window.location.href='/veterinaria/admin/index.php'</script>";
            }else{
                //echo "No existe usuario administrador";
                echo "<script>window.location.href='../index.php?seccion=perfil'</script>";
            }
        }else{
            //echo "existe usuario";
            echo "<script>window.location.href='../index.php'</script>";
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>  
    <!-- //libreria del framework alpnie.js, lo agrego a mi pagina de index.php para que se cargue en los modulos por medio  de un link cdn.,  -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="../scripts/alpine.js"></script>
</head>
<body>
<header class="header">
            <div class="img__logo--box">
                <h1>PANEL DE CONTROL</h1>
            </div>
            <a class="enlace_hm" href="">
            <img class="hm__responsive enlace_hm" src="../assets/images/menuHm.png" alt="hamburguer">
        </a>
            <nav class="nav">
                <ul class="nav__ul">
                    <li>
                    <table class="table__search nav__search header-hm  none__search">
                    <tbody>
                        <thead>
                        <th class="tr_flex">
                        <td class="celda__border">
                            <form method="post" action="">
                                <input type="text" name="search" class="search " placeholder="Buscar...">
                                <a class="lupa_buscador" href="">
                                    <img class="glass" src="../assets/images/image6.png" alt="lupa">
                            </a>
                            </form>
                            
                        </td>
                        </th>
                        </thead>
                        </tbody>

                    </table>
                    <li class="nav__none nav__item nav__item--border"><a class="nav__item" href="index.php?seccion=AdminUsuarios&s=0">Usuarios</a></li>
                    <li class="nav__none nav__item nav__item--border"><a class="nav__item" href="index.php?seccion=AdminPublicaciones&s=0">Publicaciones</a></li>
                    <li class="nav__none nav__item nav__item--border"><a class="nav__item" href="index.php?seccion=AdminProductos&s=0">Productos</a></li>
                   <li class="nav__none nav__item ">
                   <a class="lupa_buscador"  href="">
                        <img class="glass__search" src="../assets/images/image6.png" alt="lupa">
                    </a>
                   </li>
                </ul>           
                <div class="block__menu">
                        <h2>Contactanos:</h2>
                        <div class="block__menu--box">
                            <div  class="block__menu--item">
                                <img class="icon_hm" src="../assets/images/whats.png" alt="whatsapp">
                                <p>numero de telefono</p>  
                            </div>
                            <div class="block__menu--item">
                                <img class="icon_hm" src="../assets/images/email.png" alt="email">
                                <p>correo</p>  
                            </div>
                            <div class="block__menu--item">
                                <img class="icon_hm" src="../assets/images/facebook.svg" alt="">
                                <p>facebbok</p>  
                            </div>
                        </div>
                        
                   </div>
            </nav>
    </header>
<?php
    if(isset($_SESSION['rta_admin'])){
      
                //si no pongo  el echo, no valida oksession. invstigar.
               // echo "";
               //resuestas de las solicitudes de usuario:
                if($_SESSION['rta_admin'] == 'img_big'){
                    $message = "Imagen demasiado grande, debe ser maximo 1024 Mb";
                    $clase = 'error';
                }else if($_SESSION['rta_admin'] == 'ok_form'){
                    $message = "Accion Exitosa";
                    $clase = 'ok';
                }else if($_SESSION['rta_admin'] == 'error'){
                    $message = "Revisa bien los datos.";
                    $clase = 'error';
                }else if($_SESSION['rta_admin'] == 'DateNull'){
                    $message = "NO se puede procesar su solicitud.";
                    $clase = 'error';
                }else if($_SESSION['rta_admin'] == 'error__consulta'){
                    $message = "error en la base de datos";
                    $clase = 'error';
                }
    }
    unset($_SESSION['rta_admin']);
?>
<p class="<?php echo $clase; ?>"><?php echo $message; ?></p>
<main class="main_admin">
    <?php
            switch($section){
                //pagina que se encarga de administrar a los usuarios
                case "AdminUsuarios": include("contenidos/homeAdmin.php");
                break;
                //pagina que se encarga de administrar a los productos
                case "AdminProductos": include("contenidos/productos/productos.php");
                break;
                //pagina que se encarga de administrar a los productos
                case "AdminPublicaciones": include("contenidos/publicaciones/adminPublic.php");
                break;
                //pagina que se encarga de visualizar las imagenes cargadas, lo hace en una pestaña nueva.
                case "openW": include("contenidos/publicaciones/acciones/readImg.php");
                break;
                default: 
					echo "<p class='error'>La sección solicitada ($section), no existe</p>";
					include( 'contenidos/homeAdmin.php');
                break;

            }
        ?>
    </main>
</body>
<script src="../scripts/index.js" type="module"></script>
</html>
