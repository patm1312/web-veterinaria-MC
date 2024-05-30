<?php
header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=documento.pdf");
if(isset($_GET['file'])){
    $path = $_GET['file'];
    $str = substr($path, 38);
    readfile($str);
}else{
    echo "<script>window.location.href='index.php?seccion=AdminUsuarios'</script>";
}

?>