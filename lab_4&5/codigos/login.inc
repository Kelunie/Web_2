<?php
    // Get data written in json format
	$data = file_get_contents("php://input");

    // Convert json data into data array
	$valores = json_decode($data,TRUE);

	// Get data user from server.
	$auxSql = "Select * from usuarios where correopersonal = '".$request[1].
	          "' and contraseña = md5('".$request[2]."')"; 

	// Prepare query over user table
	$regis = mysqli_query($conex, $auxSql);
	if(!$regis) {
		// Display error information in json format
		deliver_response(500,"Internal Server Error",mysqli_error($conex));
	}else{
		// Get data user from data package $resgis.
		$user = mysqli_fetch_array($regis);

		/// Prepare data package like associative array
		$usuario = array('ID'=>$user['ID'],
						 'contraseña'=>$user['contraseña'],
						 'nombre'=>$user['nombre'],
						 'apellidos'=>$user['apellidos'],
						 'fecha_nacimiento'=>$user['fecha_nacimiento'],
						 'correopersonal'=>$user['correopersonal'],
						 'tipo_usuario'=>$user['tipo_usuario']);

		// Release memory from data query
		mysqli_free_result($regis);

        //display user data in json format and http request proccess successfully
		deliver_response(200,"OK",$user);
	}
?>
