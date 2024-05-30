export default function sendF(){
    const $form_filter_prod = document.querySelector('.filtro_productos');
    const $select = document.querySelector('.select_filter');
    $select.addEventListener('change' ,(e)=>{
         $form_filter_prod.submit();
    })
   
} 