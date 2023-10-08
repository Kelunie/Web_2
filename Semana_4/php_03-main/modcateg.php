<?php
    require_once('codes/conexion.inc');
    session_start();

    if ($_SESSION["autenticado"] != "SI") {
        header("Location:login.php");
        exit(); //fin del scrip
    }

    if((isset($_POST["OC_Modi"])) && ($_POST["OC_Modi"] == "formita")) {
        $auxSql = sprintf("update categories 
                                 set CategoryName = '%s', Description = '%s' 
                                 where CategoryID = %s",
            $_POST['txtNombre'],
            $_POST['txtDescrip'],
            $_POST['ocCodigo']);

        $Regis = mysqli_query($conex,$auxSql) or die(mysqli_error($conex));

        $archivo = $_FILES["txtArchi"]["tmp_name"];
        $tamanio = $_FILES["txtArchi"]["size"];
        $tipo    = $_FILES["txtArchi"]["type"];
        $nombre  = $_FILES["txtArchi"]["name"];

        if($archivo != "none" ){
            $archi = fopen($archivo, "rb");
            $contenido = fread($archi, $tamanio);
            $contenido = addslashes($contenido);
            fclose($archi);

            $AuxSql = "Update categories set Imagen='$contenido',
                           Mime='$tipo' Where CategoryID = " . $_POST['ocCodigo'];

            $regis = mysqli_query($conex,$AuxSql) or die(mysqli_error($conex));

            echo "Se ha guardado el archivo en la base de datos.";
        }else
            print "No se puede subir el archivo ".$nombre."  al servidor";

        header("Location: categories.php");
        exit;
    }
    if(!isset($_POST["OC_Modi"])){
        $codigo = $_GET['cod'];
    }else{
        $codigo = $_POST['ocCodigo'];
    }
    $auxSql = sprintf("select CategoryName,Description from categories
                           where CategoryID = %s", $codigo);

    $regis = mysqli_query($conex,$auxSql) or die(mysqli_error($conex));
    $tupla = mysqli_fetch_assoc($regis);
?>
<!doctype html>
<html lang="en">
    <head>
        <?php
            include_once ('sections/head.inc');
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <meta http-equiv="refresh" content="180;url=codes/salir.php">

        <script>
            function iniImage(){
                $('#txtArchi').change(function(e){
                    addImage(e);
                });
            }

            function addImage(e){
                var file = e.target.files[0];
                var	imageType = /image.*/;

                if(!file.type.match(imageType))
                    return;
                var reader = new FileReader();
                reader.onload = function(e){
                    var result=e.target.result;
                    $('#imgSalida').attr("src",result);
                }
                reader.readAsDataURL(file);
            }
        </script>

        <title>Update Category</title>
    </head>
    <body class="container-fluid" onLoad="iniImage()">
    <header class="row">
        <?php
            include_once ('sections/header.inc');
        ?>
    </header>
    <main class="row contenido">
        <div class="card tarjeta">
            <div class="card-header">
                <h4 class="card-title">Modificar Categoría</h4>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" name="formita" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <table class="table table-bordered">
                        <tr>
                            <td><strong>Código</strong></td>
                            <td><?php echo $codigo; ?></td>
                            <td rowspan="5"><img id="imgSalida" src="codes/imagen.php?cod=<?php echo $codigo; ?>" /></td>
                        </tr>

                        <tr>
                            <td><strong>Nombre</strong></td>
                            <td><input type="text" name="txtNombre" size="15" maxlength="15" value="<?php echo $tupla['CategoryName']; ?>"></td>
                        </tr>

                        <tr>
                            <td><strong>Descripción</strong></td>
                            <td><input type="text" name="txtDescrip" size="50" maxlength="50" value="<?php echo $tupla['Description']; ?>"></td>
                        </tr>

                        <tr>
                            <td><strong>Imagen</strong></td>
                            <td><input type="file" name="txtArchi" id="txtArchi"></td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="submit" value="Aceptar">
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="OC_Modi" value="formita">
                    <input type="hidden" name="ocCodigo" value="<?php echo $codigo; ?>">
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
<?php
    if(isset($regis)){
        mysqli_free_result($regis);
    }
?>
