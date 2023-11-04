//codigo_01.js

// Declaración de variables locales
// relacionadas con interface html
var btnGuardar = document.getElementById("btnGuardar");
var btnMostrar = document.getElementById("btnMostrar");

var txtNomb = document.getElementById("txtNomb");
var txtEmail = document.getElementById("txtEmail");

var resultados = document.getElementById("Datos");

//Programación de evento botón guardar
btnGuardar.addEventListener("click", function(){
	//Accede al almacen local y crea variable y asigna valor
	localStorage.setItem("nombre", txtNomb.value);
	localStorage.setItem("email", txtEmail.value);

	//limpia los campos
	txtNomb.value = "";
	txtEmail.value = "";

	//pasa el foco al texto del nombre
	txtNomb.focus();
});

//Programación de evento botón mostrar
btnMostrar.addEventListener("click", function(){
	//Accede al almacen local y recupera la variable
	var n = localStorage.getItem("nombre");
	var e = localStorage.getItem("email");

	//Envía los datos al div para presentarlos
	resultados.innerHTML = "<h3>Datos Recuperados</h3>" + n + "<br />" + e;
});
