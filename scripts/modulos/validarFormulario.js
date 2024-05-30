const d = document;
export default function contact_form(){
    // localizar el formulario:
    const $form = d.querySelector('.contact-form');
    //localizar los input que tengan como atributo required
    const $inputs = d.querySelectorAll('.contact-form [required]')
    //por cada input que es requerido o que no esta validado, pues creo un span para mostrar el mensaje de advetencia debajo  del input:
    $inputs.forEach(input=>{
        const $span = d.createElement("span");
        //le asigno  a span creado en su  id el valor que viene en mi input como name, asi queda diferente los id para cada span.
        $span.id = input.name;
        // a ese atributo span en us propiedad textcontent le asigno el valor que tiene el input en su atributo title, es decir el mensaje 
        $span.textContent = input.title
        //agrego la calse para dar estilos y para que no se muestr mientras no se lo diga:
        $span.classList.add("contact-form-error", "none")
        //con la propiedad insertAdjacentElement() vista en el video 71 de modificar elementos le digo que agregue ese span justo debajo de mi input:
        //parametros:como es hermano posterior del input pongo  , y el nombre del 
        input.insertAdjacentElement("afterend",$span);
    })
    //la validacion se puiede hacer hasta cuando el usuario de click en el boton de enviar, pero en este caso las validaciones se van a integrar cuando el usuario este escribirendo en los inputs, y para eso uso el evento keyup:
    d.addEventListener("keyup", e=>{
        if(e.target.matches('.contact-form [required]')){
            //guardo en una variable el elemento donde se origino el evento:
            let $input = e.target;
           
            // en patern guardo el atributo pattern del elemento inpiut, pero uso uin cortociurcuito para los textarea, recordar q textaarea no tiene el atributo patern: asi q llamo  al data atribute con dataset
            let pattern = $input.pattern || $input.dataset.pattern;
            //si es valida la variablepattern, si hay contenido en esa variabley  si en el input ya empezo a escribir algo:
            if(pattern && $input.value!==""){
                //guardo la expresion regular guardada en patern
                let regex = new RegExp(pattern)
                //operador ternario, si la expresion regular guardad en regex, no valida, (se usa metodo exec de expresiones regulares) si el valor del input no cumple con la expresion regular: localice el span y  active la clase
                // return !regex.exec($input.value)?d.getElementById($input.name).classList.add("is-active"):d.getElementById($input.name).classList.remove("is-active");
                if(!regex.exec($input.value)){
                    console.log("mal formato");       
                     d.getElementById($input.name).classList.add("is-active");
                     
                }else if(regex.exec($input.value)){
                    //console.log("bien el formato");
                     d.getElementById($input.name).classList.remove("is-active");
                }
            //solo va a ejecutar esta parte para el formulario de validar conraseña
            if(d.querySelector('.submit') != null){
                //localizar el boton de enviar
                const $form__submit = d.querySelector('.submit');
                if(d.getElementById('confirm__contrasenia').value == d.getElementById('contrasenia').value){
                    //console.log("las contraseñas coinciden");
                     //console.log("las contraseñas coinciden" + d.getElementById('confirm__contrasenia').value + "1 password es: " + d.getElementById('contrasenia').value);
                    d.getElementById('confirmpassword').classList.remove("is-active");
                    $form__submit.disabled = false;
                }else if(d.getElementById('confirm__contrasenia').value != d.getElementById('contrasenia').value){
                    //console.log("las contraseñas NO  coinciden");
                     //console.log("las contraseñas coinciden" + d.getElementById('confirm__contrasenia').value + "1 password es: " + d.getElementById('contrasenia').value);
                    d.getElementById("confirmpassword").classList.add("is-active");
                        $form__submit.disabled = true;
                }else{
                    //console.log('ninguno');
                }
            }
            }
            if(!pattern){
                return $input.value === ""?d.getElementById($input.name).classList.add("is-active"):d.getElementById($input.name).classList.remove("is-active")
            }
          
        }
    })
}