<?php
    include('../../../../configuracion/conexion.php');
    //este scrip es para procesar los datos enviados por formulario para editar informacion de plan de vacunacion de un perro
    $_SESSION['rta_admin'];
    //seguridad de la pagina.
    if(isset($_SESSION['user_id'])){
        if($_SESSION['nivel_usuario'] == 'administrador'){
            //echo "<script>window.location.href='/veterinaria/admin/index.php'</script>";
        }else{
            //echo "No existe usuario administrador";
            $_SESSION['rta'] = 'noAutorizado';
            echo "<script>window.location.href='/veterinaria/index.php?seccion=perfil'</script>";
        }
    }else{
        //echo "existe usuario";
        $_SESSION['rta'] = 'noAutorizado';
        echo "<script>window.location.href='/veterinaria/index.php'</script>";
    }
    //solo si ercivo por get un id q de un plan de vacunacion, proceso la informacin.
    if(isset($_GET['idPvac'])){
        //si no esta vacia:
        if(!empty($_GET['idPvac'])){
            //creo variables que posteriormente seran un array para guardar  y actualizar en la db
            $date_form;
            $proxVac;
            $c = "UPDATE planvacunacion set vacuna1=:vac1, vacuna2=:vac2, vacuna3=:vac3, vacuna4=:vac4, vacuna5=:vac5";
            $idPvac = $_GET['idPvac'];
            // recivo la fecha proxima de vacunacion que es unica para cada paciente y  la dosis que corresponde:
            $fechaProx = $_POST['fechaP'];
            $ProxDosis = $_POST['Dosis'];
            $vac1 = $_POST['vac1'];
            $vac2 = $_POST['vac2'];
            $vac3 = $_POST['vac3'];
            $vac4 = $_POST['vac4'];
            $vac5 = $_POST['vac5'];
            // si me envia por post, es decir si esta marcado el checkbox para indicar que se aplico la vacuna: 
            $a = 1;
            $listadoVacunas = ["cero",'Refuerzo y Hepatitis', 'Tercer Refuerzo y Leptospira', 'Rabia', 'Polivalente Refuerzo Anual', 'polivalente'];
            $listadoTiemposVacunas = ["cero", "+2 week","+2 week", "+2 week", " + 9 month", "+ 1 year"];
            while ($a <= 5) {
                if(isset($_POST['vac' . $a])){
                    // si no esta vacio
                    if(empty($_POST['vac' . $a])){
                        // creo una fecha para el dia que s eaplico la vacuna:
                        ${'vac' . $a} = date("Y-m-d H:i:s");
                        //creo la fecha  para la proxima vacuna
                        $proxFecha = strtotime(${'vac' . $a}  . $listadoTiemposVacunas[$a]);
                        $date_form = date('Y-m-d H:i:s', $proxFecha);
                        // indico el nombre de la proxima dosis
                        $proxVac = $listadoVacunas[$a];
                        //le concateno  a la consulta para actualizar los datos en la db del plan de vacunacion del pacientes
                        $c = $c . ', FechaProxima=:proxF, ProximaDosis=:proxD ';
                        // guardo este valor en un array , y de esta forma se que debo actualizar este dato, que es la proxima fecha y dosis. si en otra vacuna sale actualizar con fecha proxima o disis diferente, esta pisara la anterior.
                        $datos_vac = [$date_form, $proxVac];
                    }else{
                        // se envia el dato, pero esta vez en el value del input tipo checkbox del formulario envia una fecha , porque encontro un registro  en la db, esto quiere dcir que debo actualizar con la misma fecha que estaba registrada, esto pasa cuando el checkbox ya esta con chulo en el formulario. quiere decir que ya sse habia aplicado la vacuna. vuelvo  a crear la fecha proxima y proxima dosis, porque necesito que se guarde en el array los  datos para hcaer el update, ya que si se desmarca el condicional va a saltar a el else de no envio de post y  va a subir null en la db. 
                
                        ${'vac' . $a} = $_POST['vac' . $a];
                        $proxFecha = $fechaProx;
                        $proxVac = $listadoVacunas[$a];
                        $proxFecha = strtotime(${'vac' . $a}.$listadoTiemposVacunas[$a]);
                        $date_form = date('Y-m-d H:i:s', $proxFecha);
                        $c = $c . ', FechaProxima=:proxF, ProximaDosis=:proxD ';
                        $datos_vac = [$date_form, $proxVac];
                    }
                    
                }else{
                    //este caso no se envia nada, es decir se desmarca el chulo del input, por lo tanto debo actualizar la fecha de la vac1,  la prosima fecha y  la proxima dosis a null, sin embargo el sistema evalua primero si hay guaradao en un array fecha prox y dosis proxima para comprobar si debo usar las variables de este caso o hay fehcas de proxfecha y proxima dosis guardadas en el array que se deben actualizar, esto pasa cuando se desmarcan chulos.
                    ${'vac' . $a} = NULL;
                    $proxVac = NULL;
                    $date_form = NULL;
                    $c = $c . ', FechaProxima=:proxF, ProximaDosis=:proxD ';
                }
                $a += 1;
            }
            $c = $c . 'WHERE idplanvacunacion=:idPV';
            try {

                $stm = $pdo->prepare($c);
                //ejecutar la consulta:
                //vincular los dats con bimparams(recomendado):
                //primer argumento es el argumento  que especifico  en la consulta, el segundo parametro es la variable recibida  en el formuario, y  el tercer parametro es el tipo  de dato(PDO::PARAM_STR(es dato string)):
                $stm->bindParam(':vac1', $vac1, PDO::PARAM_STR);
                $stm->bindParam(':vac2', $vac2, PDO::PARAM_STR);
                $stm->bindParam(':vac3', $vac3, PDO::PARAM_STR);
                $stm->bindParam(':vac4', $vac4, PDO::PARAM_STR);
                $stm->bindParam(':vac5', $vac5, PDO::PARAM_STR);
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
                $stm->bindParam(':idPV', $idPvac);
                //ejecutar la consulta:
                $stm->execute();
            } catch (PDOException $exception) {
                echo $exception;
            }
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