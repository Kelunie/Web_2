<?php
	// Get data user from server.
	$auxSql = "Select nombre, apellidos from usuarios where token = '".$request[0]."'";
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

            // Prepare and execute SQL insert instruction on task table
			$auxSql = "call instarea('".$request[0]."','".$valores['tarea']."')";
            $regis = mysqli_query($conex, $auxSql);

			if(!$regis) {
				// Catch error informtation on insert instruction
                deliver_response(500,"Internal Server Error",mysqli_error($conex));
			}else{
				// Get new task data from server.
				$auxSql = "select id, descripcion, registrada, estado from tareas where token = '".$request[0]."' order by id desc limit 1";
				$regis = mysqli_query($conex, $auxSql);
				$tarea = mysqli_fetch_array($regis);

                // Prepare data package like associative array
				$datos= array('id'=>$tarea['id'],
						      'descripcion'=>$tarea['descripcion'],
							  'registrada'=>$tarea['registrada'],
                              'estado' => $tarea['estado']);

				// Release memory from data query
                mysqli_free_result($regis);

                // Display task data in json format and http request proccess successfully
				deliver_response(200,"OK",$datos);
			}
		}
	}
?>
