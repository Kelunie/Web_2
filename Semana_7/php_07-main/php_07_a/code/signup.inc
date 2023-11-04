<?php
    // Get data written in json format
	$data = file_get_contents("php://input");

    // Convert json data into data array
	$valores = json_decode($data,TRUE);

    // Prepare SQL insert instruction
	$auxSql = "call insusuario('".$valores['nombre']."','".$valores['apellidos']."','".$valores['email']."','".$valores['contra']."')";

	// Execute query over user table
	$regis = mysqli_query($conex, $auxSql);
	if(!$regis) {
        // Display error information in json format
		deliver_response(500,"Internal Server Error",mysqli_error($conex));
	}else{
		// Get data user from server.
		$auxSql = "Select * from usuarios where email = '".$valores['email']."'";
		$regis = mysqli_query($conex, $auxSql);
		$user = mysqli_fetch_array($regis);

		// Prepare data package like associative array
		$usuario = array('token'=>$user['token'],
						 'nombre'=>$user['nombre'],
						 'apellidos'=>$user['apellidos'],
						 'email'=>$user['email'],
						 'clave_o'=>$valores['contra'],
						 'clave_h'=>$user['contra']);

		// Release memory from data query again
		mysqli_free_result($regis);

        //display user data in json format and http request proccess successfully
		deliver_response(201,"Datas was created",$usuario);
	}
?>
