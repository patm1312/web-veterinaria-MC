export default function filter(e){
        const d = document;
        var filtros = {".filtro__1":".box__filter--one",
                        ".filtro__2":".box__filter--two",
                        ".filtro__3":".box__filter--three",
                        ".filtro__4":".box__filter--four",
                        ".filtro__5":".box__filter--five",
                        ".filtro__6":".box__filter--six"};
    //aqui almaceno la funcion
            let openWindow;
            let a, b,c,g;
            //en clase guardo la concatenacion de . + la clase que corresponde a donde le diclick:
            let clase = ".";
            clase  += e.target.classList[0];
            a = clase;
            //obtengo el numero de filtro que le di click, este se almacena en la calse que corresponde a un filtro unico..filyto__1 ...
            let numFiltro = clase.slice(-1)
            //concateno con down +  el numfiltro para acceder a las flechas de up y down que cambian cuando  el usuario da click
            let down = '.down__';
            let up = '.up__';
            up += numFiltro;
            down += numFiltro;
            //en clase__box guardo el selector para seleccionar el div que corresponde a cada enlace de filtro en donde le he dado click, ver array:
            let clase_box = filtros[clase];
            b = "block__filter";
            c = d.querySelector(clase_box);
            g = "";
           
        openWindow = function (a,b,c,g,e){
            if(e.target.matches(a)){
                e.preventDefault();
                //al elelmento nav o al input de buscar lo  activo  ponienole la clase b
                c.classList.toggle(b);
                //si el div que contiene los input radio esta activado o tiene la clase block__filter, muestro down
                if(c.classList.value.includes('block__filter')){
                    d.querySelector(up).classList.add('block__filter');
                    d.querySelector(down).classList.add('none__filter');
                }else{
                    d.querySelector(up).classList.remove('block__filter');
                    d.querySelector(down).classList.remove('none__filter');
                    
                }
            }else if(e.target.matches('.header')){
            
            }
    }
    //solo si he dado click en un elemento  que contiene en su clase la palabra filtro se va a ejecutar la funcio:
    if(a.includes('filtro')){
        openWindow(a,b,c,g,e);
    }else{
        
    }

}