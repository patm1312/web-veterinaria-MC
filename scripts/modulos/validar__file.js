const d = document;

export class Validar_file {
    constructor(input, slider, defaultC, span, submit){
      //input file para subir archivo de imagen cuadrada
        this.inputD =  document.getElementById('archivoDefault');
        //input file para subir archivo de imagen rectangular para slider
        this.inputS =  document.getElementById('archivoSlider');
        //boton que se habilita si no cumple con el tamaño o formato(slider debe ser rectangular, , default que es para publicar en servicios debeser como minimo cuadrada)
        this.submit =  document.getElementById('submit');
    }
    // Método
    validar_tamanio() {
      let inputS = this.inputS;
      let inputD = this.inputD;
      let submit = this.submit;
      //agrego dos escuchadores de evento para cada input file
      inputS.addEventListener('change', validarTamanioE);
      inputD.addEventListener('change', validarTamanioE);
      function validarTamanioE(e){
        //capturo  los spans que tienen los mensajes de error en caso q no cumplan con el formato
        const spans = d.querySelectorAll('.messaje_form');

         var file = e.target.files[0];
         //spanF es el span que corresponde a cada input file, el mismo  que se genero el evento
         let spanF = e.target
         let SpanF = spanF.nextElementSibling
         //si el input file tiene un archivo 
         if (file) {
           // Tamaño máximo permitido en bytes (por ejemplo, 1 MB)
           var maxSize = 1024 * 1024; // 1 MB
           //evalua si el tmanño de ese archivo supera al permitido
           if (file.size > maxSize) {
            //deshabilito el boton y  muestro el mensaje de error en el input q corresponde
             submit.disabled = true;
             SpanF.classList.add('messaje_span');
             SpanF.innerHTML = "la imagen debe tener 1Mb como maximo";
             file.value = '';
           } else {
            //si cumple con el tamaño de imagen
             SpanF.classList.remove('messaje_span');
             //solo se deshabilita el boton si todos los span no tienen  mensaje de error
             if((spans[0].innerText == '') && (spans[1].innerText == '')){
              submit.disabled = false;
            }
            //esta funcion evalua los requisitos de dimension dela imagen segun el archivo que se sube:
             function validar_dimensionI(a,b,c,messaje){
                  var image = new Image();
                  image.src = URL.createObjectURL(file);
                  image.onload = function() {
                      var maxWidth = 8; // Cambia esto según tus requisitos
                      var maxHeight = 6; // Cambia esto según tus requisitos
                      let alto = (image.height / image.width ) * a

                      // si el  alto de la imagen fue subido por el boton de default, debe cumplir que el alto este entre 70 y 120 (ver operacion, si se acerca a 100 es cuadrada, si es menos de 70  es rectangular.) y que ademas, como  es subido por l boton de default solo es verdadero cuando cumpla las condiciones del primer if ocndicional, porque si lo sube por  el boton de slider puede que sea cuadrada pero no debe cumplir como verdadero para ese boton. por eso pongo false y true enviados como parametros dependiendo de que boton se esta evaluando
                      if((alto > 70) && (alto <= 120) && (b == false) && (c == true)){
                        //si es verdaero solo me queda deshabilitar ell boton de enviar sol cuando no halla texto en alguna de los span de error
                          SpanF.innerHTML = '';
                          if((spans[0].innerText == '') && (spans[1].innerText == '')){
                                submit.disabled = false;
                          }
                      }else if((alto < 70) && (b == true) && (c == false)){
                        SpanF.innerHTML = '';
                            if((spans[0].innerText == '') && (spans[1].innerText == '')){
                              submit.disabled = false;
                            }
                      //si es FontFaceSetLoadEvent, habilito el mensaje y deshabilito el boton de enviar
                      }else{
                          submit.disabled = true;
                          SpanF.classList.add('messaje_span');
                          SpanF.innerHTML = messaje;
                      }
                  }
             };
             //si el id del input que genero el evento es del slider, evaluo con la funcion validar_dimension que sea un rectangulo; peara ello le paso los parametros: 100 que mulstiplica  el resultado  del dividir el alto por ancho de la imagen. 
             // si lo envio con el boton de slider solo es verdadero que b es true y c es false.
              if(e.target.id == 'archivoSlider'){
                  let messaje = 'la imagen debe ser rectangular como mminimo';
                  validar_dimensionI(100, true, false, messaje)
              }else if(e.target.id == 'archivoDefault'){
                  console.log('trabajo con default');
                  let messaje = 'la imagen debe ser cuadrada como mminimo';
                  validar_dimensionI(100, false, true,messaje)
              }     
          }
        } 
     }
    }
}

