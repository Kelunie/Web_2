<?php
$proceso = false;

$compararCon = array(
    "limón" => array("M" => 0, "F" => 0),
    "alajuela" => array("M" => 0, "F" => 0),
    "san josé" => array("M" => 0, "F" => 0),
    "cartago" => array("M" => 0, "F" => 0),
    "puntarenas" => array("M" => 0, "F" => 0),
    "guanacaste" => array("M" => 0, "F" => 0),
    "heredia" => array("M" => 0, "F" => 0)
);

if (isset($_POST["oc_Control"])) {
    // Procesa los datos generales del archivo recibido.
    $archivo = $_FILES["txtArchi"]["tmp_name"];
    $tamanio = $_FILES["txtArchi"]["size"];
    $tipo    = $_FILES["txtArchi"]["type"];
    $nombre  = $_FILES["txtArchi"]["name"];

    // Valida que el archivo sea de tipo CSV (puedes ajustar la validación según tus necesidades)
    if ($tamanio > 0 && $tipo === 'text/csv') {
        $archi = fopen($archivo, "rb");
        $encabezados = explode(';', fgets($archi));

        $indiceDelGenero = array_search('Sexo', $encabezados); // Reemplaza 'genero' con el encabezado real de género
        $indiceDeLaZona = array_search('Provincia', $encabezados); // Reemplaza 'zona' con el encabezado real de zona

        $contenido = array();
        $posi = 0;
        while ($linea = fgets($archi)) {
            $contenido[$posi++] = explode(';', $linea);
        }

        fclose($archi);

        // Realiza el conteo de personas en cada zona y género
        for ($i = 0; $i < count($contenido); $i++) {
            $genero = $contenido[$i][$indiceDelGenero]; // Obtén el género del archivo CSV
            $datos = $contenido[$i][$indiceDeLaZona]; // Obtén la zona del archivo CSV
            $datosMinusc = strtolower($datos);
            if (array_key_exists($datosMinusc, $compararCon) && array_key_exists($genero, $compararCon[$datosMinusc])) {
                // Incrementar el contador para la zona y género correspondiente
                $compararCon[$datosMinusc][$genero]++;
            }
        }

        // Genera el array de datos en el formato adecuado para Google Visualization
        $data = array(
            array('Zona', 'M', 'F') // Utiliza 'M' y 'F' en lugar de 'masculino' y 'femenino'
        );

        foreach ($compararCon as $zona => $datos) {
            $data[] = array($zona, $datos['M'], $datos['F']);
        }

        // Convierte el array en formato JSON
        $jsonData = json_encode($data);

        // Cambia el estado del proceso
        $proceso = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("segmentos/encabe.inc"); ?>
    <!-- Agrega la biblioteca de Google Visualization -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?php echo $jsonData; ?>);

            var options = {
                title: 'Recuento de personas por zona y género',
                isStacked: false,
                series: {
                0: { color: 'blue' }, // Color para la serie de masculinos
                1: { color: 'pink' } // Color para la serie de femeninos
    }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <header>
        <?php include_once("segmentos/menu.inc"); ?>
    </header>
    <main class="row">
        <?php
        if (!$proceso) {
            // En caso que el archivo .csv no pudiese ser procesado
            echo '<div class="alert alert-danger" role="alert">';
            echo '  El archivo no puede ser procesado, verifique sus datos.....!';
            echo '</div>';
        } else {
            // Agrega el div para el gráfico
            echo '<div id="chart_div" style="width: 100%; height: 400px;"></div>';

            
            // Agrega una tabla de datos
            echo '<div class="table-container">';
            echo '<table class="styled-table">';
            echo '<tr><th>Zona</th><th>Masculino</th><th>Femenino</th></tr>';
            foreach ($compararCon as $zona => $datos) {
                echo '<tr>';
                echo '<td>' . $zona . '</td>';
                echo '<td>' . $datos['M'] . '</td>';
                echo '<td>' . $datos['F'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
        }
        ?>
    </main>
    <footer class="row pie">
		<?php
			include_once("segmentos/pie.inc");
		?>
	</footer>

    <!-- jQuery necesario para los efectos de bootstrap -->
    <script src="formatos/bootstrap/js/jquery-1.11.3.min.js"></script>
    <script src="formatos/bootstrap/js/bootstrap.js"></script>
</body>
</html>
