<?php
session_start();
date_default_timezone_set('America/Bogota');
//header("Content-Type: text/html;charset=utf-8");
//codificacion del lado  del cliente y  de php:

//manejo de errores en php
ini_set('display_errors', 'on');
error_reporting(E_ALL);
    //en url guardo si estoy conectado a localhost: 
    $url = $_SERVER['HTTP_HOST'];
    $host = 'localhost';
    // inicia las sesiones para modificarlas o escribirlas:
    //si en la url esta localhost: file vale inilcal.ini, y  si no es localhost, vale ini_onlie.ini; estos archivos ini se crean con la configuracion de la conexion a mysqL: 
     $file = preg_match('/localhost/', $url) ? 'ini_local.ini' : 'ini_online.ini';
    //parse_ini_file() se carga en el archivo ini especificado enfilenamey devuelve la configuración que contiene en una matriz asociativa.
    //analiza un archivo dconifguracion:
    $cfg = parse_ini_file($file, true); 
    // La función ini_set se usa para cambiar el valor de las directivas de configuración que están disponibles en el archivo de configuración php.
    ini_set('display_errors', $cfg['errores']['display']);
    $cnx = mysqli_connect( $host, $cfg['mysql']['user'], $cfg['mysql']['clave'], $cfg['mysql']['bdd'] );
     //de esta forma hagio que los caracteres como las ñ o tildes se muestren correctamente 
     if($cnx){
        mysqli_set_charset( $cnx, 'utf8mb4' );
    }
//PDO:

// configurar servidor de la base de dartos dsn:
$dsn = 'mysql:host=' . $host . ';dbname=' . $cfg['mysql']['bdd'];
//para evitar que un error me impida ejecutar el resto de codigo cuando falla conectarse al servidor uso trycatch:
//crear la instancia pdo
try{
    $pdo = new PDO($dsn, $cfg['mysql']['user'], $cfg['mysql']['clave']);
//aqui capturo el tipo  de error que esta esperando en el catch de lalibreria pdo
}catch (PDOException $error){
    //con message capturo el error
    echo 'Falló la conexión: ' . $error->getMessage();
}


    //agrrego el setattribute para especificarlo de manera global y no tener que especificarlo encada consulta con el while, 
    //con el atributo atttr que en su primer parametro es lo  que se especifica y en el segundo parametro es lamanera en que uso las consultas, si es con array o con obj(PDO::FETCH_OBJ)

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $prueba = 'soy la prueba';
?>