export default function modalAcciones(e){
  let openWindow;
  openWindow = function (a,b,c,g,e){
    if(e.target.matches(a)){
        e.preventDefault();
        c.classList.toggle(b);
    }else if(e.target.matches(g)){
          e.preventDefault();
        c.classList.remove(b);
    }
}
    //a es el boton que se le hace click, b es la clase que pone display block, quitando  el display none, y c es el menu como tal que aparece.
    let a =".accion_perfil";
    let b ="acciones_modal";
    const c = document.querySelector(".windowopen");
    let g = ".main";
    //funcion que esta exportada desde el menuhm.js, sirve para crear menu desplegable de un boton especifico.
    openWindow(a,b,c,g,e);
 }
