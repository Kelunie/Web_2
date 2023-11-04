<?php
	//obtiene raiz del sitio
	$ruta = $_SERVER["DOCUMENT_ROOT"]."/2022/php_06/generales_6.xml";

	//Seleccionas impresora
	//$impr = printer_open("Epson XP-201 204 208 Series");
	$impr = printer_open("Samsung M2020 Series");

	printer_write($impr, $ruta);
	printer_close($impr);
?>


Pericles   3500   10% => 350   3850   350
