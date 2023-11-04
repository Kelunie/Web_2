<?php
	// Get data user from server.
	$auxSql = "select nombre, apellidos from usuarios where token = '".$request[0]."'";
	$regis = mysqli_query($conex, $auxSql);

	if(!$regis) {
		// Display error information in json format
		deliver_response(500,"Internal Server Error",mysqli_error($conex));
	}else{
        // Validate if user exist
		if(mysqli_num_rows($regis)==0){
            // Display error information about unregistered user
			deliver_response(401,"Unauthorized","Wrong user data.");
		}else{
			// Get data written in json format
            $data = file_get_contents("php://input");

            // Convert json data into data array
            $valores = json_decode($data,TRUE);

            // Prepare and execute SQL delete instruction on task table
			$auxSql = "call bortarea('".$request[0]."',".$valores['id'].")";
			$regis = mysqli_query($conex, $auxSql);

			if(!$regis) {
                // Display error information in json format
                deliver_response(500,"Internal Server Error",mysqli_error($conex));
            }else{
				// Display task data in json format and http request proccess successfully
				deliver_response(200,"OK","Registry successfully deleted.");
			}
		}
	}
?>
