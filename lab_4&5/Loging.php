<?php
if(isset($_POST['ocAceptar'])){
    //error_reporting(0);

    $url = 'http://localhost/Web_2/lab_4&5/api.php/login/'.$_POST['txtEma'].'/'.$_POST['txtContra'];
    
    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPGET, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept:application/json',
        'Content-Type:application/json']);

    $result = curl_exec($curl);
    $valores = json_decode($result,true);
    $dat = $valores["data"];
    $id = $dat["ID"];
    echo 'id: '. $id. "<br>";

    session_start();
    $_SESSION['user'] = $valores['data']['ID'];
    $_SESSION['nombre'] = $valores['data']['nombre'];
    $_SESSION['apellidos'] = $valores['data']['apellidos'];
    $_SESSION['tipo_usuario'] = $valores['data']['tipo_usuario'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    //invoca cabecera de la página
    include_once('segmentos/encabe.inc');
    ?>
    <title>Lethal Company</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="codigos/styles/signup.css">
</head>
<body class="container-fluid">
    <head>
        <?php
        include_once('segmentos/anca.inc');
        ?>
    </head>

    <main class="row">
        <div class="container mt-5">
            <div class="row">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <table class="table">
                        <tr>
                            <td>Email</td>
                            <td><input name="txtEma" type="text" class="form-control" required placeholder="example@example.ex"></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input name="txtContra" type="password" class="form-control" required></td>
                        </tr>
                    </table>
                    <input type="submit" value="Login" name="ocAceptar" class="btn btn_per">
                </form>
            </div>
        </div>
    </main>
    <footer>
        <?php
        include_once('Segmentos/pie.inc');
        ?>
    </footer>

    <!-- Incluye Bootstrap JS (si es necesario) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>