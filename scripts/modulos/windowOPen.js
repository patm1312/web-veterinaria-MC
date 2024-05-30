export default function openWindowImg(e){
    console.log('se ejecuta abrir img');
    let $id;
    //si le di click a la imagen que contiene icono de abrir imagen
    //   //funcion que abre una imagen en nueva pestaña al hacer click en un icono, en la pagina de admin publicaciones
    if(e.target.matches(".openImg")){
        e.preventDefault();
        //accedo  al input oculto que guarda el nombred ela imagen que es descargado de mysql
        const $inputPath = e.target.nextElementSibling.value;
        console.log($inputPath);
        //accedo al id en caso q sea un contenido de publicacion:
        $id = e.target.nextElementSibling.id;
        //construyo  el path con ese nombre y se lo envio a la nueva ventana q se abre al evento:
        let path = "/admin/index.php?seccion=openW&pic=" + $inputPath;
        console.log(path)
        window.open(path);
    }
}