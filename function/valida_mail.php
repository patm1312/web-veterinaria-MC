<?php
if(include('../configuracion/conexion.php')){
    }
    $request;
    //con esta funcion creo sugerencias en formato de fecha con segundos 245 horas, del dia que s eesta solicitamdo la cita y el dia siguiente:
        $message;
function sugerencias(){
    $sugerenciasCitas = [];
    try {
    $hoy = new DateTime();
    $hoy->setTime(8, 0);
    $sm1 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[0] = $sm1;
    $hoy->setTime(9, 00);
    $sm2 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[1] = $sm2;
    $hoy->setTime(10, 00);
    $sm3 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[2] = $sm3;
    $hoy->setTime(10, 30);
    $sm4 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[3] = $sm4;
    $hoy->setTime(11, 00);
    $sm5 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[4] = $sm5;
    $hoy->setTime(15, 00);
    $sa1 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[5] = $sa1;
    $hoy->setTime(15, 30);
    $sa2 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[6] = $sa2;
    $hoy->setTime(16, 00);
    $sa3 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[7] = $sa3;
    $hoy->setTime(17, 00);
    $sa4 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[8] = $sa4;
    $hoy->setTime(17, 30);
    $sa5 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[9] = $sa5;
    $hoy->add(new DateInterval('P1D'));
    $hoy->setTime(8, 0);
    $s1 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[10] = $s1;
    $hoy->setTime(9, 00);
    $s2 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[11] = $s2;
    $hoy->setTime(10, 00);
    $s3 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[12] = $s3;
    $hoy->setTime(10, 30);
    $s4 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[13] = $s4;
    $hoy->setTime(11, 00);
    $s5 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[14] = $s5;

    $hoy->setTime(15, 00);
    $saf1 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[15] = $saf1;
    $hoy->setTime(15, 30);
    $saf2 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[16] = $saf2;
    $hoy->setTime(16, 00);
    $saf3 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[17] = $saf3;
    $hoy->setTime(17, 00);
    $saf4 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[18] = $saf4;
    $hoy->setTime(17, 30);
    $saf5 =  $hoy->format('Y-m-d H:i:s') . "\n";
    $sugerenciasCitas[19] = $saf5;
    //a la feccha de hoy le sumo 2 horas para mostrar solo fehcas con dos horas despues que se este solicitando la cita
    $Today = new DateTime();
    $intervalo = new DateInterval('PT2H');
    $Today->add($intervalo);
    $todayAdd =  $Today->format('Y-m-d H:i:s') . "\n";
    foreach ($sugerenciasCitas as $key ) {
        if($key < $todayAdd){
            $sugerenciasCitas = array_diff($sugerenciasCitas, array($key));
        }
    }
    return $sugerenciasCitas;
    } catch (\Throwable $th) {
        echo $th;
    }
}
$confirmFechas;
//slecciono todas las citas vigentes:
$fecha = $_POST['fechacita'];
 $cTextos2 = "SELECT fechaCita FROM cita WHERE fechaCita >= now()";
$stmt2 = $pdo->prepare($cTextos2);
 $stmt2->setFetchMode(PDO::FETCH_ASSOC);
 $stmt2->execute();
 $rowC = $stmt2->fetchAll(PDO::FETCH_ASSOC);
 $fechaRepetidaDB;
 //si hay fechas en la db , debo comprobar si alguna de ellas  coincide con la fecha que me solicito el susuario
 if(count($rowC ) > 0){
    foreach ($rowC as $key => $value) {
        $fechaUpdate =  $value;
        $fechaU = $fechaUpdate['fechaCita'];
        //si coinicide alguna con la db y es igual a la fecha enviada
        if($fecha == $fechaU){
            $fechaRepetidaDB = $fechaUpdate['fechaCita'];
        }else{
            //segurarme que no me esta enviadno fechas ingferiorees a la fecha y hora actual, menores a 2 horas:
            $Today = new DateTime();
            $intervalo = new DateInterval('PT2H');
            $Today->add($intervalo);
            $todayAdd =  $Today->format('Y-m-d H:i:s') . "\n";
            if($fecha < $todayAdd){
                //la fecha es inferior a la fecha actual y  dos horas:
                 //devuelvo false para uqe se deshabilite el envio  de formulario, ya que no es posible enviar fechas inferiores a la actual:.
                 $request['message'] = false;
                 $request['messageTime'] = true;
                 $confirmFechas = $fecha;
                 $request['fecha'] = $confirmFechas;
                 $request['error'] = true;
                 //echo json_encode($request);
            }else{
                //devuelvo la fecha al usuario dicniendo que si esta disponible porque no  esta agendada o aparatada en la db.
                $request['message'] = true;
                $confirmFechas = $fecha;
                $request['fecha'] = $confirmFechas;
                
            }
        }
    }

 }else{
    //segurarme que no me esta enviadno fechas ingferiorees a la fecha y hora actual, menores a 2 horas:
    $Today = new DateTime();
    $intervalo = new DateInterval('PT2H');
    $Today->add($intervalo);
    $todayAdd =  $Today->format('Y-m-d H:i:s') . "\n";
    if($fecha < $todayAdd){
        //la fecha es inferior a la fecha actual y  dos horas:
         //devuelvo false para uqe se deshabilite el envio  de formulario, ya que no es posible enviar fechas inferiores a la actual:.
         $request['message'] = false;
         $request['messageTime'] = true;
         $confirmFechas = $fecha;
         $request['fecha'] = $confirmFechas;
         $request['error'] = true;
         
         
    }else{
        //devuelvo la fecha al usuario dicniendo que si esta disponible porque no  esta agendada o aparatada en la db.
        $request['message'] = true;
        $confirmFechas = $fecha;
        $request['fecha'] = $confirmFechas;
        //echo json_encode($request);
    }
 }
 //si hay una fehca gaurdad significa que hay una fecha en la db  que es igual a la fecha enviada
 if(!empty($fechaRepetidaDB)){
    //creo las sugerencias
    $sugerenciasF = sugerencias();
    $fechaA=strtotime($fechaRepetidaDB);
    //compruebo las fechas de las sugerencias para eliminar cual de ellas no debo mostrale al usuario porque ya esta agendada a un susario  en ladb:
    foreach ($sugerenciasF as $key2 => $value2) {
        $fechaB=strtotime($value2);
        //si la fecha sugerencia es igual a la fecha agendad en la db:
        if($fechaB == $fechaA){
            $sugerenciasF = array_diff($sugerenciasF, array($value2));
        }else{
            //nunca deberia estar ahi,, se supone que ya hay una fecha que se deberia eliminar
        }
            //ademas comprobar las sugerencias con las fechas en la base de datos para ver si coincide con alguna para eliminarlas de las sugerencias y mostrarselas al usuario:
        foreach ($rowC as $key => $value) {
            $fechaUpdate =  $value;
            $fechaU = $fechaUpdate['fechaCita'];
            $fechaUstr=strtotime($fechaU);
            if($fechaB == $fechaUstr){
                $sugerenciasF = array_diff($sugerenciasF, array($value2));
              
            }else{
                
            }
        }
    }
    

    $porcion1 = array_slice($sugerenciasF, 0, 3);
    $reverseSF = array_reverse($sugerenciasF);
    $porcion2 = array_slice($reverseSF, 0, 1);
    $porcion3 = array_slice($reverseSF, 8, 1);
    $confirmFechas = array_merge($porcion1, $porcion2,  $porcion3);
     //devuelvo una sugerencias de fechas al usuario para que escoja una: .
     $request['message'] = false;
     $request['fecha'] = $confirmFechas;
   
    

 }
 echo json_encode($request);
?>
