/*jshint sub:true*/
// Declaración de variables locales
// relacionadas con interface html
var btnGuardar = document.getElementById("btnGuardar");
var btnMostrar = document.getElementById("btnMostrar");
var txtNomb = document.getElementById("txtNomb");
var txtEmail = document.getElementById("txtEmail");
var txtContra = document.getElementById("txtContra");
var resultados = document.getElementById("Datos");

var salida = "";
//Declara las variables para conectarse con servidor remoto
//que contiene el web service
//--------------------------------------------------------------
var remoto = new XMLHttpRequest();
var url = "http://demoyork.com:5000";

//Programación de evento botón guardar
btnGuardar.addEventListener("click",function(){
    //Determina la funcion HTTPRequest entre sitio local y el remoto
    remoto.open("POST",url+"/signup",true);

    //Determina la forma de intercambio de datos entre el sitio local
    //el sitio remoto para la pagina actual
    remoto.setRequestHeader('Accept', 'application/json');
    remoto.setRequestHeader("Content-Type","application/json");

    remoto.onreadystatechange = function (){
        if(remoto.readyState==4){
            if(remoto.status == 201){
                salida =  "<br /><br />";
                var resul = JSON.parse(remoto.responseText);

                salida = salida.concat('status code: '    + resul.status_code    + '<br />');
                salida = salida.concat('status message: ' + resul.status_message + '<br />');

                salida = salida.concat('Datos Registrados<br />------------------------<br />');

                var data = resul.data["user"];

                salida = salida.concat('Token: '  + data["token"]  + '<br />');
                salida = salida.concat('Nombre: ' + data["name"]   + '<br />');
                salida = salida.concat('eMail: '  + data["email"]  + '<br />');
                salida = salida.concat('Clave: '  + data["passwd"] + '<br />');

                document.getElementById("Datos").innerHTML = salida;
            }else{
                document.getElementById("Datos").innerHTML = (remoto.responseText);
            } //fin del if de status
        }//fin del if readyState
    }//fin de la funcion interna

    var datos = JSON.stringify({"name":txtNomb.value,
                                "email":txtEmail.value,
                                "passwd":txtContra.value});
    remoto.send(datos);
});
