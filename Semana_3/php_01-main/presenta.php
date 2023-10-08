<?php
    $id = $_GET["txtID"];
	$Nombre = $_GET["txtNombre"];
	$sexo = $_GET["cmbSexo"];

	switch ($_GET["opcEstCiv"]) {
		case 's':
			$estciv =  "Soltera (o)";
			break;
		case 'c':
			$estciv =  "Casada (o)";
			break;
		case 'd':
        	$estciv =  "Divorciada (o)";
			break;
		case 'v':
        	$estciv =  "Viuda (o)";
			break;
		default:
        	$estciv =  "Union Libre";
	}
?>
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
			<h2>Página de datos</h2>
			<table border="1" cellspacing="1" cellpadding="1" align="center" width="400">
				<caption>
					Datos Capturados
				</caption>
				<tr>
					<td width="100">ID</td><td><?php echo $id; ?></td>
				</tr>
				<tr>
					<td>Nombre</td>	<td><?php echo $Nombre; ?></td>
				</tr>
				<tr>
					<td>Sexo</td><td><?php echo $sexo; ?></td>
				</tr>
				<tr>
					<td>Estado civil</td><td><?php echo $estciv; ?></td>
				</tr>
			</table>
		</main>
		<footer class="row pie">
			<?php
				//llama al pie de pÃ¡gina
				include_once('segmentos/pie.inc');
			?>
		</footer>
	</body>
</html>
