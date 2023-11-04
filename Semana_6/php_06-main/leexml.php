<?php
	function lectu_recursiva(SimpleXMLElement $elementos, $nivel = 0) {
         $indent = str_repeat("\t", $nivel);	// determina cuantos tabuladores existen
         $valor = trim((string) $elementos);		// obtiene una linea de texto
         $atributos = $elementos->attributes();		// obtiene todos los campos de un registro
         $registros = $elementos->children();		// obtiene todos los registros

         echo "{$indent}Campo '{$elementos->getName()}'...".PHP_EOL;
         if(count($registros) == 0 && !empty($valor)){
                 echo "{$indent}Valor: {$elementos}".PHP_EOL;
         }

         //muestra los campos de un registro
         if(count($atributos) > 0){
                 echo $indent.'Tiene '.count($atributos).'  campos(s):'.PHP_EOL;
                 foreach($atributos as $campo){
                         echo "{$indent}- {$campo->getName()}: {$campo}".PHP_EOL;
                 }
         }

         //muestra el registro y determina si el proceso se invoca de nuevo
         if(count($registros)){
                 echo $indent.'Tiene '.count($registros).'  registro(s):'.PHP_EOL;
                 foreach($registros as $registro){
                         lectu_recursiva($registro, $nivel+1); //recursion
                 }
         }

         echo $indent.PHP_EOL; //fin del proceso
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<title>Lectura xml sin formato</title>
	</head>
	<body style="background-color: #FFFFCC; color: #800000">
		<img src="imagenes/encabe.png" alt="" >
		<h2>Impresion de datos sin formato desde un xml...</h2>

		<?php
			$inventario = simplexml_load_file("generales_5.xml");
			lectu_recursiva($inventario);
		?>
	</body>
</html>
