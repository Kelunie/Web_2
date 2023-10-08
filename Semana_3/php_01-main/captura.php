<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			//invoca cabecera de la pagina
			include_once('segmentos/encabe.inc');
		?>
	</head>
	<body class="container">
		<header class="row">
			<?php
				//invoca menu de la pagina
				include_once('segmentos/menu.inc');
			?>
		</header>
		<main class="row">
			<form name="formita" method="post" action="respuesta.php">
				<h2 align="center">Formulario de captura datos</h2>
				Nombre Usuario:
				<input type="text" name="Usuario" size="20"  alt="Nombre del Cliente" >
				<br><br>

				Listado de Libros Disponibles:
				<ul>
					<li> Libro A - (Precio = 10) - Unidades: <input type="text" name="UnidA" size="4" align="right"> </li>
					<li> Libro B - (Precio = 12) - Unidades: <input type="text" name="UnidB" size="4" align="right"> </li>
				</ul>

				<p align="center">
					<input name="cmdApli" type="submit" value="Procesar">
					<input name="cmdLimp" type="reset"  value="Cancelar">
				</p>
			</form>
		</main>
		<footer class="row pie">
			<?php
				//llama al pie de pagina
				include_once('segmentos/pie.inc');
			?>
		</footer>
	</body>
</html>
