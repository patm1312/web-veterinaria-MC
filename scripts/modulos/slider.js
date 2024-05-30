export default function slider(){
    // guardo en variables el boton de sigiuente , de atras y  de todas las slides individuales accede a el nombre de la calse hija desde la clase padre:
    const $nextbtn = document.querySelector(".next "),
    $prevbtns = document.querySelector(".previos"),
    //$slides es uin nodelist
    $slides = document.querySelectorAll(".slider-slide");
     $slides.forEach(element => {
        console.log(element);
    });
    //creo una variable que sirve para regresarme a la primera imagen cuando termine el slider y viceversa
    let i = 0;
    $slides[i].classList.add("active")
    setInterval(() => {
            $slides[i].classList.remove("active")
            i++;
            $slides.forEach(element => {
        console.log(element);
    });
            //i valdria -1, es decir que se valla a mostrar la ultima imagen por esllo pongo el condicional para que muestre la ultima imagen asi:
            if(i>=$slides.length){
                i=0;
            }
            $slides[i].classList.add("active")
    }, 5000);
    // el slider funciona al clikc no  es automatico:

    document.addEventListener("click", (e)=>{
        //si el objeto que oriigino el event es el boton de previos
        if(e.target===$prevbtns){
            e.preventDefault();
            // al primer imagen le quieto la  clase active para que se oculte
            $slides[i].classList.remove("active")
            i--;
            //i valdria -1, es decir que se valla a mostrar la ultima imagen por esllo pongo el condicional para que muestre la ultima imagen asi:
            if(i<0){
                i=$slides.length-1;
            }
            $slides[i].classList.add("active")
        }
        if(e.target===$nextbtn){
            e.preventDefault();
            // al primer imagen le quieto la  clase active para que se oculte
            $slides[i].classList.remove("active")
            i++;
            //i valdria -1, es decir que se valla a mostrar la ultima imagen por esllo pongo el condicional para que muestre la ultima imagen asi:
            if(i>=$slides.length){
                i=0;
            }
            $slides[i].classList.add("active")
        }
    })

}