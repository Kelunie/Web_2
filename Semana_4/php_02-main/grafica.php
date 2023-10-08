<!DOCTYPE html>
<html lang="en">
<head>	
    <?php
        include_once("segmentos/encabe.inc");        
	?>
    
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
   
    <script type="text/javascript">
        var datos = $.ajax({
            url:'datos.php',
            type:'post',
            dataType:'json',
            async:false
        }).responseText;

        datos = JSON.parse(datos);

        google.load("visualization", "1", {packages:["corechart"]});

        google.setOnLoadCallback(creaGrafico);

        function creaGrafico() {
            var data = google.visualization.arrayToDataTable(datos);
        
            var opciones = {
                title: 'INTENSION DE VOTOS',
                hAxis: {title: 'MESES', titleTextStyle: {color: 'green'}},
                vAxis: {title: 'Encuestados', titleTextStyle: {color: '#FF0000'}},
                backgroundColor:'#ffffcc',
                legend:{position: 'bottom', textStyle: {color: 'blue', fontSize: 13}},
                width:900,
                height:500
            };

            var grafico = new google.visualization.ColumnChart(document.getElementById('grafica'));
            grafico.draw(data, opciones);
}

    </script>   
</head>
<body class="container">
	<header class="row">
		<?php
			include_once("segmentos/menu.inc");
		?>
	</header>

	<main class="row">
		<div class="linea_sep">
            <div id="grafica"> </div>
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
</body>
</html>
