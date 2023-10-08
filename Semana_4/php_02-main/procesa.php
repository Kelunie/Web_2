<?php

    $proceso = false;
    if(isset($_POST["oc_Control"])){

        //procesa los datos generales del archivo recibido.
		$archivo = $_FILES["txtArchi"]["tmp_name"];
		$tamanio = $_FILES["txtArchi"]["size"];
		$tipo    = $_FILES["txtArchi"]["type"];
        $nombre  = $_FILES["txtArchi"]["name"];

        //valida que
        if($tamanio > 0){
            //procesa el contenido del archivo recibido.
            $archi = fopen($archivo, "rb");
            $encabezados = explode(';',fgets($archi));

            $contenido = array();
            $posi = 0;
            while($linea = fgets($archi)){
                $contenido[$posi++] = explode(';',$linea);
            }

            //cierra el archivo.
            fclose($archi);

            //cambia el estado del proceso.
            $proceso = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include_once("segmentos/encabe.inc");
	?>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <title>Proceso de datos</title>
</head>
<body class="container">
	<header class="row">
		<?php
			include_once("segmentos/menu.inc");
		?>
	</header>

	<main class="row">
		<div class="linea_sep">
            <h3>Procesando archivo.</h3>
            <br>
            <?php
                if(!$proceso){
                    //En caso que el archivo .csv no pudiese ser procesado
                    echo '<div class="alert alert-danger" role="alert">';
                    echo '  El archivo no puede ser procesado, verifique sus datos.....!';
                    echo '</div>';
                }else{
                    //En caso que el archivo .csv pudiese ser procesado
                    echo "<h4>Datos Generales.</h4>";

                    echo "<table class='table table-bordered table-hover'>";
                    echo "  <tr>";
                    echo "      <td>Nombre</td><td>".$nombre."</td>";
                    echo "  </tr>";
                    echo "      <td>Tipo</td><td>".$tipo."</td>";
                    echo "  <tr>";
                    echo "  </tr>";
                    echo "  <tr>";
                    echo "      <td>Tamaño</td><td>".number_format((($tamanio)/1024)/1024,2,'.',',')." MBs</td>";
                    echo "  </tr>";
                    echo "</table>";

                    echo "<br>";
                    echo "<h4>Estructura.</h4>";
                    echo "<table class='table table-bordered table-hover'>";
                    echo "  <tr>";

                    foreach($encabezados as $titulo){
                        echo "<td>".$titulo."</td>";
                    }

                    echo "  </tr><tr>";

                    foreach($contenido[0] as $datos){
                        echo "<td>".gettype($datos)."</td>";
                    }

                    echo "  </tr>";
                    echo "</table>";

                    echo "<br>";
                    echo "<h4>Datos.</h4>";
                    echo "<table id='tblDatos' class='table table-bordered table-hover'>";
                    echo "<thead><tr>";

                    foreach($encabezados as $titulo){
                        echo "<td>".$titulo."</td>";
                    }

                    echo "</tr></thead><tbody>";

                    for ($i=0; $i < 100 ; $i++) {
                        echo "<tr>";
                        foreach($contenido[$i] as $datos){
                            echo "<td>".$datos."</td>";
                        }
                        echo "</tr>";
                    }

                    echo "<tbody></table>";

                }//fin del else (solo si el archivo fue procesado)
            ?>
		</div>
	</main>

	<footer class="row pie">
		<?php
			include_once("segmentos/pie.inc");
		?>
	</footer>

	<!-- jQuery necesario para los efectos de bootstrap -->
    <script src="formatos/bootstrap/js/jquery-1.11.3.min.js"></script>
    <script src="formatos/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#tblDatos').dataTable({
                "language":{
                    "url": "dataTables.Spanish.lang"
                }
            });
        });
    </script>
</body>
</html>










