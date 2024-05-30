var ancho;
let d = document
let close 
let open 
let form_responsive 
//es el dialog que contiene al formulario
let form_dialog 
let aside 
var openModal;
let f;
openModal = function (a,b,c,fz){
    d.addEventListener("click", (e)=>{
        if(e.target.matches(a)){
            e.preventDefault();
            f.showModal();
            //di click en enviar solicitud de formulario de filtro,  cierro modal, igual en la x de ababjo
        }else if(e.target.matches(b)){
            //e.preventDefault();
            //console.log("di click en cerrar modal");
            f.close();
        }else if(e.target.matches(c)){
            e.preventDefault();
            //console.log("di click en cerrar modal");
            f.close();
        }
    })
}
function sizewindow(){
    //funcion del  window que detecta el ancho  de la pantalla cuando  se abre el navegador
    ancho = window.innerWidth;
    function responsive(ancho){
        //si el ancho es mejor o  igual a 730,
        if(ancho <= 730){
            //si el  aside tiene hijo que s el formulario,  el formuario esta en el aside, y se debe poner en el dialog
            if (aside.hasChildNodes()){
                //elimino  el forkulario del aside
                 var antiguoHijo = aside.removeChild(form_responsive);
                // //agrego ese formulario al dialog
                 form_dialog.appendChild(antiguoHijo)
            }
        }else{
            //cuando  es mayor el tamaño  de la cventana, pues elimino el form de dialog y lo  asigno  al aside
            if (form_dialog.hasChildNodes()){
                var antiguoHijo = form_dialog.removeChild(form_responsive);
                aside.classList.add('aside');
                aside.appendChild(antiguoHijo)
            }
        }
    }//ejecuto  la funcion con el parametro
    responsive(ancho);
    //la funcion se ejecuta tambien cuando se redimensiona el tamaño  del navegador: ver documentacion 1.
    window.addEventListener("resize", (e)=>{
        ancho = window.innerWidth;
        responsive(ancho)
    })
    
}
//funcion que dispara los eventos y  escuchadores de eventos y  ejecuta la ventana modal.
export default function modal(a,b,c){
    if (d.getElementById("adopta_mascota") == null){
        return
    }
    // la imagen de cerrar es decir la x que sale cuando  se abre el modal.
    close = d.querySelector(".modalClose");
    //el input de enviar el filtro
    open= d.querySelector(".modalOpen");
    //el formulario
    form_responsive = d.querySelector(".filter__responsive");
    //es el dialog que contiene al formulario
    form_dialog = d.querySelector(".filter__responsiveFather");
    //el aside que contiene el formulario cuando la pantalla es mayor a 730
    f = form_dialog
    aside = d.querySelector(".aside_hiden");
    sizewindow()
    openModal(a,b,c,f)
}
export {openModal};