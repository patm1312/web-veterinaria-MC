import modal from "./modulos/modal.js";
import Dig_form from "./modulos/validarFormDig.js";
import contact_form from "./modulos/validarFormulario.js";
import responsiveMenu from "./modulos/hm.js";
import responsiveHistorial from "./responsiveHistorial.js";
 import modalAcciones from "./modulos/modalPerfil.js";
import slider from "./modulos/slider.js";
import smallAdd from "./modulos/sliderAdd.js";
import sliderAdd from "./modulos/sliderAdd.js";
import perfilResponsive from "./modulos/perfil.js";
import resizeForSquareAppearance from "./modulos/responsiveDiv.js";
import filter from "./modulos/filtro.js";
import usuariosAdmin from "./modulos/usuariosAdmin.js";
import adminPublic from "./modulos/adminPublic.js";
import openWindowImg from "./modulos/windowOPen.js";
import form_calendario from "./modulos/calendario.js";
import { Validar_file } from "./modulos/validar__file.js";
import sendF from "./modulos/send_form.js";
import search from "./modulos/habilitar_search.js";
import scroll from "./modulos/scoll.js";
import radio from "./modulos/inputRadio.js";
import validarFecha from "./modulos/fechas.js";
search();
const d = document;
//en la variable seccion guardo el resultado de ver si estoy  ejecutando  el modulo de adopta mascota, si es true  es porque encuentra el input hiodden que esta en la pgina de adopta.php, y ejecuto la funcion modal.

if (d.getElementById("adopta_mascota") != null){
        //funcion que se ejecuta para la ventana modal del filtro de adopta mascotas, solo  si estoy  en el modulo de adoptar mascota
        //parametro 1 es el boton de filtrar, el parametro 2, es el  boton de enviar solicitud, el cerrar es la x de cerrar formulario 
        console.log("se eejcuta modal")
        modal(".modalOpen", ".modalClose", ".cerrar");
    }
    
if (d.getElementById("home") != null){
    slider()
    sliderAdd()
    resizeForSquareAppearance();
}
// Evento cuando se redimensiona la ventana
window.addEventListener("resize",(e)=>{
    if (d.getElementById("producto") != null){
        console.log('ejecuta la funcion');
        console.log(d.getElementById("producto"));
        resizeForSquareAppearance();
    }else{
        console.log('No');
    }
})
// Evento cuando se carga el contenido
d.addEventListener("DOMContentLoaded",(e)=>{
    scroll(".scrol");
    //si edtoy en en el admin, pagina de muestra de contenido d eususario, con el fin de cargar las tablas d emanera responsive, tablade historial medico:id="Hmedico"
    if (d.getElementById("Hmedico") != null){
        console.log('estoy  en historial medico')
       responsiveHistorial();
    }

    if (d.getElementById("producto") != null){
        console.log(d.getElementById("producto"))
        resizeForSquareAppearance();
    }else{
        console.log('no');
    }
})
if (d.getElementById("hiddenPerfil") != null){
    d.addEventListener("scroll",(e)=>{
        perfilResponsive();
    })
}
if (d.querySelector(".contact-form") != null){
    contact_form()
}
//se eejcuta la funcion de validar formulario, el de escribir  codigo enviado, solo si es diferente a null:
if (d.querySelector(".formdig") != null){
    Dig_form();
}
function mostrarContrasena(){
      var tipo = d.querySelector(".show_password");
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }
  }
d.addEventListener("click", (e)=>{
    //si le da click a boton de visualizar contrasña
     if(d.querySelector(".show_password") != null){
         if(e.target.matches('.img_show')){
                      console.log('mostrar');
         mostrarContrasena();
         }

     }
    //paera la opcion cuando el usuario le aparecen mascotas registradas para añadirle citas, se seecciona el input con un color diferente
    if(d.querySelector(".preview_paci--box") != null){
        const $labels = d.querySelectorAll('.preview_paci--input');
        $labels.forEach(element => {
            if(element.checked){
                let $id = 'label__' + element.getAttribute('id');
    
                const $label_id = d.getElementById($id);
                $label_id.classList.add('preview_paciBox--color')
      
            }else{
                let $id = 'label__' + element.getAttribute('id');

                const $label_id = d.getElementById($id);
                $label_id.classList.remove('preview_paciBox--color')
    
            }
        });
        // console.log($label);
        // const $label_id = d.getElementById($label);
        // $label_id.classList.toggle('preview_paciBox--color');
    }
    if(d.querySelector(".form_radio") != null){
        radio(e);
    }
         if(e.target.matches('.accion_perfil')){
            console.log('modal accions');
            modalAcciones(e)
        }else{
            //si se da click en algun parte del documento se ejecuta esta funcion que sirve para el menu hm y  el menu grande 
            responsiveMenu(e);
        }
        if (d.getElementById("adopta_mascota") != null){
            //esta funcios se activa solo en el modulo  de adopta mascota para la interaccion con el filtro
            filter(e);
        }
        if (d.getElementById("homeAdmin") != null){
            //esta funcios se activa solo en el modulo  de adopta mascota para la interaccion con el filtro
            usuariosAdmin(e);
            //funcion que abre una imagen en nueva pestaña al hacer click en un icono, en la pagina de admin publicaciones
            openWindowImg(e);
        }
                    //para que abrir imagen se ejecute en mostrar documentos o imagenes desde el usuario:
    if (d.getElementById("abrir_imagen") != null){
        //funcion que abre una imagen en nueva pestaña al hacer click en un icono, en la pagina de admin publicaciones
        openWindowImg(e);
    }
        
        if (d.getElementById("AdminPublic") != null){
            //esta funcios se activa solo en el modulo  de adopta mascota para la interaccion con el filtro
            adminPublic(e);
        }
        if (d.getElementById("input_file") != null){
            //esta funcios se activa solo para validar las imagenes o archivos que envia el usuario
            if(e.target.matches('.input_file--img')){
                // const validarArchivoDimension = new Validar_file();
                // validarArchivoDimension.validar_dimension(e);
            }
        }
    })
    if (d.getElementById("input_file") != null){
        //esta funcios se activa solo para validar las imagenes o archivos que envia el usuario
        const validarArchivo = new Validar_file();
        validarArchivo.validar_tamanio();
    }
    if (d.getElementById("calendario") != null){
        //este escript sirve para  activar o desactivar botn de envio cuando el usuario hace un cambio en los chechbox de pland e vacnacion o desparacitacion
        form_calendario();
    }
// SOLO  SE ACTIVA LA FUNCION SI LA PAGINA DE PRODUCTOS ESTA ACTIVA:
    if(d.getElementById("input_send_form") != null){
        sendF();
    }
    console.log('s eejcuta los scripts');

    function data(){
        console.log('?se ejecuta alpnie');
        return{
            open: null,
            start(){
                this.open = false;
            },
            isOpen(){
                this.open = !this.open
            },
            close(){
                this.open = false
            }
        }
    }
    //si estoy  en la apgina de home de adopta, debo deshabilitar los filtros en caso de que no haya ningun registro o mascota en adiopcion 
    if(d.getElementById("filtroHidden") != null){
       function  filtroHidden(){
            console.log('filtro hidden');
            if(d.getElementById("habilitarFiltro") != null){
                console.log('NO hay resultado');
                const $filter = d.querySelectorAll('.hiddenFilter');
                console.log($filter);
                $filter.forEach(element => {
                    element.classList.add('noneH');
                });
            }else{
                console.log('hay resultado')
            }
        }
        filtroHidden();
    }
    if(d.getElementById("validatorDate") != null){
        validarFecha();
    }