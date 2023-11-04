<?php
if(isset($_POST['ocAceptar'])){
    //error_reporting(0);

    $url = 'http://localhost/2023/php_07/php_07_a/index.php/login/'.$_POST['txtEma'].'/'.$_POST['txtContra'];

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPGET, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept:application/json',
        'Content-Type:application/json']);

    $result = curl_exec($curl);
    $valores = json_decode($result,true);

    echo '<strong>Token:</strong> '. $valores['data']['token']. "<br>";

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
<h3>Ventana de autentificación de usuarios</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table>
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

