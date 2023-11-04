<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<title>Crear XML Sencillo</title>
	</head>
	<body style="background-color: #FFFFCC; color: #800000">
		<img src="imagenes/encabe.png" alt="" >
		<h2>Crear XML Sencillo</h2>

		<?php
			//obtiene raiz del sitio
			$ruta = $_SERVER["DOCUMENT_ROOT"]."/2023/php_06/";

			//creacion del documento xml
			$xml = "<?xml version='1.0' encoding='utf-8' ?>";
			$xml .= "<empresa>";
			$xml .= '   <nombre>Univesidad Técnica Nacional</nombre>';
			$xml .= '   <carrera>Tecnologías de la Información</carrera>';
			$xml .= '   <curso>Tecnologías y Sistemas Web2</curso>';
			$xml .= '</empresa>';

			//escribir archivo xml
			$ruta = $ruta."generales.xml";

			try{
				$archivo = fopen($ruta,"w+");
				fwrite($archivo,$xml);
				fclose($archivo);
			}catch(Exception $e){
				echo "Error:..".$e->getMessage();
			}
		?>

		<a href="generales.xml">XML Generado</a>

	</body>
</html>
