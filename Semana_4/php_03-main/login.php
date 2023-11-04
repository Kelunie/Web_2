<?php
    require_once('codes/conexion.inc');
    $Accion_Formulario = $_SERVER['PHP_SELF'];

    if((isset($_POST['txtUsua'])) && (isset($_POST['txtContra']))) {
        $auxSql = sprintf("select * from usuarios where usuario = '%s' and contra = md5('%s')",
            $_POST['txtUsua'],
            $_POST['txtContra']);

        //$regis = mysqli_query($conex, $auxSql) or die(mysqli_error($conex));
        $regis = mysqli_query($conex, $auxSql) or exit("Sorry, your written request is baddest...!");
        $rowRegis = mysqli_fetch_assoc($regis);

        $nunFilas = mysqli_num_rows($regis);

        if($nunFilas > 0){
            session_start();
            $_SESSION["autenticado"]= "SI";
            $_SESSION["usuario"]= $rowRegis['usuario'];
            header("Location: index.php");
        }else{
            echo "<script> alert('Datos de autenticación incorrectos.'); </script>";
        }
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <?php
            include_once ('sections/head.inc');
        ?>
        <title>Login access</title>
    </head>
<body class="container-fluid">
    <header class="row">
        <?php
            include_once ('sections/header.inc');
        ?>
    </header>
    <main class="row contenido">
        <div class="login">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Autenticación de Usuarios</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo $Accion_Formulario; ?>" method="post">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td align="right"><strong>Usuario:</strong></td>
                                <td><input type="Text" name="txtUsua" size="20" maxlength="15" required></td>
                            </tr>
                            <tr>
                                <td align="right"><strong>Contraseña:</strong></td>
                                <td><input type="password" name="txtContra" size="20" maxlength="15" required></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="submit" value="Aceptar" class="btn btn-primary"></td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer class="row pie">
        <?php
            include_once ('sections/foot.inc');
        ?>
    </footer>
</body>
</html>
