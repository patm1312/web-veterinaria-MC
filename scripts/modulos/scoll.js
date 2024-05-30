export default function scroll(btn){
    const $boton = document.querySelector(btn);
    
    //eescuichar a que distancia esta el scroll:
    window.addEventListener("scroll", (e)=>{
        console.log('ejecuto scrol');
        //saber a que distancia esta el scroll, con el metodo de window y la etiqueta html del documento respectivamente:
        // console.log(window.pageYOffset, document.documentElement.scrollTop);

        //creo un corto circuito || para decirle al navegador quie si
        //no soporta la distancia con window, la haga con document:

        let distancia = window.pageYOffset || document.documentElement.scrollTop;
        //si la distancia es mayor a 200, se muestre el boton quitado
        //y poniendo la clase:
        if(distancia > 200){
            $boton.classList.remove("scrol-show")
        }else{
            $boton.classList.add("scrol-show");
        }

    })

    //cuando hagoclick en el boton 
    document.addEventListener("click", (e)=>{
        //si el objeto qiue origino el evento coincide con
        //el selector que tiene el boton:
        if(e.target.matches(btn)){
            //uso el objeto windowTOI, que tiene una serie de opciones: comportamiento (behavior) q es animacion, valor de top(top) a donde quiero q regrese la barra:
            window.scrollTo({
                top:0
            })

        }
    })
}