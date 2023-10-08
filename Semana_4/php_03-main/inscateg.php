<?php
    require_once('codes/conexion.inc');
    session_start();

    if ($_SESSION["autenticado"] != "SI") {
        header("Location:login.php");
        exit();
    }

    if ((isset($_POST["OC_insertar"])) && ($_POST["OC_insertar"] == "formita")) {
        $auxSql = sprintf("insert into categories(CategoryName, Description) values('%s', '%s')",
            $_POST['txtNombre'],
            $_POST['txtDescrip']);

        $Regis = mysqli_query($conex,$auxSql) or die(mysqli_error($conex));
        header("Location: categories.php");
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <?php
            include_once ('sections/head.inc');
        ?>
        <meta http-equiv="refresh" content="180;url=codes/salir.php">
        <title>Create Category</title>
    </head>
    <body class="container-fluid">
    <header class="row">
        <?php
            include_once ('sections/header.inc');
        ?>
    </header>
    <main class="row contenido">
        <div class="card tarjeta">
            <div class="card-header">
                <h4 class="card-title">Insertar Categoría</h4>
            </div>
            <div class="card-body">
                <form method="post" name="formita" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <table class="table table-bordered">
                        <tr>
                            <td><strong>Nombre</strong></td>
                            <td><input type="text" name="txtNombre" size="15" maxlength="15"></td>
                        </tr>
                        <tr>
                            <td><strong>Descripción</strong></td>
                            <td><input type="text" name="txtDescrip" size="50" maxlength="50"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" value="Aceptar">
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="OC_insertar" value="formita">
                </form>
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
