// este script sirve para ala tbala de usuarios, desplegar las publicaciones de pservicios
export default function adminPublic(e){
    let clase ;
    //en clase guardo la primera clase q aparece guardad de el registro que le diclick
    //en clase guardo la concatenacion de . + la clase que corresponde a donde le diclick:
    clase = e.target.classList[0];
    console.log(clase)
    // si le di clikc a una parte del cocumento deonde no tiene clase no ejejcuto
    if(clase == undefined){
        return
    }
     //este script es para la interaccion de mostarr o ocultar informacion de  usuario 
    const d = document;
    //expresion regular para validar que en la clase se va a encontrar un numero que especifica el numero de identificacion de cada usuario
    var regex = /(\d+)/g;
    //aqui almaceno la funcion
    let openWindow;
    let a, b,c,g;
    //en este script uso query en vez de id para capturar las casillas desplegables:
    let aComprobar = '.AdminPublicTable__';
    //en a comprobar guardo ese numero que aparece en la clase que le di click, o  sea el enlace de ver, para poder capturar la tabla que se identifica por un id numero que corresponde  cada usuario.
    aComprobar += clase.match(regex);
    //en a guardo  construyo la clase que le di clikc, para identificar y  capturar el usuario  a travez de su id y clase unica y  para ver si coincide con match 
    a = '.';
    a += clase;

    //concateno  a up con acomprobar que es el numero identiifcador  para capturar el parrafo unico identificado con un id propio  de un id usuario para poder poner ver  o ocultar.
    let up = 'up__';
    up += aComprobar;
    //en clase__box guardo la tabla donde corresponde a la clase q ledi click con el id de usuario:
    let clase_box = document.querySelectorAll(aComprobar);
    b = "block__filter--table";
    //en este script c, es una lista de elementos que contiene la clase .
    c = clase_box;
    g = "";
    console.log(a);
    console.log(b);
    console.log(c);
    console.log(aComprobar);
    openWindow = function (a,b,c,g,e){
        if(e.target.matches(a)){
            console.log('coincide')
            //selecciono  al padre info__personal para que el div paginaador se selecciones  a travez de la clase que se le agrega cuando se muestra la informacio, esto hara que el paginador este siempre pegado al final del docmento:
            d.querySelector('.info__personal').classList.add('info__personal--paginador')
            e.preventDefault();
            c.forEach(element => {
                element.classList.toggle(b);
            });
            
            // if(d.getElementById(up).innerText == 'Ver'){
            //     d.querySelector('.info__personal').classList.add('info__personal--paginador')
            //     d.getElementById(up).textContent = "Ocultar";
            // }else{
            //     d.querySelector('.info__personal').classList.remove('info__personal--paginador')
            //     d.getElementById(up).textContent = 'Ver';
            // }
        }
}
    //solo si he dado click en un elemento  que contiene en su clase la palabra user__ se va a ejecutar la funcion:
    if(a.includes('AdminPublic__')){
        openWindow(a,b,c,g,e);
    }else{
        
    }
}