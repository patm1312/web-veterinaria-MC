<?php
if(isset($_SESSION['user_id'])){
    if($_SESSION['nivel_usuario'] == 'administrador'){
        
        echo "<script>window.location.href='../../admin/index.php'</script>";
    }else{
      
          echo "<script>window.location.href='../../../index.php?seccion=perfil'</script>";
    }
}else{

     echo "<script>window.location.href='../../index.php'</script>";
}

?>