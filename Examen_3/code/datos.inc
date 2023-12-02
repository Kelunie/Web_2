<?php
    session_start();
    // Get data written in json format
    $data = file_get_contents("php://input");

    // Convert json data into data array
    $valores = json_decode($data, TRUE);

    // save the data in a variable and count how many items are in the array
    $numbers = $valores;
    $_SESSION["numbers"] = $numbers;
    $info = [
        "resultado" => [
            "datos" => [
                "nValores" => count($numbers),
            ]
        ]
    ];

    // Display user data in json format and HTTP request process successfully deliver_response(201, "Data was created", $usuario);
    deliver_response(201, "Data was created", $info);

    // guardamos $GLOBALS["numbers"] para usarlo en otro archivo
    
?>
