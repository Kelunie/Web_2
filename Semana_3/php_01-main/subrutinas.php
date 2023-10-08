<?php
	//funcion simple
	function Saludar1() {
		echo "Hola Mundo...!<br>";
	}

	//funcion con parametros
	function Saludar2( $aQuien ) {
		echo "Hola " . $aQuien . ", como estas?<br>";
	}

	//funcion con retorno
	function Saludar3( $aQuien ) {
		return "Hola " . $aQuien . ", como estas?<br>";
	}

	//ejemplo de recursion
	function Recursiva( $a ) {
		if ( $a <= 20 ) {
			echo "$a\n";
			Recursiva( $a + 1 );
		}
	}

	//funcion que modifica un parametro
	function modParametro( & $cadena ) {
		$cadena .= ", pero algo cambió en mi.";
	}

	//funcion con valor por defecto en parametro
	function hacerCafe( $tipo = "Cappuccino" ) {
		return "Haciendo una taza de <strong>" . $tipo . "</strong>";
	}

	//funcion con valor por defecto en parametro vectorizado
	function hacerCafe2( $tipos = array( "Cappuccino" ), $coffeeMaker = NULL ) {
		$maquina = is_null( $coffeeMaker ) ? "Chorreador" : $coffeeMaker;
		return "Haciendo una taza de <strong>" . join( " - ", $tipos ) . "</strong> con el <strong>" . $maquina . "</strong>";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		//invoca cabecera de la pagina
		include_once( 'segmentos/encabe.inc' );
	?>
    <title>Subrutinas en PHP</title>
</head>
<body class="container">
	<header class="row">
		<?php
		//invoca menu de la pagina
		include_once( 'segmentos/menu.inc' );
		?>
	</header>
	<main class="row">
		<h3>Declaraci&oacute;n de Subrutinas</h3>
		<?php
			//invocacion a las subrutinas basicas
			Saludar1();
			Saludar2( "York" );
			echo Saludar3( "Darna" );

			//invocacion a funcion recursiva
			echo '<br><hr>';
			Recursiva( 1 );
			echo '<hr>';

			//invocacion a subrutina con parametros por referencia
			$expresion = 'Asi soy';
			echo "<b>Antes: </b>" . $expresion . "<br>";
			modParametro( $expresion );
			echo "<b>Después: </b>" . $expresion . "<br>";

			//invocacion a subrutinas especiales
			echo "<br>";
			echo hacerCafe() . "<br>";
			echo hacerCafe( null ) . "<br>";
			echo hacerCafe( "Espresso" ) . "<br>";

			echo "<br>";
			echo hacerCafe2() . "<br>";
			echo hacerCafe2( array( "Cappuccino", "Lavazza", "Cafe Irlandes" ), "Tetera" ) . "<br>";
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
