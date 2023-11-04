<?php
	// Get data user from server.
	$auxSql = "Select nombre, apellidos, email from usuarios where token = '".$request[0]."'";
	$regis = mysqli_query($conex, $auxSql);
	
    if(!$regis) {
        // Display error information in json format
		deliver_response(500,"Internal Server Error",mysqli_error($conex));
	}else{
		// Get data user from data package $resgis.
		$user = mysqli_fetch_array($regis);  
		   
		// Prepare data package like associative array
		$usuario = array('nombre'=>$user['nombre'],
						 'apellidos'=>$user['apellidos'],
						 'email'=>$user['email']);
		
		// Release memory from data query
		mysqli_free_result($regis);
		
        //display user data in json format and http request proccess successfully
		deliver_response(200,"OK",$usuario);
	}
?>