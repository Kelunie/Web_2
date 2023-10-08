<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			//invoca cabecera de la pagina
			include_once('segmentos/encabe.inc');
		?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<script>
				function cargaProvi(){
					elegido = document.formita.cmbCombo1.value;
					$.post("codigos/consuCombo.php", {elegido: elegido}, function(data){
						$(document.formita.cmbCombo2).html(data);
					});
				}
		</script>
	</head>
	<body class="container">
		<header class="row">
			<?php
				//invoca menu de la pagina
				include_once('segmentos/menu.inc');
			?>
		</header>
		<main class="row">
			<form name="formita">
				<table>
				  <tr>
					  <td>Seleccione el país...: </td>
					  <td>
						<select name="cmbCombo1" onchange="cargaProvi()">
							<option value="na">Seleccione país</option>
							<option value="cr">Costa Rica</option>
							<option value="ng">Nicaragua</option>
                            <option value="gt">Guatemala</option>
						</select>
					  </td>
				  </tr>
				  <tr>
					  <td>Seleccione provincia...: </td>
					  <td>
						<select name="cmbCombo2">

						</select>
					  </td>
				  </tr>
				  <tr></tr>
					  <td colspan="2"><!--jlgssdsk -->
						  <input type="submit" name="Ok" value="Aceptar">
					  </td>
				  </tr>
			  </table>
			  <input type="hidden" name="oculto" value="hecho">
			</form>
		</main>
		<footer class="row pie">
			<?php
				//llama al pie de paina
				include_once('segmentos/pie.inc');
			?>
		</footer>
	</body>
</html>
