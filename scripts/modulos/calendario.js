// script q se ejecuta en las tablas de calendario de plan de vacunacion y desparaci
const d = document;
export default function form_calendario(){
    const checkboxes = d.querySelectorAll('.calendarioVD');
    console.log('calendario');
    checkboxes.forEach(element => {
        element.addEventListener('change',(e)=>{
            let  $clases = element.classList;
            let $clase_check = $clases[1];
            let input_submit;
            if($clase_check.includes('vacunacion')){
                input_submit = '.input_';
                input_submit += $clase_check;
                console.log('la clase del submit fue : '+ input_submit);
            }else if($clase_check.includes('desparacitacion')){
                input_submit = '.input_';
                input_submit += $clase_check;
                console.log('la clase del submit fue : '+ input_submit);
            }
            console.log('la clase de input es  ' + input_submit)
            console.log($clases);
            console.log('el elemento es');
            console.log(element);
            const inputA = d.querySelector(input_submit)
            console.log(inputA)
            inputA.classList.add('block__filter');
        })
    });

}