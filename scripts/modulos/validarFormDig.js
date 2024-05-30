const d = document;
export default function Dig_form(){
     // localizar el formulario:
     const $form_box = d.getElementById('form_dig');
     //creo un span para mostrar el mensaje en caso de que no se valide los datos que se escriben en el input
    const $span = d.createElement("span");
    $span.id = "span_message";
    $span.textContent = "Introduce un numero valido";
    $span.classList.add("contact-form-error", "none")
    $form_box.insertAdjacentElement("afterend",$span);
     d.addEventListener("keyup", e=>{
        //si coincide con un input que est en el formulario qye iene la clase formdig, y  que tiene el atriuto requred:
        if(e.target.matches('.formdig [required]')){
            //guardo en una variable el elemento donde se origino el evento:
            let $input = e.target;
            let digitos = $input.value;
            let numdigitos = digitos.length;
            var valoresAceptados = /^[0-9]+$/;
            if(numdigitos == 1){
                //console.log("tiene un solo digito");
                if (digitos.match(valoresAceptados)){
                    //console.log("es un numero");
                    d.getElementById('span_message').classList.remove("is-active");
                }else{
                    d.getElementById('span_message').classList.add("is-active")
                   //console.log("es un stringde letras")
                }
            }else{
                d.getElementById('span_message').classList.add("is-active")
                //console.log(" no valida tiene mas digitos");
            }
        }
    })
}