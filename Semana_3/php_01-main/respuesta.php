<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			//invoca cabecera de la pÃ¡gina
			include_once('segmentos/encabe.inc');
		?>
	</head>
	<body class="container">
		<header class="row">
			<?php
				//invoca menu de la pÃ¡gina
				include_once('segmentos/menu.inc');
			?>
		</header>
		<main class="row">
			<?php
				//Captura de datos
				$Usuario=$_POST['Usuario'];
				$UnidA=$_POST['UnidA'];
				$UnidB=$_POST['UnidB'];

				//Uso de datos
				echo "Nombre = <b> $Usuario </b> <br>";
				echo "N&uacute;mero de unidades Libro A = <b> $UnidA </b> <br>";
				echo "N&uacute;mero de unidades Libro B = <b> $UnidB </b> <br>";
			?>
		</main>
		<footer class="row pie">
			<?php
				//llama al pie de pÃ¡gina
				include_once('segmentos/pie.inc');
			?>
		</footer>
	</body>
</html>
