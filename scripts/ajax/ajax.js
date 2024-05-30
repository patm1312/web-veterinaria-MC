export default function(){
     //un nuevo objeto ajax para este caso este uso
     const xhr = new XMLHttpRequest;
     //el segundo paso es crear un evento , el mas comun en ajax es el onreadystatechange,  que se lanza cuando detecta cualquier cambio  de estado:
    //segundo paso:
    xhr.addEventListener("readystatechange", ()=>{
        //solo se ejecuta la funcion cuando el estado de respuesta READY_STATE_COMPLETE  marca 4,  es decir cuando ya se ha cargado la pagina: cuando sea diferente a 4, que no retorne nada
        if(xhr.readyState != 4){
           return 
        }
        //si el  status del codigo  de respuesta es mayor  a 200 (o sea que solo cuando tiene exito el status) y menor a 300 (si no considero el codigo  de respuesta de 300 pues no considero las redirecciones(es cuando hay una url vieja que redirije a otra en la pagina)) 
         
         if(xhr.status >= 200 && xhr.status < 300){
           
         }else{
             //console.log("error, el codigo  de respuesta no es ninguno de los 200");
             //el statusetxt es el mensaje que envia el servidor cuando la peticion es un eror, por ejemplo un 400...sin embargo este metood en muchos servidores viene vacion:
             let message = xhr.statusText || "ocurrio un erro";
             $xhr.innerHTML = `error ${xhr.status} : ${message}`;
         }
         //muestra todos los estados de lapagina cuando se recarga la pagina: Codigos de estado de respuesta
         //console.log(xhr);
    })
    //luego  necesitamosla instruccion que va a abrir lainstruccion, que es el metodo open: que recibe el primer parametro como el metodo al que se va a comunicar que es por get (url), post(cabeceras del documento), el segundo parametro es el recurso a la cual vamos a hacer la peticion, puede ser la url o un archivo json local:
    // xhr.open("GET", "https://jsonplaceholder.typicode.com/users");
    //con archivo json local:
    xhr.open("GET", "datos.json");
    //luego  se envia la peticion: con el metodo del objeto xmlhttprequest que se llama send:
    xhr.send()
}