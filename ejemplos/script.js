const d = document;
//funcion que se ejecuta cuando el usuario da click en el boton de documento1 o documento2
function ejecutar(informacion){
    //solicitud a travez de ajax:
    const a = new XMLHttpRequest;
    //por get
    //envio la url y  la variable apellido guardo el contenido del value que corresponde a el input clickeado: 
    let url = "home.php?nombre=german&apellido=";
    url += informacion;
    a.open('GET', url, true);
    a.send(null);
    a.onreadystatechange = function(){
        if(a.readyState == 4){
            if(a.status == 200){
                //en el div cargo la rspuesta procesada en el home.php, que es 
               document.getElementById('respuesta').innerHTML = a.responseText;
            }else if(a.status == 400){
                console.log("no encontrado")
            }
        }
    }
}
d.addEventListener("click", (e) =>{
    console.log("di click en: ")
    if(e.target.matches(".input__1")){
       //cargue el documento1.php 
    }else if(e.target.matches(".input__2")){
        //cargue el documento2.php 
    }
    let informacion = e.target.value;
    ejecutar(informacion)
})