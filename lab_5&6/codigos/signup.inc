<?php
    // Get data written in json format
    $data = file_get_contents("php://input");

    // Convert json data into data array
    $valores = json_decode($data, TRUE);

    // Prepare SQL call for ins_usuario stored procedure
    $auxSql = "CALL ins_usuario('".$valores['ID']."','".$valores['nombre']."','".$valores['apellidos']."','".$valores['fecha_nacimiento']."','".$valores['correopersonal']."','".$valores['tipo_usuario']."','".$valores['clave']."')";

    // Execute the stored procedure
    $regis = mysqli_query($conex, $auxSql);
    if (!$regis) {
        // Display error information in json format
        deliver_response(500, "Internal Server Error", mysqli_error($conex));
    } else {
        // Get user data from the server
        $auxSql = "SELECT * FROM usuarios WHERE correopersonal = '".$valores['correopersonal']."'";
        $regis = mysqli_query($conex, $auxSql);
        $user = mysqli_fetch_array($regis);

        // Prepare data package as an associative array
        $usuario = array(
            'ID' => $user['ID'],
            'nombre' => $user['nombre'],
            'apellidos' => $user['apellidos'],
            'fecha_nacimiento' => $user['fecha_nacimiento'],
            'correopersonal' => $user['correopersonal'],
            'tipo_usuario' => $user['tipo_usuario'],
            'clave' => $valores['clave'], // Usar 'clave' en lugar de 'clave_o'
            'clave_h' => $user['contraseña'] // Usar 'contraseña' en lugar de 'clave_h'
        );

        // Release memory from data query
        mysqli_free_result($regis);

        // Display user data in json format and HTTP request process successfully deliver_response(201, "Data was created", $usuario);
        deliver_response(201, "Data was created", $usuario);
    }
?>
