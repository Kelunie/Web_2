<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<title>Crear XML Segmentado jerarquicos</title>
	</head>
	<body style="background-color: #FFFFCC; color: #800000">
		<img src="imagenes/encabe.png" alt="" >
		<h2>Crear XML con dos segmentos jerarquicos</h2>

		<?php
			//obtiene raiz del sitio
            $ruta = $_SERVER["DOCUMENT_ROOT"]."/2023/php_06/";

			//creacion del documento xml
			$xml = "<?xml version='1.0' encoding='utf-8' ?>";
			$xml .= "<informacion>";
			$xml .= "   <generalidades>";
			$xml .= "      <empresa>";
			$xml .= "         <nombre>Univesidad Técnica Nacional</nombre>";
			$xml .= "         <carrera>Tecnologías de la Información</carrera>";
			$xml .= "         <curso>Tecnologías y Sistemas Web2</curso>";
			$xml .= "      </empresa>";
			$xml .= "      <profesor>";
			$xml .= "         <nombre>Jorge Ruiz</nombre>";
			$xml .= "         <experiencia>Profesor en programación desde 1993</experiencia>";
			$xml .= "      </profesor>";
			$xml .= "   </generalidades>";
			$xml .= "   <estudiantes>";
			$xml .= "      <alumno_1>";
			$xml .= "         <nombre>Daniel Ortega</nombre>";
			$xml .= "         <nacionalidad>Nicaraguense</nacionalidad>";
			$xml .= "      </alumno_1>";
			$xml .= "      <alumno_2>";
			$xml .= "         <nombre>Nicolas Maduro</nombre>";
			$xml .= "         <nacionalidad>Venezolano</nacionalidad>";
			$xml .= "      </alumno_2>";
			$xml .= "      <alumno_3>";
			$xml .= "         <nombre>Guillermo Solís</nombre>";
			$xml .= "         <nacionalidad>Costarricense</nacionalidad>";
			$xml .= "      </alumno_3>";
			$xml .= "   </estudiantes>";
			$xml .= "</informacion>";

			//escribir archivo xml
			$ruta = $ruta."generales_3.xml";

			try{
				$archivo = fopen($ruta,"w+");
				fwrite($archivo,$xml);
				fclose($archivo);
			}catch(Exception $e){
				echo "Error:..".$e->getMessage();
			}
		?>

		<a href="generales_3.xml">XML Generado</a>

	</body>
</html>
