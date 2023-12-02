<?php
    session_start();
    $num = $_SESSION["numbers"];
    $X = $_SESSION["val"];
    // obtendremos solo los valores del array omitiendo las etiquetas
    $nb = array_values($num);
    // sacamos el cuadrado de cada uno de los datos
    
    // Construir el array de datos utilizando foreach
    $datos = [];
    foreach ($num as $key => $value) {
        $datos[$key] = $value;
    }
    // sacamos los valores elevados
    $datoselevados = [];
    foreach ($datos as $key => $value) {
        $datoselevados[$key] = pow($value,$X);
    }
    
    $info = [
        "resultado" => [
            "d_elevados" => $datoselevados,
            "d_original" => $datos
        ]
    ];
    
    // Mostrar los datos en formato JSON y responder con éxito a la solicitud HTTP
    deliver_response(200, "OK", $info);
?>