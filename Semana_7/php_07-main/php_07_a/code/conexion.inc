<?php
    //parametros de conexion (opcionales)
	$servidor  = "127.0.0.1";
    $basedatos = "agenda";
    $usuario   = "root";
    $contra    = "parda99*";

    //suprime advertencias
    error_reporting(0);

	//proceso para conectar con el servidor
    if(!$conex = mysqli_connect($servidor, $usuario, $contra, $basedatos)){
        echo "<h3><font color='red'>Error: No se puede conectar al servidor de MySQL.</font></h3>" . "<hr>";
        echo "<strong>Número........:</strong> " . mysqli_connect_errno() . "<br>";
        echo "<strong>Descripción...:</strong> " . mysqli_connect_error() . "<br>";
        exit;
    }

    // Changes chart set connection
    mysqli_set_charset($conex,"utf8");

?>
