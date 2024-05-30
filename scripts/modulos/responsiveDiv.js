const d = document;
console.log("resice square");
// Capturamos todos los elementos que tengan la clase
const responsiveDiv = document.querySelectorAll('.responsiveDiv');
export default function resizeForSquareAppearance(){
    console.log("res");
    responsiveDiv.forEach((element) => {
        console.log(element);
        console.log('medidas')
        console.log(element.style.height);
        console.log(element.clientWidth);
        
        // Modifica la altura a partir de la anchura del elemento
        element.style.height = `${element.clientWidth}px`;
        console.log(element.style.height);
        console.log(element.clientWidth);

    })
}