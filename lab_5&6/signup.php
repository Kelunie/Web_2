<?php
//error_reporting(0);

if(isset($_POST['ocAceptar'])){
    // Crear nuevo usuario
    $datos = array('ID'            => $_POST['txtID'],
                   'contraseña'    => $_POST['txtContra'],
                   'nombre'        => $_POST['txtNom'],
                   'apellidos'     => $_POST['txtApes'],
                   'fecha_nacimiento' => date('Y-m-d', strtotime($_POST['txtFechaNac'])),
                   'correopersonal'=> $_POST['txtEma'],
                   'tipo_usuario'  => 1); // 1 = Usuario normal, 2 = Administrador

    $url = 'http://localhost/Web_2/lab_5&6/api.php/signup';

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($datos));
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept: application/json', 'Content-Type: application/json']);

    $result = curl_exec($curl);
    // Agrega esta línea para ver la respuesta completa
    echo '<strong>Response:</strong> ' . $result . "<br>";
    $valores = json_decode($result, true);

    echo '<h3>Resultado de la transacción</h3>';

    if (isset($valores['status'])) {
        echo '<strong>Status:</strong> ' . $valores['status'] . "<br>";
    }

    if (isset($valores['status_message'])) {
        echo '<strong>Status Message:</strong> ' . $valores['status_message'] . "<br>";
    }

    if (isset($valores['data'])) {
        // Mostrar todos los datos obtenidos
        echo '<strong>ID:</strong> ' . $valores['data']['ID'] . "<br>";
        echo '<strong>Nombre:</strong> ' . $valores['data']['nombre'] . "<br>";
        echo '<strong>Apellidos:</strong> ' . $valores['data']['apellidos'] . "<br>";
        echo '<strong>Fecha Nacimiento:</strong> ' . $valores['data']['fecha_nacimiento'] . "<br>";
        echo '<strong>Email:</strong> ' . $valores['data']['correopersonal'] . "<br>";
        echo '<strong>Tipo Usuario:</strong> ' . $valores['data']['tipo_usuario'] . "<br>";
    }
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
<body class = "container-fluid">
    <head>
        <?php
        include_once('segmentos/anca.inc');
        ?>
    </head>

    <main class ="row">
    <div class="container mt-5">
        <div class="row">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table class="table">
                <tr>
                    <td>ID</td>
                    <td><input name="txtID" type="text" class="form-control" required></td>
                </tr>
                <tr>
                    <td>Contraseña</td>
                    <td><input name="txtContra" type="password" class="form-control" required></td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td><input name="txtNom" type="text" class="form-control" required></td>
                </tr>
                <tr>
                    <td>Apellidos</td>
                    <td><input name="txtApes" type="text" class="form-control" required></td>
                </tr>
                <tr>
                    <td>Fecha Nacimiento</td>
                    <td><input name="txtFechaNac" type="text" class="form-control" required></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input name="txtEma" type="text" class="form-control" required></td>
                </tr>
            </table>
            <input type="submit" value="Aceptar" name="ocAceptar" class="btn  btn_per">
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


