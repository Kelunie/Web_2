<?php
	header('Content-disposition: attachment; filename=generales_6.xml');
	header('Content-type: application/octet-stream .xml; charset=utf-8');

	//obtiene raiz del sitio
    $ruta = $_SERVER["DOCUMENT_ROOT"]."/2022/php_06/generales_6.xml";

	readfile($ruta);
?>
