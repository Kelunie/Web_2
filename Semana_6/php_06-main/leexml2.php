<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<title>Lectura xml con formato css</title>
		<link href="esilos/formatos.css" type="text/css" rel="stylesheet" >
	</head>
	<body style="background-color: #FFFFCC; color: #800000">
		<img src="imagenes/encabe.png" alt="" >
		<h2>Impresión de datos desde un xml...</h2>
	
		<?php
			$inventario = simplexml_load_file("generales_5.xml"); 

			// impresión del encabezado del xml
			echo "<table style='margin-left:20px; width:600px; border:0px'>";
			foreach($inventario as $encabe){
				echo "<tr><td class='titulo'>Empresa</td><td class='campo'>".($encabe->empresa->nombre)."</td></tr>";
				echo "<tr><td class='titulo'>Carrera</td><td class='campo'>".($encabe->empresa->carrera)."</td></tr>";
				echo "<tr><td class='titulo'>Curso</td><td class='campo'>".($encabe->empresa->curso)."</td></tr>";
				
				echo "<tr><td class='titulo'>Profesor</td><td class='campo'>".($encabe->profesor->nombre)."</td></tr>";
				echo "<tr><td class='titulo'>Experiencia</td><td class='campo'>".($encabe->profesor->experiencia)."</td></tr>";
				break;	 
			}
			echo "</table>";
			
			echo "<br><br>";
			
			//impresión del detalle del xml
			//imprime categoria
			foreach($inventario->clasificacion->categoria as $datos){
				echo "<table style='margin-left:50px; width:570px; border:1px'>";
				echo "<tr><td colspan='2' class='titulo'>Categoría: ".$datos->codigo." - ".$datos->nombre."</td></tr>";
				echo "<tr><td class='campo'>Código</td><td class='campo'>Nombre</td></tr>";
								
				//imprime los articulos asociados a la categoria
				foreach($datos->articulos as $arti){
					echo "<tr><td class='campo'>".$arti->codart."</td><td class='campo'>".$arti->nomart."</td></tr>";
				}				
				echo "</table> <br><br>";
			}			
		?>
	</body>
</html>