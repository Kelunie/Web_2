<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<title>Crear XML con acceso a datos 1</title>
	</head>
	<body style="background-color: #FFFFCC; color: #800000">
		<img src="imagenes/encabe.png" alt="" >
		<h2>Crear XML con acceso a datos</h2>

		<?php
			//obtiene raiz del sitio
            $ruta = $_SERVER["DOCUMENT_ROOT"]."/2023/php_06/";


			//Hablitia conexion con el motor de MySql.
      		include_once("codigos/conexion2.inc");

			//define consulta
			$AuxSql = "Select * from categories";
			$Regis = mysqli_query($conex, $AuxSql) or die(mysqli_error($conex));


			//crea vector de datos
			$i = 0;
			while($fila = mysqli_fetch_array($Regis)){
				$codigo[$i] = $fila["CategoryID"];
				$nombre[$i] = $fila["CategoryName"];
				$descripcion[$i] = $fila["Description"];
				$i++;
			}

			//libera espacio de la consulta
			mysqli_free_result($Regis);

			//impresion de los datos (solo prueba)
			$canti = sizeof($codigo);
			for($j=0; $j < $canti; $j++){
				printf("Codigo: %s<br>Nombre: %s<br>Descripcion: %s<br>", $codigo[$j],$nombre[$j],$descripcion[$j]);
				print("----------------------------------------------------------------------------------<br><br>");
			}

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
			$xml .= "   <clasificacion>";

			for($j=0; $j < $canti; $j++){
				$Datos[$j] = '<categoria>
		                         <codigo>'.$codigo[$j].'</codigo>
		                         <nombre>'.$nombre[$j].'</nombre>
						         <descripcion>'.$descripcion[$j].'</descripcion>
					         </categoria>';
		        $xml = $xml.$Datos[$j];
			}//fin del for

			$xml .= "   </clasificacion>";
			$xml .= "</informacion>";

			//escribir archivo xml
			$ruta = $ruta."generales_4.xml";

			try{
				$archivo = fopen($ruta,"w+");
				fwrite($archivo,$xml);
				fclose($archivo);
			}catch(Exception $e){
				echo "Error:..".$e->getMessage();
			}
		?>

		<a href="generales_4.xml">XML Generado</a>

	</body>
</html>
