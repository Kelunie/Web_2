<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			//invoca cabecera de la pagina
			include_once( 'segmentos/encabe.inc' );
		?>
        <title>Estructuras de control en PHP</title>
	</head>
<body class="container">
	<header class="row">
		<?php
		//invoca menu de la pagina
		include_once( 'segmentos/menu.inc' );
		?>
	</header>
	<main class="row">
		<h3>Estructuras de Control con PHP</h3>
		<h4>Uso del IF</h4>
		<?php
			$a = 3;
			$b = 2;

			//if sencillo
			if ( $a > $b )
				echo "a es mayor que b<br>";

			//if con manejo de bloques
			if ( $a > $b ) {
				echo "a es mayor que b<br>";
				$a = $b;
			}

			//Uso de la clausula else
			if ( $a > $b ) {
				echo "a es mayor que b<br>";
			} else {
				echo "a NO es mayor que b<br>";
			}

			//Uso del if anidado
			if ( $a > $b ) {
				echo "a es mayor que b<br>";
			} elseif ( $a == $b ) {
				echo "a es igual que b<br>";
			} else {
				echo "a es menor que b<br>";
			}
		?>
		<br>
		<br>
		<h4>Uso del Switch</h4>
		<?php
			//declaracion del case
			switch ( $a ) {
				case 0:
					echo "a igual a 0";
					break;
				case 1:
					echo "a igual a 1";
					break;
				case 2:
					echo "a igual a 2";
					break;
				default:
					echo "a no es igual a 0, 1 or 2";
			}
		?>
		<br>
		<br>
		<h4>Uso del For</h4>
		<?php
			for ( $i = 1; $i <= 10; $i++ ) {
				echo "Valor de i :" . $i . "<br>";
			}

			echo '<hr align="left" width="20%"><br>';

			for ( $i = 10; $i > 0; $i-- ) {
				echo "Valor de i :" . $i . "<br>";
			}
		?>
		<br>
		<br>
		<h4>Uso del While</h4>
		<?php
			$i = 1;
			while ( $i <= 10 ):
				echo "Valor de i :" . $i . "<br>";
			    $i++;
			endwhile;

			echo '<hr align="left" width="20%"><br>';

			while ( $i >= 1 ) {
				echo "Valor de i :" . $i . "<br>";
				$i--;
			}
		?>
	</main>
	<footer class="row pie">
		<?php
			//llama al pie de pagina
			include_once( 'segmentos/pie.inc' );
		?>
	</footer>
</body>
</html>
