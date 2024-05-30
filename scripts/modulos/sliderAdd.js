const d = document;
let $add;
export default function sliderAdd(){
    //con intersection observer:
    //selecciono todas las cajas
    const boxes = document.querySelectorAll('.add__container--box')
    const boxObserver = document.querySelector('.add__container')
    //array que contiene las cajas que se van interceptadno
    //el utlimo elemento es, para que cuando llegue hasta el, se se mueva hacia atras:
    let box = boxes.length;
    let ultimateBox = 'box' + box;
    let boxIntercepted = [];
    //funcion que se ejecuta en la instancia de intersection observer y  recivbe los parametros de los elementos que tiene que vigilar, en este caso cada una de las cajas
    const callback = (entries) => {
        //muestra propiedad del elemento observado, por ejemplo isintercepting, que es si false si no esta siendo interceptado
        // console.log(entries)
        //los entries los itero con un foreach, entry  es cada una de las entradas
        entries.forEach(entry => {
            //si entry o el elemento esta siendo interceptado, me muestre el  elemento(target y  a su atributo id) y el mensaje is intersecting
            if (entry.isIntersecting) {
                //en add guardo el id box1 o 2...del add que se esta interceptadndo o viendo en la caja  lo guardo  en un array, 
                $add = entry.target.id
                boxIntercepted  = [$add]

            }
        })
    }

    //el objeto options es otro parametros que recibe aparte del callback, root es la ventana qie me va a servir como ventana observadora, por defecto sera el vieport del navegador. rootmargin es la mdida extra o no(cuando es negativo) del tamaño  del  viewport especificado anteriormente que va a servir como ventana observadora, si  es -200px como un solo valor, el elemento  se observara 200px antes de que pase  del limite de los 4 lados del viewport, si es pecifico 2 o las 4 medidas corresponde a los 4 lados respectivamente,threshold recibe valore de 0 y 1, cero es por defecto, si pongo 0.25, se intersectara cuando se vea el 25% de la caja observada, funciona arriba y abajo
    const options = {
        root:boxObserver,
        // rootMargin: '-200px'
        threshold: 1
    }
    //instancio el intersection observer como un objeto, recibe dos parametros, el segundo   es opcional(OPTIONS), pero el primero es obligatorio. el primer es la funcion que se ejecuta cuando algo entre en el rango de vision callback.
    const observer = new IntersectionObserver(callback, options)
    //recorro las cajas con foreachy le digo que observe cada elemento con observe q es el objeto q observa, y observo con el metodo observe y le paso el  elemento o la caja ya iterada
    boxes.forEach(element => observer.observe(element))

    const carrusell = d.querySelector(".carrusell");
    let step = 1;
    let intervalo = null;
    const start = ()=>{
        intervalo = setInterval(function () {
            // carrusel-scrollleft desde el comienzo  es 0, porque no  se ha desplazado nada hacia la izquierda.  a eso le sumo el mismo mas 1 pixel
            carrusell.scrollLeft = carrusell.scrollLeft + step;
            console.log('el valor de step es :  ' + step)
     
            //si en el array esta guardado box9, significa que ya lo intercepto y por ello invierto a restar con -1 al valor del carrusel carrusell.scrollLeft
            //si ya recorrio todo el carruse o ya llego hasta el ultim, entonvces debe invertirse la cuenta para que recorra hacia atras y se mueva hacia atras:
            if (boxIntercepted[0] == ultimateBox ) {
                step = step * -1;
             
                //luego lo elimino  a box9 del array ara quen no se vuelva a cumplir y n ose invierta la resta a suma
                boxIntercepted.shift()
            }else if(boxIntercepted[0] == 'box1'){
                step = 1;
                boxIntercepted.shift();
            }
        }, 20);
    }
    const stop = () => {
        clearInterval(intervalo);
      };
      carrusell.addEventListener("mouseover", () => {
        stop();
      });
      carrusell.addEventListener("mouseout", () => {
        start();
      });
      //adiciono un observador a la ventaa del navegador, donde ejecuto la funcion de moverse solo cuandno el carrusel este viendo se en el viewport
      const addContainer = document.querySelector('.add')
      const callback2 = (entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                stop()
                start();
            }else{
                stop()
            }
        })
    }
    const options2 = {
        //root:boxObserver,
        // rootMargin: '-200px'
        threshold: 0.3
    }

    const observerAdd = new IntersectionObserver(callback2, options2)

    observerAdd.observe(addContainer)

}