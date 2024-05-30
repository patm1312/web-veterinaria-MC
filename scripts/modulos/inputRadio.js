export default function radio(e){

    if(e.target.matches(".formJs")){

        const $input = e.target.lastElementChild;
        $input.checked = true;
    }

}