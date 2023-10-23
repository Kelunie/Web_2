<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
    <?php
    // Datos
    $datos = array(
        array('Sexo', 'Absoluto', 'Union Libre', 'Casad@', 'Divorciad@', 'Solter@', 'Viud@'),
        array('Femenino', 1018, 204, 206, 189, 193, 226),
        array('Masculino', 982, 202, 208, 178, 194, 200)
    );
    ?>

    <div id="chart_div" class="table-container"></div>

    <script>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?php echo json_encode($datos); ?>);

            var options = {
                title: 'Distribución de género por Estado Civil',
                pieHole: 0.4, // Agujero en el medio (0 para un círculo completo)
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</body>
</html>
