<?php
    //parametros de conexion (opcionales)
	$servidor  = "10.236.2.140";
    $basedatos = "employees";
    $usuario   = "root";
    $contra    = "adm2K21$";
	
    //suprime advertencias
    //error_reporting(0);

	//proceso para conectar con el servidor 
    if(!$conex = mysqli_connect($servidor, $usuario, $contra, $basedatos)){
        echo "<h3><font color='red'>Error: No se puede conectar al servidor de MySQL.</font></h3>" . "<hr>";
        echo "<strong>Número........:</strong> " . mysqli_connect_errno() . "<br>";
        echo "<strong>Descripción...:</strong> " . mysqli_connect_error() . "<br>";
        exit;          
    }    
	mysqli_set_charset($conex,"utf8");
?>