<?php
    session_start();
    $num = $_SESSION["numbers"];
    // obtendremos solo los valores del array omitiendo las etiquetas
    $nb = array_values($num);
    // sacamos el mayor, el menor, el promedio y la suma
    $mayor = max($nb);
    $menor = min($nb);
    $promedio = array_sum($nb) / count($nb);
    $suma = array_sum($nb);
    
    // Construir el array de datos utilizando foreach
    $datos = [];
    foreach ($num as $key => $value) {
        $datos[$key] = $value;
    }
    
    $info = [
        "resultado" => [
            "datos" => $datos,
            "estadistica" => [
                "mayor" => $mayor,
                "menor" => $menor,
                "nValores" => count($num),
                "promedio" => $promedio,
                "suma" => $suma,
            ],
        ],
    ];
    
    // Mostrar los datos en formato JSON y responder con éxito a la solicitud HTTP
    deliver_response(200, "OK", $info);
?>