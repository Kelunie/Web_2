<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<title>Crear XML con acceso a datos 3</title>
	</head>
	<body style="background-color: #FFFFCC; color: #800000">
		<img src="imagenes/encabe.png" alt="" >
		<h2>Crear XML con acceso a datos formateando xml</h2>

		<?php
			//obtiene raiz del sitio
            $ruta = $_SERVER["DOCUMENT_ROOT"]."/2023/php_06/";

			//Hablitia conexion con el motor de MySql.
      		include_once("codigos/conexion2.inc");

			//define consulta
			$AuxSql =  "Select categories.CategoryID, CategoryName,ProductID,ProductName from categories, products ";
			$AuxSql .= "where categories.CategoryID = products.CategoryID order by categories.CategoryID, ProductID";

			$Regis = mysqli_query($conex, $AuxSql) or die(mysqli_error($conex));
			//crea vector de datos
			$i = 0;
			while($fila = mysqli_fetch_array($Regis)){
				$codigo[$i] = $fila["CategoryID"];
				$nombre[$i] = $fila["CategoryName"];

				$codpro[$i] = $fila["ProductID"];
				$nompro[$i] = $fila["ProductName"];
				$i++;
			}

			//libera espacio de la consulta
			mysqli_free_result($Regis);

			//impresion de los datos (solo prueba)
			$canti = sizeof($codigo);
			$cate = "";
			for($j=0; $j < $canti; $j++){
			    if($cate != $codigo[$j]){
					print("------------------------------------------------------------------------<br>");
					printf("Categoria: %s - %s<br>", ($codigo[$j]),($nombre[$j]));
					print("------------------------------------------------------------------------<br>");
					$cate = $codigo[$j];
				}
				printf("Producto: %s - %s<br>", ($codpro[$j]),($nompro[$j]));

			}
			print("<br>");

			//creacion del documento xml
			$xml = "<?xml version='1.0' encoding='utf-8' ?>";
			$xml .= "<?xml-stylesheet type='text/xsl'  href='esilos/formatos.xsl'?>";
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

			$cate = $codigo[0];
			$Datos[0] = '<categoria>
		                    <codigo>'.$codigo[0].'</codigo>
		                    <nombre>'.($nombre[0]).'</nombre>';
			for($j=0; $j < $canti; $j++){
				if($cate != $codigo[$j]){
					if(isset($Datos[$j])){
						$Datos[$j] .= '</categoria>';
					}else{
						$Datos[$j] = '</categoria>';
					}

					$Datos[$j] .= '<categoria>
		                              <codigo>'.$codigo[$j].'</codigo>
		                              <nombre>'.($nombre[$j]).'</nombre>';

					$cate = $codigo[$j];
				}


				if(isset($Datos[$j])){
			    	$Datos[$j] .= '<articulos>';
			    }else{
			    	$Datos[$j] = '<articulos>';
			    }

			    if(isset($Datos[$j])){
					$Datos[$j] .= '<codart>'.$codpro[$j].'</codart><nomart>'.($nompro[$j]).'</nomart>';
				}else{
					$Datos[$j] = '<codart>'.$codpro[$j].'</codart><nomart>'.($nompro[$j]).'</nomart>';
				}
                $Datos[$j] .= '</articulos>';


		        $xml = $xml.$Datos[$j];
			}//fin del for

			$xml .= "      </categoria>";
			$xml .= "   </clasificacion>";
			$xml .= "</informacion>";

			//escribir archivo xml
			$ruta = $ruta."generales_6.xml";

			try{
				$archivo = fopen($ruta,"w+");
				fwrite($archivo,$xml);
				fclose($archivo);
			}catch(Exception $e){
				echo "Error:..".$e->getMessage();
			}
		?>

		<a href="generales_6.xml">XML Generado</a><br />
		<a href="descargaxml.php">Descargar archivo xml</a>


	</body>
</html>
