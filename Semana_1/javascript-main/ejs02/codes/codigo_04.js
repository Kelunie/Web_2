// Declaración de variables locales
// relacionadas con interface html
var btnGuardar = document.getElementById("btnGuardar");
var btnMostrar = document.getElementById("btnMostrar");
var txtNomb = document.getElementById("txtNomb");
var txtEmail = document.getElementById("txtEmail");
var resultados = document.getElementById("Datos");

//Variables para trabajar con indexedDB
var indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB;
var db = null;

function createDB(){
    //Parámetros del método
    //1. Nombre de la base de datos.
    //2. Versión de la base de datos.
    db = indexedDB.open('demoIDB','1');

    db.onupgradeneeded = function(e){
        var activa = db.result;

        //crea el contenedor de datos
        var tabla = activa.createObjectStore
        ("datos",{keyPath : 'id', autoIncrement : true});

        //crea los indices de busqueda basado en los campos del contenedor
        tabla.createIndex('x_nombre','nombre',{unique : false});
        tabla.createIndex('x_email','email',{unique : true});
    }

    db.onsuccess = function(e){
        alert("Base de datos cargada correctamente");
    }

    db.onerror = function(e){
        alert("Error cargando la base de datos");
    }

}// fin de la funcion de creación de la base de datos

//Programación de evento botón guardar
btnGuardar.addEventListener("click",function(){
    var activa = db.result;
    var tabla = activa.transaction(["datos"], "readwrite");
    var tupla = tabla.objectStore("datos");

    var regis = tupla.put({
        nombre:txtNomb.value,
        email:txtEmail.value
    });

    regis.onerror = function(e){
        alert(regis.error.name + '\n\n' + regis.error.message);
    }

    tabla.oncomplete = function(e){
        alert("Registro agregado satisfactoriamente");

        //limpia los campos
    	txtNomb.value = "";
    	txtEmail.value = "";

    	//pasa el foco al texto del nombre
    	txtNomb.focus();
    }
});

//Programación de evento botón mostrar
btnMostrar.addEventListener("click",function(){
    var activa = db.result;
    var tabla = activa.transaction(["datos"], "readonly");
    var tupla = tabla.objectStore("datos");

    var datos = [];

    tupla.openCursor().onsuccess = function(e){
        var regis = e.target.result;
        if(regis == null){
            return;
        }

        datos.push(regis.value);
        regis.continue();
    }

    tabla.oncomplete = function(e){
        //declara variable para impresión de lista
    	var salida = "<h3>Datos Recuperados</h3>";

    	//recorre el vector de datos
    	for(var i = 0; i < datos.length; i++){
    		salida = salida.concat(datos[i].id + "<br />" +
                                   datos[i].nombre + "<br />" +
    		                       datos[i].email + "<br />---------------------<br />");
    	}

        datos = [];
    	resultados.innerHTML = salida;
    }
});

/*
//Programación de evento botón mostrar ordenando por nombre
btnMostrar.addEventListener("click",function(){
     var activa = db.result;
     var tabla = activa.transaction(["datos"], "readonly");
     var tupla = tabla.objectStore("datos");
     var index = tupla.index("x_nombre");

     var datos = [];

     index.openCursor().onsuccess = function(e){
         var regis = e.target.result;
         if(regis == null){
             return;
         }

         datos.push(regis.value);
         regis.continue();
     }

     tabla.oncomplete = function(e){
         //declara variable para impresión de lista
     	var salida = "<h3>Datos Recuperados</h3>";

     	//recorre el vector de datos
     	for(var i = 0; i < datos.length; i++){
     		salida = salida.concat(datos[i].id + "<br />" +
                                    datos[i].nombre + "<br />" +
     		                       datos[i].email + "<br />---------------------<br />");
     	}

         datos = [];
     	resultados.innerHTML = salida;
     }
 });

//Programación de evento botón mostrar recuperando por un id
btnMostrar.addEventListener("click",function(){
     var activa = db.result;
     var tabla = activa.transaction(["datos"], "readonly");
     var tupla = tabla.objectStore("datos");

     var regis = tupla.get(1);

     regis.onsuccess=function(){
         if(regis != undefined){
             var datos = regis.result;

             //declara variable para impresión de lista
         	var salida = "<h3>Datos Recuperados</h3>";
             salida = salida.concat(datos.id + "<br />" +
                                    datos.nombre + "<br />" +
                                    datos.email + "<br />---------------------<br />");
             resultados.innerHTML = salida;
         }
     }
});

function borrar(id){
    var activa = db.result;
    var tabla = activa.transaction(["datos"], "readwrite");
    var tupla = tabla.objectStore("datos");

    var elim = tupla.delete(parseInt(id));

    elim.onsuccess = function(e){
        alert("Registro eliminado satisfactoriamente");
    }
}*/
