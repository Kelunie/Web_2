<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			//invoca cabecera de la página
			include_once( 'segmentos/encabe.inc' );
		?>
        <title>Tipos de datos en PHP</title>
	</head>
<body class="container">
	<header class="row">
		<?php
            //invoca menu de la página
            include_once( 'segmentos/menu.inc' );
		?>
	</header>
	<main class="row">
		<?php
			//Declara las variables
			$logico = TRUE; // boolean
			$cadena = 'cadena'; // string
			$entero = 13; // integer
			$flotante = 45.3; // flotante

			//Declara zona horaria del sitio y variables de fecha y hora
			date_default_timezone_set( 'America/Costa_Rica' );
			$fecha = date("d/M/Y" ); // fecha
			$hora = time(); // hora

			//Imprime tipo de variables
			echo '<table class="table table-striped">';
			echo "<tr>";
			echo "<td>Descripcion</td><td>Tipo</td><td>Valor</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td>L&oacute;gico </td><td>" . gettype( $logico ) . "</td><td>" . $logico . "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td>Cadena </td><td>" . gettype( $cadena ) . "</td><td>" . $cadena . "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td>Entero </td><td>" . gettype( $entero ) . "</td><td>" . $entero . "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td>Flotante </td><td>" . gettype( $flotante ) . "</td><td>" . $flotante . "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td>Fecha </td><td>" . gettype( $fecha ) . "</td><td>" . $fecha . "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td>Hora Unix</td><td>" . gettype( $hora ) . "</td><td>" . $hora . "</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td>Hora NO Unix</td><td>" . gettype( $hora ) . "</td><td>" . strftime( '%H:%M:%S', $hora ) . "</td>";
			echo "</tr>";
			echo "</table>";
		?>
		<br>
		<br>
		<h4>Tipos Enteros</h4>
		<?php
			$posi = 1234; //positivo decimal
			$nega = -123; //negativo decimal
			$octa = 0123; //octal (equivale a 83 decimal
			$hexa = 0x1A; //hexadecimal (equivale a 26 decimal)

			//Imprime tipo de enteros
			echo '<table class="table table-striped">';
			echo "<tr>";
			echo "<td>Descripcion</td><td>Valor</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>Decimal +</td><td align='right'>" . $posi . "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>Decimal -</td><td align='right'>" . $nega . "</td>";
			echo "</tr>";
			echo "<td>Octal</td><td align='right'>" . $octa . "</td>";
			echo "<tr>";
			echo "<td>Hexadecimal</td><td align='right'>" . $hexa . "</td>";
			echo "</tr>";
			echo "</table>";
		?>
		<br>
		<br>
		<h4>Uso de Vectores</h4>
		<?php
			//asigna valores a un vector de tipos
			$vecto = array( "Hola Mundo", 69, 45.40, TRUE );

			//impresion basica del vector
			echo $vecto[ 0 ] . "<br>";
			echo $vecto[ 1 ] . "<br>";
			echo $vecto[ 2 ] . "<br>";
			echo $vecto[ 3 ] . "<br>";

			echo '<hr align="left" width="20%"><br>';

			//impresion por todo el vector
			print_r( $vecto );
			echo "<br>";

			echo '<hr align="left" width="20%"><br>';

			//impresion al estilo lista
			foreach ( $vecto as $i => $valor ) {
				echo $valor . "<br>";
			}

			echo '<hr align="left" width="20%"><br>';

			//asigna valores a un vector de tipos
			$vecto2 = array( "Texto" => "Hola Mundo", "Entero" => 69, "Flotante" => 45.40, "Booleano" => TRUE );

			//impresion al estilo lista
			foreach ( $vecto2 as $tipo => $valor ) {
				echo "Tipo " . $tipo . " Valor " . $valor . "<br>";
			}
		?>
		<br>
		<br>
		<h4>Uso de Matrices</h4>
		<?php
			//uso de matrices
			$productos = array( array( 'Android', 'Sistema operativo para celulares', 'imagenes/demo/android.jpg' ),
				                array( 'Apple', 'Equipo y programas para diseñadores', 'imagenes/demo/apple.jpg' ),
				                array( 'Arroba', 'Simbolo universal para Internet', 'imagenes/demo/arroba.jpg' ),
				                array( 'Logo HP', 'Simbolo de quipo de computo', 'imagenes/demo/hplogo.jpg' ),
				                array( 'OpenOffice', 'Programa Ofimatico para empresas', 'imagenes/demo/openoffice.png' ),
                                array( 'Logo Ubuntu', 'Sistema operativo GNU/Linux', 'imagenes/demo/ubuntu.gif' ) );

			echo '<table class="table table-striped">';
			echo '<tr>';
			echo '<td>Concepto</td><td>Descripción</td><td>Imagen</td>';
			echo '</tr>';

			for ( $fila = 0; $fila < 6; $fila++ ) {
				echo '<tr>';
				for ( $colu = 0; $colu < 3; $colu++ ) {
					echo '<td>';
					if ( $colu != 2 ) {
						echo $productos[ $fila ][ $colu ];
					} else {
						echo '<img src="' . $productos[ $fila ][ $colu ] . '" width="150" height="150" />';
					}
					echo '</td>';
				}
				echo '</tr>';
			}

			echo '</table>';
		?>
		<br>
		<br>
		<h4>Declaración de Constantes</h4>
		<?php
			//Declaracion de constantes
			define( "Pi", 3.143333 );
			define( "Maximo", 30 );
			define( "Usuario", "York" );

			//Imprime las constantes
			echo "Constante Pi : " . Pi . "<br>";
			echo "Constante Maximo : " . Maximo . "<br>";
			echo "Constante Usuario : " . Usuario . "<br>";
		?>
	</main>
	<footer class="row pie">
		<?php
			//llama al pie de página
			include_once( 'segmentos/pie.inc' );
		?>
	</footer>
</body>
</html>
