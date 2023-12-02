<?php
// Sample data
$info = [
    "estudiante" => [
        "apellidos" => "Rodriguez Cordero",
        "celular" => 89477290,
        "email" => "caleb.cordero1997@gmail.com",
        "id" => 604420243,
        "nivel" => "Estudiante",
        "nombre" => "Caleb"
    ]
];

//display user data in json format and http request proccess successfully
deliver_response(200,"OK",$info);