console.log('ejecutoalpine');
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