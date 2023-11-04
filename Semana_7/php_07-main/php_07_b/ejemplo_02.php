<?php
//error_reporting(0);
if(isset($_POST['ocAceptar'])){
    //insertando usuario
    $datos = array('nombre'    => $_POST['txtNom'],
                   'apellidos' => $_POST['txtApes'],
                   'email'     => $_POST['txtEma'],
                   'contra'    => $_POST['txtContra']);

    $url = 'http://localhost/2023/php_07/php_07_a/index.php/signup';

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($datos));
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept:application/json','Content-Type:application/json']);

    $result = curl_exec($curl);
    $valores = json_decode($result,true);

    echo '<h3>Resultado de la transacción</h3>';

    echo '<strong>Status:</strong> '.        $valores['status'].   "<br>";
    echo '<strong>Status Message:</strong> '.$valores['status_message']."<br>";

    echo '<strong>Token:</strong> '.     $valores['data']['token']. "<br>";
    echo '<strong>Usuario:</strong> '.   $valores['data']['nombre'].  "<br>";
    echo '<strong>eMail:</strong> '.     $valores['data']['email']. "<br>";
    echo '<strong>Contraseña:</strong> '.$valores['data']['contra']."<br>";

    session_start();
    $_SESSION['token'] = $valores['data']['token'];

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table>
        <tr>
            <td>Nombre</td>
            <td> <input name="txtNom" type="text" required> </td>
        </tr>
        <tr>
            <td>Apellidos</td>
            <td><input name="txtApes" type="text" required></td>
        </tr>
        <tr>
            <td>email</td>
            <td><input name="txtEma" type="text" required></td>
        </tr>
        <tr>
            <td>Contra</td>
            <td><input name="txtContra" type="text" required></td>
        </tr>
    </table>
    <input type="submit" value="Aceptar">
    <input type="hidden" name="ocAceptar">
</form>

</body>

</html>
