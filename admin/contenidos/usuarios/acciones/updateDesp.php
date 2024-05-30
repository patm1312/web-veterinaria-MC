<?php
    include('../../../../configuracion/conexion.php');
    //este scrip es para procesar los datos enviados por formulario para editar informacion de historias medicas: 
    $_SESSION['rta_admin'];
    //seguridad de la pagina.
    $maximo = 2 * 1024 * 1024; //Tamaño en MB
    if(isset($_SESSION['user_id'])){
        if($_SESSION['nivel_usuario'] == 'administrador'){
            //echo "<script>window.location.href='/veterinaria/admin/index.php'</script>";
        }else{
            //echo "No existe usuario administrador";
            $_SESSION['rta'] = 'noAutorizado';
            //echo "<script>window.location.href='/veterinaria/index.php?seccion=perfil'</script>";*10
        }
    }else{
        //echo "existe usuario";
        $_SESSION['rta'] = 'noAutorizado';
        //echo "<script>window.location.href='/veterinaria/index.php'</script>";
    }
    if(isset($_GET['idPdes'])){
        if(!empty($_GET['idPdes'])){
            //creo variables que posteriormente seran un array para guardar  y actualizar en la db
            $date_form;
            $proxVac;
            $idPdes = $_GET['idPdes'];
            $d1 = $_POST['d1'];
            $d2 = $_POST['d2'];
            $d3 = $_POST['d3'];
            $d4 = $_POST['d4'];
            $d5 = $_POST['d5'];
            $d6 = $_POST['d6'];
            $d7 = $_POST['d7'];
            $d8 = $_POST['d8'];
            // $week5 = empty($_POST['week5']) ? '0' : '1';
            // $week7 = empty($_POST['week7']) ? '0' : '1';
            // $week9 = empty($_POST['week9']) ? '0' : '1';
            // $mes3 = empty($_POST['3mes']) ? '0' : '1';
            // $mes4 = empty($_POST['4mes']) ? '0' : '1';
            // $mes5 = empty($_POST['5mes']) ? '0' : '1';
            // $mesesFr3 = empty($_POST['3mesesFr']) ? '0' : '1';
            $c = "UPDATE PlanDesparacitacion set d1=:d1, d2=:d2, d3=:d3, d4=:d4, d5=:d5, d6=:d6, d7=:d7, d8=:d8";
            // si me envia por post, es decir si esta marcado el checkbox para indicar que se aplico la vacuna: 
            $a = 1;
            $listadoVacunas = ['Desparacitacion'];
            $listadoTiemposVacunas = ["cero", "+14 days","+14 days", "+14 days", " + 1 month", "+ 1 month", "+ 1 month", "+ 3 month", ];



            while ($a <= 8) {
                if(isset($_POST['d' . $a])){
                    // si no esta vacio
                    if(empty($_POST['d' . $a])){
                        // creo una fecha para el dia que s eaplico la vacuna:
                        ${'d' . $a} = date("Y-m-d H:i:s");
                        //creo la fecha  para la proxima vacuna
                        $proxFecha = strtotime(${'d' . $a}  . $listadoTiemposVacunas[$a]);
                        $date_form = date('Y-m-d H:i:s', $proxFecha);
                        // indico el nombre de la proxima dosis
                        $proxVac = $listadoVacunas[0];
                        //le concateno  a la consulta para actualizar los datos en la db del plan de vacunacion del pacientes
                        $c = $c . ', proximaDosisF=:proxF, proximaDosisD=:proxD ';
                        // guardo este valor en un array , y de esta forma se que debo actualizar este dato, que es la proxima fecha y dosis. si en otra vacuna sale actualizar con fecha proxima o disis diferente, esta pisara la anterior.
                        $datos_vac = [$date_form, $proxVac];
                    }else{
                        // se envia el dato, pero esta vez en el value del input tipo checkbox del formulario envia una fecha , porque encontro un registro  en la db, esto quiere dcir que debo actualizar con la misma fecha que estaba registrada, esto pasa cuando el checkbox ya esta con chulo en el formulario. quiere decir que ya sse habia aplicado la vacuna. vuelvo  a crear la fecha proxima y proxima dosis, porque necesito que se guarde en el array los  datos para hcaer el update, ya que si se desmarca el condicional va a saltar a el else de no envio de post y  va a subir null en la db. 
                        ${'d' . $a} = $_POST['d' . $a];
                        $proxFecha = $fechaProx;
                        $proxVac = $listadoVacunas[0];
                        $proxFecha = strtotime(${'d' . $a}.$listadoTiemposVacunas[$a]);
                        $date_form = date('Y-m-d H:i:s', $proxFecha);
                        $c = $c . ', proximaDosisF=:proxF, proximaDosisD=:proxD ';
                        $datos_vac = [$date_form, $proxVac];
                    }
                    
                }else{
                    //este caso no se envia nada, es decir se desmarca el chulo del input, por lo tanto debo actualizar la fecha de la vac1,  la prosima fecha y  la proxima dosis a null, sin embargo el sistema evalua primero si hay guaradao en un array fecha prox y dosis proxima para comprobar si debo usar las variables de este caso o hay fehcas de proxfecha y proxima dosis guardadas en el array que se deben actualizar, esto pasa cuando se desmarcan chulos.
                    ${'d' . $a} = NULL;
                    $proxVac = NULL;
                    $date_form = NULL;
                    $c = $c . ', proximaDosisF=:proxF, proximaDosisD=:proxD ';
                }
                $a += 1;
            }
            $c = $c . 'WHERE idPlanDesparacitacion=:idPD';
            try {
                $stm = $pdo->prepare($c);
                //ejecutar la consulta:
                //vincular los dats con bimparams(recomendado):
                //primer argumento es el argumento  que especifico  en la consulta, el segundo parametro es la variable recibida  en el formuario, y  el tercer parametro es el tipo  de dato(PDO::PARAM_STR(es dato string)):
                $stm->bindParam(':d1', $d1, PDO::PARAM_STR);
                $stm->bindParam(':d2', $d2, PDO::PARAM_STR);
                $stm->bindParam(':d3', $d3, PDO::PARAM_STR);
                $stm->bindParam(':d4', $d4, PDO::PARAM_STR);
                $stm->bindParam(':d5', $d5, PDO::PARAM_STR);
                $stm->bindParam(':d6', $d6, PDO::PARAM_STR);
                $stm->bindParam(':d7', $d7, PDO::PARAM_STR);
                $stm->bindParam(':d8', $d8, PDO::PARAM_STR);
                //si en la variable de proxima vacuna esta guardado un dato o NULL , quiere decir que se debe actualizar las vacunas.
            if(($proxVac == NULL) || ($datos_vac[1] != '')){
                // si hay guaradao  en el array una fecha de prosima vac y  proxima dosis entonces hago el update  con esas fechas.
                if(($datos_vac[1] != '') && ($datos_vac[0] != '')){
                     $stm->bindParam(':proxF', $datos_vac[0], PDO::PARAM_STR);
                     $stm->bindParam(':proxD', $datos_vac[1], PDO::PARAM_STR);
                }else{
                    $stm->bindParam(':proxF', $date_form, PDO::PARAM_STR);
                    $stm->bindParam(':proxD', $proxVac, PDO::PARAM_STR);
                }
            }else{
                //echo ' se envia solo los datos de fechas';
            }
            
                $stm->bindParam(':idPD', $idPdes);
                //ejecutar la consulta:
                $stm->execute();
            } catch (PDOException $exception) {
                echo $exception;
            }

// try {
//     //preparar la consulta:
//     $stm = $pdo->prepare($c);
//     //ejecutar la consulta:
//     //vincular los dats con bimparams(recomendado):
//     //primer argumento es el argumento  que especifico  en la consulta, el segundo parametro es la variable recibida  en el formuario, y  el tercer parametro es el tipo  de dato(PDO::PARAM_STR(es dato string)):
//     $stm->bindParam(':21days', $days21, PDO::PARAM_STR);
//     $stm->bindParam(':semana5', $week5, PDO::PARAM_STR);
//     $stm->bindParam(':semana7', $week7, PDO::PARAM_STR);
//     $stm->bindParam(':semana9', $week9, PDO::PARAM_STR);
//     $stm->bindParam(':3meses', $mes3, PDO::PARAM_STR);
//     $stm->bindParam(':4meses', $mes4, PDO::PARAM_STR);
//     $stm->bindParam(':5meses', $mes5, PDO::PARAM_STR);
//     $stm->bindParam(':mes3fr', $mesesFr3 , PDO::PARAM_STR);
//     $stm->bindParam(':idPV', $idPdes, PDO::PARAM_STR);
//     //ejecutar la consulta:
//     $stm->execute();
// } catch (PDOException $exception) {
//     echo $exception;
// }
//Si el último identificador insertado es mayor que cero, la inserción funcionó.
$count = $stm->rowCount();
if($count > 0){
    $_SESSION['rta_admin'] = "ok_form";
    echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios'</script>";
    //echo "<script>window.location.href='index.php?seccion=AdminUsuarios'</script>";
}else{
    $_SESSION['rta_admin'] = "error";
    echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios'</script>";
    //echo "<script>window.location.href='index.php?seccion=AdminUsuarios'</script>";
}
        }else{
            $_SESSION['rta_admin'] = "DateNull";
        echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios'</script>";
        }
        
    }else{
        $_SESSION['rta_admin'] = "DateNull";
        echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios'</script>";
    }
   
        
?>