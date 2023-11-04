<?php
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");

    session_start();
    unset($_SESSION['autenticado']);
    unset($_SESSION['usuario']);
    session_destroy();

    header("Location: ../index.php");
    exit();
?>
