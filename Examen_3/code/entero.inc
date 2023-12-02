<?php
    // sacamos el valor que es enviado por medio de session
    $X = $_SESSION["val"];
    // info que usaremos por defecto
    $bits = 8;
    $byte = $X;
    $n_bits= $bits * $byte;
    $base = 2;
    // sacamos el peso al elevar a la potencia la $base por $n_bits
    $peso = pow($base,$n_bits);
    // sacamos el valor con signo
    $c_signo = $peso / 2;
    $c_signo_negativo = $c_signo * -1;
    $c_signo_positivo = $c_signo - 1;
    $s_signo = $peso - 1;
    
    $info = [
        "resultado" => [
            "con_signo" => $c_signo_negativo." hasta ".$c_signo_positivo,
            "sin_signo" => "0 hasta ".$s_signo,
            "n_bits" => $n_bits
        ]
    ];
    
    // Mostrar los datos en formato JSON y responder con éxito a la solicitud HTTP
    deliver_response(200, "OK", $info);
?>