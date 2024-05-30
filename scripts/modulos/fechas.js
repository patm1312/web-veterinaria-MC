export default function validarFecha(){
     function date_cita(e){
        const inputFechaValidator = document.getElementById('dateFC');
        const inputhoraValidator = document.getElementById('hora');
        const inputminValidator = document.getElementById('min');
        const fecha = inputFecha.value;
        function eraseFragment(){
            const parent = document.getElementById("ul__date");
            const parentP = document.getElementById("ulBox__date");
            const childP = document.querySelector('.p__date');
            for (let index = 1; index <= 5; index++) {
                let claseLi = '.date_' + index;
                const child = document.querySelector(claseLi);
                const throwawayNode = parent.removeChild(child);
                if(document.querySelector('.p__date') != null){
                    const throwawayNode2 = parentP.removeChild(childP);
                }
            }
        }
        if(e.target.matches(".date_1")){
            let $sugerencia1 = document.querySelector(".date_1").innerHTML;
            let ourNewWordDate = $sugerencia1.slice(0,10);
            document.getElementById('dateFC').value = ourNewWordDate;

            let ourNewWordDateHoras = $sugerencia1.slice(11,13);
            document.getElementById('hora').value = ourNewWordDateHoras;

            let ourNewWordDateMin = $sugerencia1.slice(14,16);
            document.getElementById('min').value = ourNewWordDateMin;
            eraseFragment()
         }else if(e.target.matches(".date_2")){
            let $sugerencia2 = document.querySelector(".date_2").innerHTML;
            let ourNewWordDate = $sugerencia2.slice(0,10);
            document.getElementById('dateFC').value = ourNewWordDate;

            let ourNewWordDateHoras = $sugerencia2.slice(11,13);
            document.getElementById('hora').value = ourNewWordDateHoras;

            let ourNewWordDateMin = $sugerencia2.slice(14,16);
            document.getElementById('min').value = ourNewWordDateMin;
            eraseFragment()
         }else if(e.target.matches(".date_3")){
            let $sugerencia3 = document.querySelector(".date_3").innerHTML;
            let ourNewWordDate = $sugerencia3.slice(0,10);
            document.getElementById('dateFC').value = ourNewWordDate;

            let ourNewWordDateHoras = $sugerencia3.slice(11,13);
            document.getElementById('hora').value = ourNewWordDateHoras;

            let ourNewWordDateMin = $sugerencia3.slice(14,16);
            document.getElementById('min').value = ourNewWordDateMin;
            eraseFragment()
        }else if(e.target.matches(".date_4")){
            let $sugerencia4 = document.querySelector(".date_4").innerHTML;
            let ourNewWordDate = $sugerencia4.slice(0,10);
            document.getElementById('dateFC').value = ourNewWordDate;

            let ourNewWordDateHoras = $sugerencia4.slice(11,13);
            document.getElementById('hora').value = ourNewWordDateHoras;

            let ourNewWordDateMin = $sugerencia4.slice(14,16);
            document.getElementById('min').value = ourNewWordDateMin;
            eraseFragment()
        }else if(e.target.matches(".date_5")){
            let $sugerencia5 = document.querySelector(".date_5").innerHTML;
            let ourNewWordDate = $sugerencia5.slice(0,10);
            document.getElementById('dateFC').value = ourNewWordDate;

            let ourNewWordDateHoras = $sugerencia5.slice(11,13);
            document.getElementById('hora').value = ourNewWordDateHoras;

            let ourNewWordDateMin = $sugerencia5.slice(14,16);
            document.getElementById('min').value = ourNewWordDateMin;
            eraseFragment()
        }else{
        }
        let $hora = document.getElementById('hora').value;
        $hora = Number($hora);
        if($hora < 12){
            document.getElementById('dia__date').innerHTML = 'AM' ;
        }else{
            document.getElementById('dia__date').innerHTML = 'PM' ;
        }
     }
    const inputFecha = document.getElementById('dateFC');
     function validar_mail(e){
     const inputhora = document.getElementById('hora');
     const inputmin = document.getElementById('min');
     const fecha = inputFecha.value;
     //console.log(fecha)
        const hora = inputhora.value;
        const minutos = inputmin.value
        const fechaCitaC = fecha + ' ' +  hora + ':' + minutos +':' + '00';
		const aj = new XMLHttpRequest( );
		aj.open('POST', 'function/valida_mail.php', true);
		aj.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		const fechaC = "fechaCitaC="+fechaCitaC ;
        let fechaCitaCC = 'fechaCitaC='+fechaCitaC;
		aj.send('fechacita='+fechaCitaC);
        let input_ajax;
		aj.onreadystatechange = function(){
			if(aj.readyState == 4 ){
				if(aj.status == 200){
                     input_ajax = document.getElementById('fecha_ajax');      
                    let rta = JSON.parse(aj.responseText)
                    console.log(rta);
                    let mensaje = rta['message'];
                    let mensajeTime = rta['messageTime'];
                    let errorD = rta['error'];
                    let fecha = rta['fecha'];
                    // Crear un objeto Date con la fecha y hora proporcionadas

                    // Crear un objeto Date con la fecha y hora proporcionadas
                    var fechaF = new Date(fecha);
                    
                    // Meses legibles
                    var mesesLegibles = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];
                    
                    // Obtener los componentes de la fecha y hora
                    var dia = fechaF.getDate();
                    var mes = mesesLegibles[fechaF.getMonth()]; // Obtener el mes legible
                    var año = fechaF.getFullYear();
                    var hora = fechaF.getHours();
                    var minutos = fechaF.getMinutes();
                    var segundos = fechaF.getSeconds();
                    
                    // Formatear la hora en formato de 12 horas y determinar si es AM o PM
                    var amOpm = hora >= 12 ? "pm" : "am";
                    hora = hora % 12 || 12; // Convertir a formato de 12 horas
                    
                    // Formatear la fecha y hora en un formato legible
                    var fechaFormateada = `${dia} de ${mes} de ${año}, con ${hora}:${minutos < 10 ? '0' : ''}${minutos} ${amOpm} ?`;
                    // console.log(fecha)
                    // let fechaForm =  new Date(fecha);
                    // let newfechaH = fechaForm.toLocaleDateString('es-DO', { weekday:"long", year:"numeric", month:"short", day:"numeric"}) 
                    if(mensaje == true){
                        const $sendForm = document.querySelector('.dateSubmit');
                        let confirmA = confirm('¿Quieres Confirmar tu Cita para el dia ' + fechaFormateada);
                        if(confirmA){
                            const inputFechaFormato = document.getElementById('inputFormatoDate');
                           
                            let cadenaCorregida = fechaFormateada.substring(0, fechaFormateada.length - 1);
                            inputFechaFormato.value = cadenaCorregida;
                            console.log(inputFechaFormato);
                            $sendForm.submit();
                        }else{
                            //console.log('falso')
                        }
                    }else{
                        //si es true, entonces hay errorde fehcas inferiores a la actual
                        if(errorD){
                            let MostrarMensaje;
                            if(mensajeTime){
                                MostrarMensaje = 'Disculpanos!, no disponemos para esa fecha, por favor intenta con una superior';
                            }else{
                                MostrarMensaje = 'Elige una fecha superior a la actual';
                            }
                            var divDates = document.querySelector('.ul__date');
                            
                            {
                                var fragmentP = document.createDocumentFragment();
                                var p = document.createElement("p");
                                p.textContent = MostrarMensaje;
                                p.classList.add('p__date', 'poster__description--h1')
                                fragmentP.appendChild(p);
                                divDates.appendChild(fragmentP);
                                function erase(){
                                    const parent = document.querySelector(".ul__date");
                                    const child = document.querySelector(".p__date");
                                    const throwawayNode = parent.removeChild(child);
                                  }
                                  setTimeout(erase, 3000);
                            }
                        }else{
                            
                            if((document.querySelector('.p__date')) == null){
                                console.log('NO existe parrafo')
                                var element = document.getElementById("ul__date"); // assuming ul exists
                                var fragment = document.createDocumentFragment();
                                let numero = 1;
                                fecha.forEach(function (browser) {
                                    var li = document.createElement("li");
                                    li.textContent = browser;
                                    let claseD = 'date_' + numero;
                                    li.classList.add(claseD);
                                    numero += 1;
                                    fragment.appendChild(li);
                                });
                                var divDates = document.querySelector('.ul__date');
                                var fragmentP = document.createDocumentFragment();
                                var p = document.createElement("p");
                                p.textContent = 'Fecha No Disponible, toma las siguientes fechas: ';
                                p.classList.add('p__date', 'poster__description--h1')
                                fragmentP.appendChild(p);
                                divDates.appendChild(fragmentP);
                                element.appendChild(fragment);
                        }else{
                            console.log('existe parrafo')
                        }
                        }
                    }
				}else{
                    //console.log('error 200')
                }
			}
		}
	}
const $send = document.getElementById('sendDate');
$send.addEventListener('click', (e)=>{
    e.preventDefault();
    validar_mail(e);
})
const $formDate= document.getElementById('validatorDate');
$formDate.addEventListener('click', (e)=>{
    if((document.querySelector('.date_1') != null)){
        date_cita(e);
    }
})
}


