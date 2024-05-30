const d = document;

export default function perfilResponsive(){
    //ubico los bloques donde esta el hedader de la prtada
    const portada = d.querySelector(".portada");
    const previewImg = d.querySelector(".previewperfil");
    const preview = d.querySelector(".preview_portada");
    const previewInfo = d.querySelector(".previewperfil--info");
    const datos = d.querySelector(".datos")
    const headerReact = datos.getBoundingClientRect()
    //es el miniheadr que dice mi informacion, si esta el  scroll menos de 190 px, entonces reduzo la imagen y el la portada
    const headerReactY = datos.getBoundingClientRect().y
    if(headerReactY < 190){
        previewImg.classList.add("previewperfilResposive");
        preview.classList.add("preview_portadaResponsive");
        previewInfo.classList.add("previewperfil--infoResponsive");
        portada.classList.add("portadaRes");
    }else{
        previewImg.classList.remove("previewperfilResposive");
        preview.classList.remove("preview_portadaResponsive");
        previewInfo.classList.remove("previewperfil--infoResponsive");
        portada.classList.remove("portadaRes");
    }
}