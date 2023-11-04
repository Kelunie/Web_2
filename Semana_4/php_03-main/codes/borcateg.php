<?php
    require_once('conexion.inc');

    $auxSql = sprintf("delete from categories where CategoryID = %s", $_GET['cod']);
    $Regis = mysqli_query($conex, $auxSql ) or die(mysqli_error());

    header("Location: ../categories.php");
?>
