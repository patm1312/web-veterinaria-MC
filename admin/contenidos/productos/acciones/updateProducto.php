<?php
    include('../../../../configuracion/conexion.php');
    //este scrip es para procesar los datos enviados por formulario para editar un producto: 
    $_SESSION['rta_admin'];
    //seguridad de la pagina.
    $maximo = 2 * 1024 * 1024; //Tamaño en MB
    if(isset($_SESSION['user_id'])){
        if($_SESSION['nivel_usuario'] == 'administrador'){
            //echo "<script>window.location.href='/veterinaria/admin/index.php'</script>";
        }else{
            echo "No existe usuario administrador";
            $_SESSION['rta'] = 'noAutorizado';
            echo "<script>window.location.href='/veterinaria/index.php?seccion=perfil'</script>";
        }
    }else{
        //echo "existe usuario";
        $_SESSION['rta'] = 'noAutorizado';
        echo "<script>window.location.href='/veterinaria/index.php'</script>";
    }
    if(isset($_SESSION['foto'])){
        $foto = $_SESSION['foto'];
       
    }else{
    }
    //le quito esta ruta, ya que es la ruta almacenada en la DB, y con esa ruta no puedo elimnar la imagen en el servidor.
    $fotoDB = str_replace('contenidos/productos/assets/', '', $foto);
    unset($_SESSION['foto']);
    if(isset($_POST['tittle'])){
        if(!empty($_POST['tittle'])){
            $nombre = $_POST['tittle'];
            $estado = $_POST['eliminar'];
            $marca = $_POST['marca'];
            $precio = $_POST['price'];
            $color = $_POST['color'];
            $descuento = $_POST['descuento'];
            $descripcion = $_POST['textarea'];
            $categoria = $_POST['categoria'];
            $espacio = $_POST['espacio'];
            $id = $_GET['id'];
            if(($_FILES['imagen']['size'][0] > $maximo)){
                $_SESSION['rta_admin'] = "img_big";
                echo "<script>window.location.href='../../../index.php?seccion=AdminProductos'</script>";
            }else{
                $c = "UPDATE productos set nombre=:nombre, descripcion=:descripcion, categoria=:categoria, precio=:precio, color=:color, marca=:marca, descuento=:descuento, estado=:estado, espacio=:espacio";
                if(($_FILES['imagen']['size'][0] > 0)){
                    //hay imagen de Pservicio cargada 
                    $imagenuno = $_FILES['imagen']['name'][0];
                    $tmp1_dir = $_FILES['imagen']['tmp_name'][0];
                    //este es el recurso q se guarda en la carpeta del servidor
                    $upload_diruno = '../assets/'; // upload directory
                    $img1Ext = strtolower(pathinfo($imagenuno,PATHINFO_EXTENSION)); 
                    $fotoErase = $upload_diruno . $fotoDB;
                    $fileImguno = time( ).rand(1,1000).".".$img1Ext;
                    //esta es la ruta que se guarda en la bd para acceder a ella desde readImg.php
                    $path1DB = 'contenidos/productos/assets/'. $fileImguno;
                    //concateno la consulta,
                    $c = $c . ", foto=:foto";
                    try {
                        //elimino la img del servidor
                        echo '<br>';
                        echo $fotoErase;
                        unlink($fotoErase);
                        //cargo la nueva imagen en el servidor.
                        move_uploaded_file($tmp1_dir,$upload_diruno.$fileImguno);
                    } catch (\Throwable $th) {
                        echo $th;
                    }
                }
               $c = $c .  " WHERE idproductos=:idProducto";
                    try {
                        //preparar la consulta:
                        $stm = $pdo->prepare($c);
                        //ejecutar la consulta:
                        //vincular los dats con bimparams(recomendado):
                        //primer argumento es el argumento  que especifico  en la consulta, el segundo parametro es la variable recibida  en el formuario, y  el tercer parametro es el tipo  de dato(PDO::PARAM_STR(es dato string)):
    
                        $stm->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                        $stm->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                        $stm->bindParam(':categoria', $categoria, PDO::PARAM_STR);
                        $stm->bindParam(':precio', $precio, PDO::PARAM_STR);
                        $stm->bindParam(':color', $color, PDO::PARAM_STR);
                        $stm->bindParam(':marca', $marca, PDO::PARAM_STR);
                        $stm->bindParam(':descuento', $descuento, PDO::PARAM_STR);
                        $stm->bindParam(':estado', $estado);
                        $stm->bindParam(':espacio', $espacio, PDO::PARAM_STR);
                        $stm->bindParam(':idProducto', $id);
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
                        echo "<script>window.location.href='../../../index.php?seccion=AdminProductos&accion=editarProducto&idProd=$id'</script>";
                    }else{
                        $_SESSION['rta_admin'] = "error";
                        echo "<script>window.location.href='../../../index.php?seccion=AdminProductos&accion=editarProducto&idProd=$id'</script>";
                    }
                    
            }
        }else{
            $_SESSION['rta_admin'] = "error";
            echo "<script>window.location.href='../../../index.php?seccion=AdminProductos&accion=editarProducto&idProd=$id'</script>";
        }
        
    }else{
        $_SESSION['rta_admin'] = "DateNull";
        echo "<script>window.location.href='../../../index.php?seccion=AdminProductos&accion=editarProducto&idProd=$id'</script>";
    }
?>