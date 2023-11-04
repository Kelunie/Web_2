<?php
	$valor = "";
	$val1 = "";
	$val2 = "";

	if((isset($_POST['oculto'])) && ($_POST['oculto'] == 'hecho')){
		$valor = $_POST['txtVal1'] + $_POST['txtVal2'];

		//datos para no perder
		$val1 = $_POST['txtVal1'];
		$val2 = $_POST['txtVal2'];
	}
?>
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
			<h1>Otra Captura</h1>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
				<table>
					<tr>
						<td>Valor 1</td>
						<td><input type="text" name="txtVal1" value="<?php echo $val1; ?>"></td>
					</tr>
					<tr>
						<td>Valor 2</td>
						<td><input type="text" name="txtVal2" value="<?php echo $val2; ?>"></td>
					</tr>
					<tr>
						<td>Resultado</td>
						<td>
							<input type="text"
								   name="txtRes" disabled
								   value="<?php echo $valor; ?>"
								   >
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="Ok" value="Aceptar">
						</td>
					</tr>
				</table>
				<input type="hidden" name="oculto" value="hecho">
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
