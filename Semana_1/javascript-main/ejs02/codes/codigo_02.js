// Declaración de variables locales
// relacionadas con interface html
var btnGuardar = document.getElementById("btnGuardar");
var btnMostrar = document.getElementById("btnMostrar");
var txtNomb = document.getElementById("txtNomb");
var txtEmail = document.getElementById("txtEmail");
var resultados = document.getElementById("Datos");

//Programación de evento botón guardar
btnGuardar.addEventListener("click",function(){
	//define vector con los pares a ser almacenados
	var usuario={
		"nombre":txtNomb.value,
		"email":txtEmail.value
	};

	//convierte el vector de pares a un JSON
	usuario = JSON.stringify(usuario);
	localStorage.setItem("usuario",usuario);

	//limpia los campos
	txtNomb.value = "";
	txtEmail.value = "";

	//pasa el foco al texto del nombre
	txtNomb.focus();
});

//Programación de evento botón mostrar
btnMostrar.addEventListener("click",function(){
	//recupera el vector de pares como un JSON
	var u = localStorage.getItem("usuario");

	//convierte el JSON en vector de pares
	u= JSON.parse(u);

	//Envía los datos al div para presentarlos
	resultados.innerHTML = "<h3>Datos Recuperados</h3>" + u.nombre + "<br />" + u.email;
});
