<?php
    //Crea el comjunto de datos que seran presentados en la grafica
    $politico = array("Agrupación Política","PLN","PAC","PUSC","PML");
    $mes1 = array("Septiembre",45,25,18,12);
    $mes2 = array("Octubre",41,28,24,7);
    $mes3 = array("Noviembre",37,34,26,5);
    $mes4 = array("Diciembre",30,30,36,4);

    echo json_encode(array($politico,$mes1,$mes2,$mes3,$mes4));
?>