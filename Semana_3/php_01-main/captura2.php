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
			<form action="presenta.php" method="get"  name="formita" id="formita">
				<table>
					<caption>
						Información Básica
					</caption>
					<tr>
						<td width="100">ID</td> <td><input name="txtID" type="text" id="txtID" size="15" maxlength="15"></td>
					</tr>
					<tr>
						<td>Nombre</td> <td><input name="txtNombre" type="text" id="txtNombre" size="35" maxlength="35"></td>
					</tr>
					<tr>
						<td>Sexo</td>
						<td>
							<select name="cmbSexo" >
								<option selected>Femenino</option>
								<option>Masculino</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Estado Civil </td>
						<td>
							<p>
								<label><input type="radio" name="opcEstCiv" value="s" checked>Soltera (o)</label><br>
								<label><input type="radio" name="opcEstCiv" value="c">Casada (o)</label><br>
								<label><input type="radio" name="opcEstCiv" value="d">Divorciada (o)</label><br>
								<label><input type="radio" name="opcEstCiv" value="v">Viuda (o)</label><br>
								<label><input type="radio" name="opcEstCiv" value="u">Union Libre</label>	<br>
							</p>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<input name="cmdOK" type="submit" id="cmdOK" value="Aceptar">
							<input name="cmdCancelar" type="reset" id="cmdCancelar" value="Cancelar">
						</td>
					</tr>
				</table>
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
