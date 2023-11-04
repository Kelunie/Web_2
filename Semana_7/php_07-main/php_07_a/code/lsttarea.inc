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
			// Process user data into $user variable
			$user = mysqli_fetch_array($regis);

			// Create structured data package
			$datos = array('nombre'=>$user['nombre'],
					       'apellidos'=>$user['apellidos'],
						   'tareas'=>array());

			// Get data task user from server and placed into sub structure.
			$auxSql = "select id, descripcion, registrada, estado from tareas where token = '".$request[0]."' order by id desc";
			$regis = mysqli_query($conex, $auxSql);

            if(!$regis) {
				// Display error information in json format
                deliver_response(500,"Internal Server Error",mysqli_error($conex));
			}else{
				$conta = 0;
				while($tarea = mysqli_fetch_array($regis)){
					$datos['tareas'][$conta++] = array('id'=>$tarea['id'],
							    				      'descripcion'=>$tarea['descripcion'],
													  'registrada'=>$tarea['registrada'],
                                                      'estado' => $tarea['estado']);
				}//end of fetching task data

				// Release memory from data query
                mysqli_free_result($regis);

                // Display tasks data in json format and http request proccess successfully
				deliver_response(200,"OK",$datos);
			}
		}
	}
?>





