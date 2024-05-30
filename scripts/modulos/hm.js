//funcion que gestiona el menu de navegacion dependiendo del responsive
//menu  de navegacion version movil
let openWindow;
const d = document;
var a,b,c,g;
//witdh screen guarda el tamaño de pantalla una vez cargado el docuumentoy haber hecho click
var withScreen;
//la funcion responsive menu tiene como parametro e, que es el evento clikc que se dio click
export default function responsiveMenu(e){
    withScreen = window.innerWidth;
    // si el tamaño  de pantalla es menor a 900, quiere decir que, esta habilitado el menu hm, desde la mediaquery. uso las clases para que una vez se le de clikc en el icono hm, aparezca ell menu lateral responsivo.
    if(withScreen <= 900){
        //este es la clase que contiene el icono hm
        a = '.enlace_hm';
        //este es la clase que activa el menu
        b = "nav_responsive";
        //este es menu que esta oculto
        c = d.querySelector(".nav");
        //este boton es opcional, es una X , para que el usuario de click y cierre el menu.
        g = '.closee__menu';
    }else{
        //si el tamaño de pantall es mayor a 900 px, esta activado  el menu  ampliado, entonces uso las siguienetes clases:
        //clase que contiene la lupa de buscar:
        a = '.glass__search';
        //clase que activa 
        b = "n_block";
        // buscador que contiene el input y la lupa
        c = d.querySelector(".header-hm");
        // boton d ecierre opcional.
        g = '.closee__menu';
    }
    //en mql, guardo algun posible cambio de la media query evaluada con match media, es decir si se esta cumpliendo o no. esto para cuando el usuario haga cambio  de tamaño de pantalla, como no  se carga el documento, no se va a actualizar que tamaño de pantalla estoy para saber en donde debo  aplicar la funcion, si en el menu hm o en la lupa que tiene el meu ampliado:
    var mql = window.matchMedia("screen and (min-width: 900px)");
    //si hay un cambio en el tamaño de la pantalla y ya paso los 900px 
        mql.addEventListener('change',(e)=>{
            //si es verdadero: estoy en el menu ampliado 
            if(e.matches){
                a = '.glass__search';
                b = "nav__search";
                c = d.querySelector(".header-hm");
                g = '.closee__menu';
            }else{
                //estoy en elmenu hm
                a = '.enlace_hm';
                b = "nav_responsive";
                c = d.querySelector(".nav");
                g = '.closee__menu';
            }
        })
        //open window 
        openWindow = function (a,b,c,g,e){
            //si le di click a la lupa o al menu hm
            if(e.target.matches(a)){
                e.preventDefault();
                //al elelmento nav o al input de buscar lo  activo  ponienole la clase b
                c.classList.toggle(b);
            }else if(e.target.matches('.header')){
                e.preventDefault();
                c.classList.remove(b);
            }
    }
    openWindow(a,b,c,g,e);
    //esta funcion s eejecuta solo  cuando una vez di click en la lupa, se oculte em menu principal y  aparezca el buscador:
        function responsive(){
            const navs = d.querySelectorAll('.nav__none');
                navs.forEach(nav => {
                    if(d.querySelector('.n_block') == null){
                        nav.classList.remove('none__nav');
                    }else{
                        nav.classList.add('none__nav');
                    }
                    
                });
    }
    if(window.innerWidth <= 900){
    }else{
        responsive();
    }

}
