function limpiarTodo(){
    localStorage.clear();
}

function eliminarItem(){
    if(localStorage){
        localStorage.removeItem("?");
    }
}
