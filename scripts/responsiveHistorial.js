 export default function responsiveHistorial(){
    //funcion del  window, para la tabala de historial medico rsponsive
    let ancho = window.innerWidth;
    function responsive(ancho){
        //si el ancho es mejor o  igual a 730,
        const $divTableBig = document.querySelectorAll('.HmedicoB');
        const $divTableSmall= document.querySelectorAll('.HmedicoS');
        if(ancho <= 1000){
       
            $divTableBig.forEach(element => {
                element.classList.remove('blockH');
            });
            $divTableSmall.forEach(element => {
                element.classList.add('blockH');
            });
            //$divTableSmall.classList.add('blockH');
            //$divTableBig.classList.remove('blockH');
        }else{
          
            $divTableBig.forEach(element => {
               
                element.classList.add('blockH');
            });
            $divTableSmall.forEach(element => {
                element.classList.remove('blockH');
            });
            //$divTableSmall.classList.remove('blockH');
            //$divTableBig.classList.add('blockH');

            $divTableBig.forEach(element => {
                element.classList.add('noneH');
            });
            //$divTableBig.classList.add('noneH');
            $divTableSmall.forEach(element => {
                element.classList.remove('blockH');
            });
            //$divTableSmall.classList.remove('blockH');
          
        }
    }//ejecuto  la funcion con el parametro
    responsive(ancho);
    //la funcion se ejecuta tambien cuando se redimensiona el tamaño  del navegador: ver documentacion 1.
    window.addEventListener("resize", (e)=>{
        ancho = window.innerWidth;
        responsive(ancho)
    })
    
}