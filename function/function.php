<?php
function busca_edad($fecha_nacimiento){
   $datetime1 = new DateTime($fecha_nacimiento);
   $datetime3 = new DateTime();
   $interval = $datetime3->diff($datetime1);
   $edad_masc =  $interval->format('%y años y , %m meses');
   $edad_masc =  [$interval->format('%y'), $interval->format('%m')];
   return $edad_masc;
    }
    function recortar_cadena($texto, $limite=100){
        $texto = trim($texto);
        $texto = strip_tags($texto);
        $tamano = strlen($texto);
        $resultado = '';
        if($tamano <= $limite){
          return $texto;
        }else{
        $texto = substr($texto, 0, $limite);
        $palabras = explode(' ', $texto);
        $resultado = implode(' ', $palabras);
        $resultado .= '...';
      }
        return $resultado;
      }
?>