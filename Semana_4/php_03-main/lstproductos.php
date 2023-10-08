<?php
    require_once('codes/conexion.inc');

    session_start();

    if ($_SESSION["autenticado"] != "SI") {
        header("Location:login.php");
        exit(); //fin del script
    }

    $AuxSql = "select ProductID, ProductName from products where CategoryID = ".$_GET['cod'];

    $Regis = mysqli_query($conex,$AuxSql) or die(mysqli_error($conex));
    $NunFilas = mysqli_num_rows($Regis);
?>
<!doctype html>
<html lang="en">
    <head>
        <?php
            include_once ('sections/head.inc');
        ?>
        <meta http-equiv="refresh" content="180;url=codes/salir.php">
        <title>NorthWind Products</title>
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
                <h4 class="card-title">Lista de Productos por Categoría</h4>
            </div>
            <div class="card-body">
                <?php
                    if($NunFilas > 0){
                        echo '<img src="codes/imagen.php?cod='.$_GET['cod'].'" width="25%">';
                        echo '<table class="table table-striped">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<td><strong>Código</strong></td>
                                      <td><strong>Nombre</strong></td>
                                      <td colspan='2' align='center'><strong>Modificar</strong></td>";
                        echo "</tr>";
                        echo "</thead><tbody>";
                        while($Tupla = mysqli_fetch_assoc($Regis)){
                            echo "<tr>";
                            echo "<td>".$Tupla['ProductID']."</td>";
                            echo "<td>".$Tupla['ProductName']."</td>";
                            echo "<td align='center'>Editar</td>";
                            echo "<td align='center'>Borrar</td>";
                            echo "</tr>";
                        }
                        echo "</tbody></table>";
                    }else{
                        echo "<h3>No hay datos disponibles</h3>";
                    }
                ?>
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
<?php
    if(isset($Regis)){
        mysqli_free_result($Regis);
    }
?>
