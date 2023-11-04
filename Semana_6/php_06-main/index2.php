<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<title>Crear XML Segmentado</title>
	</head>
	<body style="background-color: #FFFFCC; color: #800000">
		<img src="imagenes/encabe.png" alt="" >
		<h2>Crear XML con dos segmentos</h2>

		<?php
			//obtiene raiz del sitio
            $ruta = $_SERVER["DOCUMENT_ROOT"]."/2023/php_06/";


			//creacion del documento xml
			$xml = "<?xml version='1.0' encoding='utf-8' ?>";
			$xml .= "<informacion>";
			$xml .= "   <empresa>";
			$xml .= "      <nombre>Univesidad Técnica Nacional</nombre>";
			$xml .= "      <carrera>Tecnologías de la Información</carrera>";
			$xml .= "      <curso>Tecnologías y Sistemas Web2</curso>";
			$xml .= "   </empresa>";
			$xml .= "   <profesor>";
			$xml .= "      <nombre>Jorge Ruiz</nombre>";
			$xml .= "      <experiencia>Profesor en programación desde 1993</experiencia>";
			$xml .= "   </profesor>";
			$xml .= "</informacion>";

			//escribir archivo xml
			$ruta = $ruta."generales_2.xml";

			try{
				$archivo = fopen($ruta,"w+");
				fwrite($archivo,$xml);
				fclose($archivo);
			}catch(Exception $e){
				echo "Error:..".$e->getMessage();
			}
		?>

		<a href="generales_2.xml">XML Generado</a>

	</body>
</html>
