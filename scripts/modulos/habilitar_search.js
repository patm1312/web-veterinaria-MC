export default function search(){
    // script que sirve para deshabilitrar buscador search de la lupa, solo el usuarios puede  filtrar la informcion en ciertas paginas, cuando este en ciertas paginas deshabilito  concss: .search_lupa{
    // pointer-events: none; 
    // cursor: default;
    //search es el id unico que hay en lapagina
    const $element = document.getElementById('search');
    console.log('script habilitar search');
    //obtengo el enlace de la luopa 
    const $lupa = document.querySelectorAll('.lupa_buscador');
    console.log($lupa);
    //si encuentro el identificador unico que este en ciertas paginas en donde si quiero que el usuario filtre la informacion: dejo la lupa, de lo  contrario, deshabilito el enlace de lalupa con css:
    if(document.getElementById('search') != null ){
        console.log('el elemento search esta en lapagina ');
        $lupa.forEach(element => {
            element.classList.remove("search_lupa");
        });
        
    }else{
        console.log('el elemento search no esta en lapagina ');
        $lupa.forEach(element => {
            element.classList.add("search_lupa");
        });
    }
} 