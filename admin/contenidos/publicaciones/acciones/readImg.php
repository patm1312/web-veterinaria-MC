<?php
//es la nueva ventana q se abre cuando  le di click en icono  de admin publicaciones, este script esta incluido en el indexadmin:
    //$pic = isset($_GET['pic']) ? $_GET['pic']:'default/default.png';
    $src;
     if(isset($_GET['pic'])){
        $src = $_GET['pic'];
        $portada = 'portada.';
        $findme   = $src;
        $pos = strpos($findme, $portada);
        $perfilU= 'usuario.';
        $perfil = strpos($findme, $perfilU);
        if($pos){
            $default = '/';
            $src = $default . $src;
        }else if($perfil){
            $default = '/';
            $src = $default . $src;
        }else{
            echo 'ninguna';
            $src = './' . $_GET['pic'];
        }
        echo $src;
        // if(empty($_GET['id'])){
        //     $src = 'contenidos/publicaciones/assets/' . $pic;
        // }else{
        //     $src = 'contenidos/publicaciones/assets/ContenidoPServ/' . $pic;
        // }
    }
?>
<section class="section__img">
<p>Imagen Cargada</p>
<img class="section__img--img" src="<?php echo $src; ?>" alt="foto"> 
<img class="section__img--img" src="contenidos/usuarios/assets/imgPortada/1714183144216.png" alt="foto"> 
</section>
  
