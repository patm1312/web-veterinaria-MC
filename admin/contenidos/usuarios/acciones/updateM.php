<?php
    include('../../../../configuracion/conexion.php');
    //este scrip es para procesar los datos enviados por formulario para editar informacion de usuario: 
    $_SESSION['rta_admin'];
    //seguridad de la pagina.
    $maximo = 2 * 1024 * 1024; //Tamaño en MB
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
    if(isset($_GET['idU'])){
        if(!empty($_GET['idU'])){
            if(isset($_SESSION['foto'])){
                $foto = $_SESSION['foto'];
            }else{
            }
            //foto del slider que se envia a travez de session , es la ruta de la imagen que esta en la db de la publicacion en cuestion, q se va a modificar.
            //le quito esta ruta, ya que es la ruta almacenada en la DB, y con esa ruta no puedo elimnar la imagen en el servidor.
            $fotoM = str_replace('/contenidos/usuarios/assets/imgMascotas/', '', $foto);
            unset($_SESSION['foto']);
            $nombre = $_POST['name'];
            $raza = $_POST['raza'];
            $fechaN = $_POST['fechaN'];
            $color = $_POST['color'];
            $especie = $_POST['especie'];
            $sexo = $_POST['sexo'];
            $talla = $_POST['talla'];
            $esterilizado = $_POST['esterilizado'];
            $idU = $_GET['idU'];
            $idM = $_GET['idM'];
            if(($_FILES['imagen']['size'][0] > $maximo) || ($_FILES['imagen']['size'][1] > $maximo)){
                $_SESSION['rta_admin'] = "img_big";
                echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios&accion=editarMascota&idM=$idM&idU=$idU'</script>";
                }else{
                    $c = "UPDATE pacientes set nombre=:nombre, raza=:raza, color=:color, sexo=:sexo, especie=:especie, esterilizado=:esterilizado, talla=:talla, fechaNac=:fechaN, fechaAlta=now()";
                    if(($_FILES['imagen']['size'][0] > 0)){
                        //hay imagen de Pservicio cargada 
                        $imagenuno = $_FILES['imagen']['name'][0];
                        $tmp1_dir = $_FILES['imagen']['tmp_name'][0];
                        //este es el recurso q se guarda en la carpeta del servidor
                        $upload_diruno = '../assets/imgMascotas/'; // upload directory
                        $img1Ext = strtolower(pathinfo($imagenuno,PATHINFO_EXTENSION)); 
                        $fotoErase = $upload_diruno . $fotoM;
                        $fileImguno = time( ).rand(1,1000).".".$img1Ext;
                        //esta es la ruta que se guarda en la bd para acceder a ella desde readImg.php
                        $path1DB = '/contenidos/usuarios/assets/imgMascotas/'. $fileImguno;
                        //concateno la consulta,
                        $c = $c . ", foto=:foto";
                        
                        try {
                            //elimino la img del servidor
                            unlink($fotoErase);
                            //cargo la nueva imagen en el servidor.
                            move_uploaded_file($tmp1_dir,$upload_diruno.$fileImguno);
                        } catch (\Throwable $th) {
                            echo $th;
                        }
                    }
                   $c = $c .  " WHERE idpacientes=:idM AND usuario_idusuario=:idU";
                        try {
                            //preparar la consulta:
                            $stm = $pdo->prepare($c);
                            //ejecutar la consulta:
                            //vincular los dats con bimparams(recomendado):
                            //primer argumento es el argumento  que especifico  en la consulta, el segundo parametro es la variable recibida  en el formuario, y  el tercer parametro es el tipo  de dato(PDO::PARAM_STR(es dato string)):
                            $stm->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                            $stm->bindParam(':raza', $raza, PDO::PARAM_STR);
                            $stm->bindParam(':color', $color, PDO::PARAM_STR); 
                            $stm->bindParam(':especie', $especie, PDO::PARAM_STR); 
                            $stm->bindParam(':talla', $talla, PDO::PARAM_STR); 
                            $stm->bindParam(':esterilizado', $esterilizado, PDO::PARAM_STR); 
                            $stm->bindParam(':sexo', $sexo, PDO::PARAM_STR); 
                            $stm->bindParam(':fechaN', $fechaN, PDO::PARAM_STR); 
                            $stm->bindParam(':idM', $idM);
                            $stm->bindParam(':idU', $idU);
                            if($_FILES['imagen']['size'][0] > 0){
                                $stm->bindParam(':foto', $path1DB);
                            }
                            //ejecutar la consulta:
                            $stm->execute();
                        } catch (PDOException $exception) {
                            echo $exception;
                        }
                          //Si el último identificador insertado es mayor que cero, la inserción funcionó.
                          $count = $stm->rowCount();
                          if($count > 0){
                              $_SESSION['rta_admin'] = "ok_form";
                              echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios&accion=editarMascota&idM=$idM&idU=$idU'</script>";
                          }else{
                              $_SESSION['rta_admin'] = "error";
                             echo "<script>window.location.href='../../../index.php?seccion=AdminUsuarios&accion=editarMascota&idM=$idM&idU=$idU'</script>";
                          }
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