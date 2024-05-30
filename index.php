<?php
include('function/function.php');
//variable de seguridad para solo la pagina de navegacion de un usuario comun y no administrador de contenidos

include('configuracion/conexion.php');
$_SESSION['seguridad_modificar'] = 'false';


// Número de teléfono al que deseas enviar el mensaje por WhatsApp
$numero = "+573107274921";
// Mensaje que deseas enviar
$mensaje = "Hola, ¿cómo estás??";

// Codifica el número de teléfono y el mensaje para que sean seguros en un enlace
$numero_codificado = rawurlencode($numero);
$mensaje_codificado = rawurlencode($mensaje);
// Crea el enlace con el formato correcto para WhatsApp
$enlace_whatsapp = "whatsapp://send?phone={$numero_codificado}&text={$mensaje_codificado}";


// <!-- Ahora puedes utilizar el enlace en un botón -->

?>
?>

<a href="<?php echo $enlace_whatsapp; ?>">
    <button>Enviar mensaje por WhatsApp</button>
</a>

<?php




if(isset($_SESSION['seguridad_modificar'])){
    
}else{
    echo 'NO existe';
}

 $section = isset($_GET['seccion']) ? $_GET['seccion']:'home';
 //cada vez que el usuario  le da click en el logo de login, depende de s esta logueado o no:
 if(isset($_SESSION['user_id'])){
    $nombre = $_SESSION['user_name'];
    $url_login = 'index.php?seccion=perfil';
 }else{
    $nombre = "Login";
    $url_login = 'index.php?seccion=login';
 }
$cTextos = <<<SQL
SELECT 
	*
FROM
    publicaciones
 WHERE usuario_idusuario=?
SQL;
$stmt = $pdo->prepare($cTextos);
// Especificamos el fetch mode antes de llamar a fetch()
$stmt->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
$dato_consulta = 64;
$stmt->execute([$dato_consulta]);
$p = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mundo Canino</title>
    <link rel="icon" type="image/x-icon" href="assets/images/word.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gorditas:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css"/>  
</head>
<body>
    <header class="header">
        <a href="index.php?seccion=home" class="enlace__img__logo">
            <div class="img__logo--box">
                <img class="header__boxLogo--imgLogo img__logo--large" src="assets/images/logolarge.png" alt="prueba de imagen">
            </div>
        </a>
        <a class="enlace_hm" href="">
            <img class="hm__responsive enlace_hm" src="assets/images/menuHm.png" alt="hamburguer">
        </a>
            <nav class="nav">
                <ul class="nav__ul">
                    <li>
                    <table class="table__search nav__search header-hm  none__search">
                    <tbody>
                        <thead>
                        <th class="tr_flex">
                        <td class="celda__border"><input type="text" name="search" class="search " placeholder="Buscar...">
                            <a class="lupa_buscador" href="">
                                    <img class="glass" src="assets/images/image6.png" alt="lupa">
                            </a>
                        </td>
                        </th>
                        </thead>
                        </tbody>
                    </table>
                    </li>
                    <!-- <li class="nav__search header-hm none__search">
                        <div class="box__inline">    
                                <input type="text" name="search" class="search " placeholder="Buscar...">
                        </div>
                        <a href="">
                            <img class="glass" src="assets/images/image6.png" alt="lupa">
                        </a>
                        <img class="closee__menu" src="assets/images/close2.png" alt="hamburguer">
                    </li> -->
                    <li class="nav__none nav__item nav__item--border"><a class="nav__item" href="index.php?seccion=home">Inicio</a></li>
                    <li class="nav__none nav__item nav__item--border"><a class="nav__item" href="index.php?seccion=productos">Productos</a></li>
                    <li class="nav__none nav__item nav__item--border"><a class="nav__item" href="index.php?seccion=servicios">Servicios</a></li>
                    <!-- <li class="nav__none nav__item nav__item--border"><a class="nav__item" href="index.php?seccion=home">Blog</a></li> -->
                    <li class="li__bottom nav__none nav__item nav__item--border "><a class="nav__item bottom bottom__responsive " href="index.php?seccion=cita">Agenda Tu cita</a></li>
                    <!-- mdulode iniciar sesion -->
                    <li class="nav__none nav__item nav__item--border">
                        <div class="header__boxLogin">
                                <p class="header__boxLogin--p"><a class="header__boxLogin--p" href="<?php echo $url_login; ?>"><img class="header__boxLogin--img" src="assets/images/user.png" alt=""><?php echo $nombre; ?></a></p>  
                        </div>
                    </li>
                   <li class="nav__none nav__item ">
                   <a class="lupa_buscador" href="">
                        <img class="glass__search" src="assets/images/image6.png" alt="lupa">
                    </a>
                   </li>
                </ul>
                <div class="block__menu">
                        <h2>Contactanos:</h2>
                        <div class="block__menu--box">
                            <div  class="block__menu--item">
                                <img class="icon_hm" src="assets/images/whats.png" alt="whatsapp">
                                <p class="block__menu--p">3153704398</p>  
                            </div>
                            <div class="block__menu--item">
                                <img class="icon_hm" src="assets/images/email.png" alt="email">
                                <p class="block__menu--p">vetmundocanin07@gmail.com</p>  
                            </div>
                        
                            <div class="block__menu--item">
                                <a class="block__menu--item" href="https://web.facebook.com/Vetmundocanin0" target="_blank">
                                    <img class="icon_hm" src="assets/images/facebook.svg" alt="">
                                    <p class="block__menu--p">facebbok</p> 
                                </a>

                            </div>
                            <div class="block__menu--item">
                                <!-- <img class="icon_hm" src="assets/images/email.png" alt="email"> -->
                                <p class="block__menu--p">Avenida 3e # 7- 46 Brr. Popular <br> Cucuta, Norte de Santander</p>  
                            </div>
                        </div>
                   </div>
            </nav>
    </header>
        <main class="main">
        <?php
        //si existe las esion resppuesta que es el mensaje de esito  o no cuando el ususario hace una peticion al sistema
            if(isset($_SESSION['rta'])){
                //si no pongo  el echo, no valida oksession. invstigar.
               // echo "";
                if($_SESSION['rta'] == 'ok__session'){
                    //echo "si existe la sesion se llama logueado";
                    $message = "usuario logueado satisfactoriamente";
                    $clase = 'ok';
                }else if($_SESSION['rta'] == 'error__session'){
                    $message = "revisa los datos correctamente";
                    $clase = 'error';
                }else if($_SESSION['rta'] == 'ok__logadd'){
                    $message = "usuario creado satisfactoriamente";
                    $clase = 'ok';
                }else if($_SESSION['rta'] == 'error'){
                    $message = "revisa los datos correctamente e intentalo mas tarde";
                    $clase = 'error';
                }else if($_SESSION['rta'] == 'error__email_duplicate'){
                    $message = "este correo electronico ya existe";
                    $clase = 'error';
                }else if($_SESSION['rta'] == 'noAutorizado'){
                    $message = "No autorizado para esta pagina";
                    $clase = 'error';
                }else if($_SESSION['rta'] == 'no__user'){
                    $message = "Usuario no existe";
                    $clase = 'error';
                }else if($_SESSION['rta'] == 'errorValidacion'){
                    $message = "Hubo un error con tus datos, intentalo nuevamente";
                    $clase = 'error';
                }else if($_SESSION['rta'] == 'ok__cpassw'){
                    $message = "Inicia SEsion con tu nueva Contraseña";
                    $clase = 'ok';
                }else if($_SESSION['rta'] == 'y__user'){
                    $message = "Usuario  ya existe, por favor inica sesion!";
                    $clase = 'error';
                }
            }
            unset($_SESSION['rta']);
            ?>
            <p class="<?php echo $clase; ?>"><?php echo $message; ?></p>
            <?php
            unset($_SESSION[$_SESSION["user_id"]]);
            switch($section){
                case "home": include("contenidos/home.php");
                break;
                case "login": include("contenidos/login.php");
                break;
                case "logout": include("contenidos/logout.php");
                break;
                case "logadd": include("contenidos/logadd.php");
                break;
                case "servicios": include("contenidos/servicios.php");
                break;
                case "cita": include("contenidos/cita.php");
                break;
                case "citaUser": include("contenidos/cita__user.php");
                break;
                case "cita__email": include("contenidos/cita__email.php");
                break;
                case "rec_user_v": include("contenidos/rec_user.php");
                break;
                case "cita__datos": include("contenidos/cita__datos.php");
                break;
                case "cita__fecha": include("contenidos/cita__fecha.php");
                break;
                case "adopta": include("contenidos/contenido__servicios/adopta.php");
                break;
                case "updatePassword": include("contenidos/updatePass.php");
                break;
                case "perfil": include("contenidos/user/index.php");
                break;
                case "productos": include("contenidos/productos.php");
                break;
                case "producto": include("contenidos/contenido_productos/producto.php");
                break;
                case "about": include("contenidos/empresa/about.php");
                break;
                case "politica": include("contenidos/empresa/politica.php");
                break;
                case "servicio": include("contenidos/contenido__servicios/servicio.php");
                break;
                case "validar_email": include("contenidos/validar_email.php");
                break;
                case "datos_registro": include("contenidos/datos_registro.php");
                break;
                case 'static': include( 'contenidos/static.php'); break;
                // case "updatePassword": include("contenidos/user/updatePassword.php");
                //break;
                // case "updateImage": include("contenidos/user/updateImage.php");
                // break;
            
                default: 
					echo "<p class='error'>La sección solicitada ($section), no existe</p>";
					include( 'contenidos/home.php');
            }
        ?>
         <button class="scrol scrol-show"  data-scroll-spytype="button">&#11014   
    </button>
    </main>
    <footer class="footer">
        <div class="img__footer">
            <img class="img__footer" src="assets/images/logotransp.png" alt="">
        </div>
        <div class="">
            <h2 class="footer__boxenlaces--h2">Enlaces Utiles:</h2>
            <a class="enlaces enlaces__footer" href="index.php?seccion=servicios">Servicios</a>
            <?php
                //creo el acceso entre php y el directorio 
				$directorio = opendir( 'institucion' );
                //recorrer los contenidos 
				while( $archivo = readdir( $directorio )  ){
					if( $archivo == '.' || $archivo == '..' ){
						continue;
					}
					$nombre_archivo = pathinfo( $archivo, PATHINFO_FILENAME );
					echo "<a class='enlaces enlaces__footer' href='index.php?seccion=static&cual=$nombre_archivo'>$nombre_archivo</a>";
				}
				//cerramos el recurso
				closedir($directorio);
            ?>
        </div>
        <div class="footer__boxcontacto">
            <h2 class="footer__boxcontacto--h2">Información de contacto:</h2>
                <p class="enlaces">3153704398</p>
                <p class="enlaces">Avenida 3e # 7- 46 Brr. Popular <br> Cucuta, Norte de Santander</p>
        </div>
        <div class="footer__social">
                <h2 class="footer__social--h2">Redes sociales:</h2>
                <a href="https://web.facebook.com/Vetmundocanin0" class="enlace__img__logo" target="_blank">
                        <img class="footer__social--img" src="assets/images/facebook.svg" alt="social">
                </a>
                        <img class="footer__social--img" src="assets/images/instagram.svg" alt="social">
        </div>
    </footer>
    <script src="scripts/index.js" type="module"></script>
</body>
</html>