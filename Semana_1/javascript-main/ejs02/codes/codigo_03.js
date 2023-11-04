// Declaración de variables locales
// relacionadas con interface html
var btnGuardar = document.getElementById("btnGuardar");
var btnMostrar = document.getElementById("btnMostrar");
var txtNomb = document.getElementById("txtNomb");
var txtEmail = document.getElementById("txtEmail");
var resultados = document.getElementById("Datos");

//Declara lista de datos
var lista = [];
var posi = 0;

//Programación de evento botón guardar
btnGuardar.addEventListener("click",function(){
	//lista.push(txtActividad.value);
	var lst = JSON.parse(localStorage.getItem("lista"));

	//define vector con los pares a ser almacenados
	var usuario={
		"nombre":txtNomb.value,
		"email":txtEmail.value
	};

	//valida que exista lista previa para buscar posición
	if(lst != null){
		posi = lst.length;
	}else {
		posi = 0;
	}

	//graba en la última posición el nuevo registro
	lista[posi] = usuario;
	localStorage.setItem("lista",JSON.stringify(lista));

	//limpia los campos
	txtNomb.value = "";
	txtEmail.value = "";

	//pasa el foco al texto del nombre
	txtNomb.focus();
});

//Programación de evento botón mostrar
btnMostrar.addEventListener("click",function(){
	//recupera la lista de pares JSON - Vector
	var lst = JSON.parse(localStorage.getItem("lista"));

    //declara variable para impresión de lista
	var salida = "<h3>Datos Recuperados</h3>";

	//recorre el vector de datos
	for(var i = 0; i < lst.length; i++){
		salida = salida.concat(lst[i].nombre + "<br />" +
		                       lst[i].email + "<br />---------------------<br />");
	}

	resultados.innerHTML = salida;
});

function limpiarTodo(){
    localStorage.clear();
}

function eliminarItem(){
    if(localStorage){
        localStorage.removeItem("lista");
    }
}
