<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			//invoca cabecera de la página
			include_once('segmentos/encabe.inc');
		?>
        <title>Demostración de PHP</title>
	</head>
	<body class="container">
		<header class="row">
			<?php
				//invoca menu de la página
				include_once('segmentos/menu.inc');
			?>
		</header>
		<main class="row">
			<h2><?php echo 'Lectura de un archivo '; ?></h2>

			<?php
				//declara variable de carga
				$archi = file_get_contents('textos/intro.txt');

				//primera letra en mayúscula
				$archi = ucfirst($archi);

				//convierte enter en br
				$archi = nl2br($archi);



				//imprime contenido
				echo '<h4>Introducción a PHP</h4><br>';

                echo $archi;
			?>
		</main>
		<footer class="row pie">
			<?php
				//llama al pie de página
				include_once('segmentos/pie.inc');
			?>
		</footer>
	</body>
</html>
