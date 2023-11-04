<?php

    $proceso = false;
    $num_encabezados = 0; // almacena la cantidad de encabezados
    $num_encabezados2 = 0; // almacena la cantidad de encabezados
    $encabezados = array(); // almacena los encabezados

    // Función para crear encabezados
    function createHeaders($separator, $numColumns) {
        // Crear encabezados basados en la cantidad de campos
        $headers = [];
        for ($i = 1; $i <= $numColumns; $i++) {
            $headers[] = 'Campo ' . $i;
        }
        return $headers;
    }

    function determinarTipoDato($valor) {
        // Intenta determinar si es un número (entero o decimal)
        if (is_numeric($valor)) {
            return strpos($valor, '.') !== false ? 'Número Decimal' : 'Número Entero';
        }
    
        // Intenta determinar si es una fecha
        $formatoFecha = 'd/m/Y'; // Formato para dd/mm/yyyy
        $fecha = DateTime::createFromFormat($formatoFecha, $valor);
        if ($fecha && $fecha->format($formatoFecha) === $valor) {
            return 'Fecha';
        }
    
        // Si no se pudo determinar un tipo específico, lo consideramos como una cadena
        return 'Cadena';
    }

    if(isset($_POST["oc_Control"])){

        //procesa los datos generales del archivo 1 recibido.
		$archivo = $_FILES["txtArchi"]["tmp_name"];
		$tamanio = $_FILES["txtArchi"]["size"];
		$tipo    = $_FILES["txtArchi"]["type"];
        $nombre  = $_FILES["txtArchi"]["name"];
        
        // procesa los dartos del archivo 2 recibido
        $archivo2 = $_FILES["txtArchi2"]["tmp_name"];
		$tamanio2 = $_FILES["txtArchi2"]["size"];
		$tipo2    = $_FILES["txtArchi2"]["type"];
        $nombre2  = $_FILES["txtArchi2"]["name"];
        
        // Obtengo el separador
        $caracterSeparador = $_POST["c_s"];
        // valida el checkbox
        $tieneEncabezado = isset($_POST["tieneEncabezado"]) && $_POST["tieneEncabezado"] == "on";

        //valida que
        if($tamanio > 0){
            //procesa el contenido del archivo recibido.
            $archi = fopen($archivo, "rb");
            
            // lee la primera linea o utiliza el encabezados creados
            if ($tieneEncabezado) {
                $linea = fgets($archi);
                $encabezados = explode($caracterSeparador, $linea);
            } else {
                $numColumns = count(explode($caracterSeparador, fgets($archi)));
                $encabezados = createHeaders($caracterSeparador, $numColumns);
            }
            $num_encabezados = count($encabezados); // Obtener la cantidad de encabezados

            $contenido = array();
            $posi = 0;
            // Leer desde la primera línea si hay encabezado, desde la segunda si no lo hay
            $startLine = $tieneEncabezado ? 1 : 0;
            fseek($archi, 0); // Reiniciar el puntero de archivo
            for ($i = 0; $i < $startLine; $i++) {
                fgets($archi);
            }

            while($linea = fgets($archi)){
                $contenido[$posi++] = explode($caracterSeparador,$linea);
            }
            $menoredad = 100;
            $mayoredad = 0;
            for ($i =0; $i < count($contenido); $i++){
                $numero = (int)$contenido[$i][3];
                if($numero < $menoredad){
                    $menoredad = $numero;
                }
                if($numero > $mayoredad){
                    $mayoredad = $numero;
                }
            }
            
            $menorsal = 570000;
            $mayorsal = 0;
            for ($i =0; $i < count($contenido); $i++){
                $numero = (float)$contenido[$i][5];
                if($numero < $menorsal){
                    $menorsal = $numero;
                }
                if($numero > $mayorsal){
                    $mayorsal = $numero;
                }
            }

            // datos para comparar tabla1
            $fem1 = 0;
            $mas1 = 0;
            $Funion1 = 0;
            $Fcasado1 = 0;
            $Fdivorciado1 = 0;
            $Fsoltero1 = 0;
            $Fviudo1 = 0;
            $Munion1 = 0;
            $Mcasado1 = 0;
            $Mdivorciado1 = 0;
            $Msoltero1 = 0;
            $Mviudo1 = 0;
            for ($i = 0; $i < count($contenido); $i++){
                if("F" == strval($contenido[$i][1])){
                    $fem1++;
                    if ($contenido[$i][2] == "U"){
                        $Funion1++;
                    }
                    if ($contenido[$i][2] == "C"){
                        $Fcasado1++;
                    }
                    if ($contenido[$i][2] == "D"){
                        $Fdivorciado1++;
                    }
                    if ($contenido[$i][2] == "S"){
                        $Fsoltero1++;
                    }
                    if ($contenido[$i][2] == "V"){
                        $Fviudo1++;
                    }
                }else{
                    $mas1++;
                    if ($contenido[$i][2] == "U"){
                        $Munion1++;
                    }
                    if ($contenido[$i][2] == "C"){
                        $Mcasado1++;
                    }
                    if ($contenido[$i][2] == "D"){
                        $Mdivorciado1++;
                    }
                    if ($contenido[$i][2] == "S"){
                        $Msoltero1++;
                    }
                    if ($contenido[$i][2] == "V"){
                        $Mviudo1++;
                    }
                }
            }
            $datosgraficoF = array(
                array('Estado Civil', 'Cantidad'),
                array('Union Libre', $Funion1),
                array('Casad@', $Fcasado1),
                array('Divorciad@', $Fdivorciado1),
                array('Solter@', $Fsoltero1),
                array('Viud@', $Fviudo1),
            );
            $datosgraficoM = array(
                array('Estado Civil', 'Cantidad'),
                array('Union Libre', $Munion1),
                array('Casad@', $Mcasado1),
                array('Divorciad@', $Mdivorciado1),
                array('Solter@', $Msoltero1),
                array('Viud@', $Mviudo1),
            );

            //cierra el archivo.
            fclose($archi);

            //cambia el estado del proceso.
            $proceso = true;
        }

        //valida que
        if($tamanio2 > 0){
            //procesa el contenido del archivo recibido.
            $archi = fopen($archivo2, "rb");
            
            // lee la primera linea o utiliza el encabezados creados
            if ($tieneEncabezado) {
                $linea = fgets($archi);
                $encabezados = explode($caracterSeparador, $linea);
            } else {
                $numColumns = count(explode($caracterSeparador, fgets($archi)));
                $encabezados2 = createHeaders($caracterSeparador, $numColumns);
            }
            $num_encabezados2 = count($encabezados2); // Obtener la cantidad de encabezados

            $contenido2 = array();
            $posi2 = 0;
            // Leer desde la primera línea si hay encabezado, desde la segunda si no lo hay
            $startLine = $tieneEncabezado ? 1 : 0;
            fseek($archi, 0); // Reiniciar el puntero de archivo
            for ($i = 0; $i < $startLine; $i++) {
                fgets($archi);
            }

            while($linea = fgets($archi)){
                $contenido2[$posi2++] = explode($caracterSeparador,$linea);
            }
            $menoredad2 = 100;
            $mayoredad2 = 0;
            for ($i =0; $i < count($contenido2); $i++){
                $numero = (int)$contenido2[$i][3];
                if($numero < $menoredad2){
                    $menoredad2 = $numero;
                }
                if($numero > $mayoredad2){
                    $mayoredad2 = $numero;
                }
            }
            
            $menorsal2 = 570000;
            $mayorsal2 = 0;
            for ($i =0; $i < count($contenido2); $i++){
                $numero = (float)$contenido2[$i][5];
                if($numero < $menorsal2){
                    $menorsal2 = $numero;
                }
                if($numero > $mayorsal2){
                    $mayorsal2 = $numero;
                }
            }

            // datos para comparar tabla 2
            $fem2 = 0;
            $mas2 = 0;
            $Funion2 = 0;
            $Fcasado2 = 0;
            $Fdivorciado2 = 0;
            $Fsoltero2 = 0;
            $Fviudo2 = 0;
            $Munion2 = 0;
            $Mcasado2 = 0;
            $Mdivorciado2 = 0;
            $Msoltero2 = 0;
            $Mviudo2 = 0;
            for ($i = 0; $i < count($contenido2); $i++){
                if("F" == strval($contenido2[$i][1])){
                    $fem2++;
                    if ($contenido2[$i][2] == "U"){
                        $Funion2++;
                    }
                    if ($contenido2[$i][2] == "C"){
                        $Fcasado2++;
                    }
                    if ($contenido2[$i][2] == "D"){
                        $Fdivorciado2++;
                    }
                    if ($contenido2[$i][2] == "S"){
                        $Fsoltero2++;
                    }
                    if ($contenido2[$i][2] == "V"){
                        $Fviudo2++;
                    }
                }else{
                    $mas2++;
                    if ($contenido2[$i][2] == "U"){
                        $Munion2++;
                    }
                    if ($contenido2[$i][2] == "C"){
                        $Mcasado2++;
                    }
                    if ($contenido2[$i][2] == "D"){
                        $Mdivorciado2++;
                    }
                    if ($contenido2[$i][2] == "S"){
                        $Msoltero2++;
                    }
                    if ($contenido2[$i][2] == "V"){
                        $Mviudo2++;
                    }
                }
            }

            $datosgraficoF2 = array(
                array('Estado Civil', 'Cantidad'),
                array('Union Libre', $Funion2),
                array('Casad@', $Fcasado2),
                array('Divorciad@', $Fdivorciado2),
                array('Solter@', $Fsoltero2),
                array('Viud@', $Fviudo2),
            );
            $datosgraficoM2 = array(
                array('Estado Civil', 'Cantidad'),
                array('Union Libre', $Munion2),
                array('Casad@', $Mcasado2),
                array('Divorciad@', $Mdivorciado2),
                array('Solter@', $Msoltero2),
                array('Viud@', $Mviudo2),
            );



            //cierra el archivo.
            fclose($archi);

            //cambia el estado del proceso.
            $proceso = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include_once("segmentos/encabe.inc");
	?>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="formatos/font/mistilo.css"/>
    
    
    <title>Proceso de datos</title>
</head>
<body class="container">
	<header class="row">
		<?php
			include_once("segmentos/menu.inc");
		?>
	</header>

	<main class="row">
		<div class="linea_sep">
            <h3>Procesando archivo.</h3>
            <br>
            <?php
                if(!$proceso){
                    //En caso que el archivo .csv no pudiese ser procesado
                    echo '<div class="alert alert-danger" role="alert">';
                    echo '  El archivo no puede ser procesado, verifique sus datos.....!';
                    echo '</div>';
                }else{
                    //En caso que el archivo .csv pudiese ser procesado
                    echo "<h4>Datos Generales.</h4>";

                    echo "<table class='table table-bordered table-hover'>";
                    echo "  <tr>";
                    echo "      <td>Archivo</td><td>Tipo</td><td>Peso</td><td>Observaciones</td>";
                    echo "  </tr>";
                    echo "      <td>$nombre</td><td>".$tipo."</td><td>".number_format((($tamanio)/1024)/1024,2,'.',',')."MB</td> <td>".count($contenido)."</td>";
                    echo "  <tr>";
                    echo "  </tr>";
                    echo "      <td>$nombre2</td><td>".$tipo2."</td><td>".number_format((($tamanio2)/1024)/1024,2,'.',',')."MB</td> <td>".count($contenido2)."</td>";
                    echo "  <tr>";
                    echo "  </tr>";
                    echo "</table>";


                    echo "<br>";
                    echo "<h4>Estructura: ".$nombre."</h4>";
                    echo "<table class='table table-bordered table-hover'>";
                    echo "<tr>";
                        echo "<td> Campo</td>";
                        echo "<td> Tipo</td>";
                        echo "<td> Uso</td>";
                        echo "<td> Valor</td>";
                        echo "  </tr>";
                        $contador =1;
                        foreach($contenido[0] as $datos){
                        
                            echo "<tr>";
                            echo "<td> Campo ".$contador."</td>";
                            echo "<td>".determinarTipoDato($datos)."</td>";
                            if (is_numeric($datos)){
                                echo "<td> Cuantitativo </td>";
                            }else{
                                echo "<td> Cualitativo </td>";
                            }
                            if ($contador == 1){
                                echo "<td>1 a ".count($contenido)."</td>";
                            }
                            if ($contador == 2){
                                echo "<td>M a F</td>";
                            }
                            if ($contador == 3){
                                echo "<td>Variado</td>";
                            }
                            if ($contador == 4){
                                echo "<td> ".$menoredad." a ".$mayoredad."</td>";
                            }
                            if ($contador == 5){
                                echo "<td>Variado</td>";
                            }
                            if ($contador == 6){
                                echo "<td> ".$menorsal." a ".$mayorsal."</td>";
                            }
                            if ($contador == 7){
                                echo "<td>Variado</td>";
                            }
                            if ($contador == 8){
                                echo "<td>Variado</td>";
                            }
                            if ($contador == 9){
                                echo "<td>Variado</td>";
                            }
                            if ($contador == 10){
                                echo "<td>Variado</td>";
                            }
                            echo "  </tr>";
                            $contador++;
                        }

                    echo "</table><h4>Estructura: ".$nombre2."</h4>";

                    echo "<table class='table table-bordered table-hover'>";
                    echo "<tr>";
                        echo "<td> Campo</td>";
                        echo "<td> Tipo</td>";
                        echo "<td> Uso</td>";
                        echo "<td> Valor</td>";
                        echo "  </tr>";
                        $contador2 =1;
                        foreach($contenido2[0] as $datos){
                        
                            echo "<tr>";
                            echo "<td> Campo ".$contador2."</td>";
                            echo "<td>".determinarTipoDato($datos)."</td>";
                            if (is_numeric($datos)){
                                echo "<td> Cuantitativo </td>";
                            }else{
                                echo "<td> Cualitativo </td>";
                            }
                            if ($contador2 == 1){
                                echo "<td>1 a ".count($contenido2)."</td>";
                            }
                            if ($contador2 == 2){
                                echo "<td>M a F</td>";
                            }
                            if ($contador2 == 3){
                                echo "<td>Variado</td>";
                            }
                            if ($contador2 == 4){
                                echo "<td> ".$menoredad2." a ".$mayoredad2."</td>";
                            }
                            if ($contador2 == 5){
                                echo "<td>Variado</td>";
                            }
                            if ($contador2 == 6){
                                echo "<td> ".$menorsal2." a ".$mayorsal2."</td>";
                            }
                            if ($contador2 == 7){
                                echo "<td>Variado</td>";
                            }
                            if ($contador2 == 8){
                                echo "<td>Variado</td>";
                            }
                            if ($contador2 == 9){
                                echo "<td>Variado</td>";
                            }
                            if ($contador2 == 10){
                                echo "<td>Variado</td>";
                            }
                            echo "  </tr>";
                            $contador2++;
                        }
                    
                    echo "</table>";

                    echo "<br>";
                    echo "<h4>Datos de $nombre.</h4>";
                    echo "<table id='tblDatos' class='table table-bordered table-hover'>";
                    echo "<thead><tr>";

                    foreach($encabezados as $titulo){
                        echo "<td>".$titulo."</td>";
                    }

                    echo "</tr></thead><tbody>";

                    for ($i=0; $i < 100 ; $i++) {
                        echo "<tr>";
                        foreach($contenido[$i] as $datos){
                            echo "<td>".$datos."</td>";
                        }
                        echo "</tr>";
                    }

                    echo "<tbody></table>";



                    echo "</table>";

                    echo "<br>";
                    echo "<h4>Datos de $nombre2.</h4>";
                    echo "<table id='tblDatos2' class='table table-bordered table-hover'>";
                    echo "<thead><tr>";

                    foreach($encabezados2 as $titulo){
                        echo "<td>".$titulo."</td>";
                    }

                    echo "</tr></thead><tbody>";

                    for ($i=0; $i < 100 ; $i++) {
                        echo "<tr>";
                        foreach($contenido2[$i] as $datos){
                            echo "<td>".$datos."</td>";
                        }
                        echo "</tr>";
                    }

                    echo "<tbody></table>";

                }//fin del else (solo si el archivo fue procesado)
                echo "<br>";
                echo "<br>";
                echo "<br>";
                echo "<div>";
                echo "<tr>";
                echo "<table id='tblDatos' class='table table-bordered table-hover'><h4 style  = 'color: black; font-weight: bold;'> datos absolutos obtenidos del archivo $nombre</h4>";
                echo "<td colspan='7' style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Distribución Sexo, Estado Civil</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Sexo</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Absoluto</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Union Libre</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Casad@</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Divorciad@</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Solter@</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Viud@</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td style='text-align: center; color: black; font-weight: bold;'>Femenino</td>";
                echo "<td style='text-align: center; color: black;'>$fem1</td>";
                echo "<td style='text-align: center; color: black;'>$Funion1</td>";
                echo "<td style='text-align: center; color: black;'>$Fcasado1</td>";
                echo "<td style='text-align: center; color: black;'>$Fdivorciado1</td>";
                echo "<td style='text-align: center; color: black;'>$Fsoltero1</td>";
                echo "<td style='text-align: center; color: black;'>$Fviudo1</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td style='text-align: center; color: black; font-weight: bold;'>Masculino</td>";
                echo "<td style='text-align: center; color: black;'>$mas1</td>";
                echo "<td style='text-align: center; color: black;'>$Munion1</td>";
                echo "<td style='text-align: center; color: black;'>$Mcasado1</td>";
                echo "<td style='text-align: center; color: black;'>$Mdivorciado1</td>";
                echo "<td style='text-align: center; color: black;'>$Msoltero1</td>";
                echo "<td style='text-align: center; color: black;'>$Mviudo1</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td style='text-align: center; color: black; font-weight: bold;'>Observaciones</td>";
                echo "<td style='text-align: center; color: black;'>".$fem1 + $mas1."</td>";
                echo "</tr>";

                // segundo grafico tabla 1
                echo "<div>";
                echo "<tr>";
                echo "<table id='tblDatos' class='table table-bordered table-hover'><h4 style  = 'color: black; font-weight: bold;'> datos relativos obtenidos del archivo $nombre</h4>";
                echo "<td colspan='7' style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Distribución Sexo, Estado Civil</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Sexo</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Relativo</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Union Libre</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Casad@</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Divorciad@</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Soler@</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Viud@</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td style='text-align: center; color: black; font-weight: bold;'>Femenino</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($fem1 /($fem1 + $mas1)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Funion1/($fem1 + $mas1))/($fem1/($fem1 + $mas1)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Fcasado1/($fem1 + $mas1))/($fem1/($fem1 + $mas1)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Fdivorciado1/($fem1 + $mas1))/($fem1/($fem1 + $mas1)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Fsoltero1/($fem1 + $mas1))/($fem1/($fem1 + $mas1)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Fviudo1/($fem1 + $mas1))/($fem1/($fem1 + $mas1)) * 100, 2) ." %</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td style='text-align: center; color: black; font-weight: bold;'>Masculino</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($mas1 /($fem1 + $mas1)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Munion1/($fem1 + $mas1))/($fem1/($fem1 + $mas1)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Mcasado1/($fem1 + $mas1))/($fem1/($fem1 + $mas1)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Mdivorciado1/($fem1 + $mas1))/($fem1/($fem1 + $mas1)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Msoltero1/($fem1 + $mas1))/($fem1/($fem1 + $mas1)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Mviudo1/($fem1 + $mas1))/($fem1/($fem1 + $mas1)) * 100, 2) ." %</td>";
                echo "</tr>";


                echo "</table>";
                echo"</div>";

                // segundo dos cuadros de comparacion
                echo "<br>";
                echo "<br>";
                echo "<br>";
                echo "<div>";
                echo "<tr>";
                echo "<table id='tblDatos' class='table table-bordered table-hover'><h4 style  = 'color: black; font-weight: bold;'> datos absolutos obtenidos del archivo $nombre2</h4>";
                echo "<td colspan='7' style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Distribución Sexo, Estado Civil</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Sexo</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Absoluto</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Union Libre</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Casad@</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Divorciad@</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Soler@</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Viud@</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td style='text-align: center; color: black; font-weight: bold;'>Femenino</td>";
                echo "<td style='text-align: center; color: black;'>$fem2</td>";
                echo "<td style='text-align: center; color: black;'>$Funion2</td>";
                echo "<td style='text-align: center; color: black;'>$Fcasado2</td>";
                echo "<td style='text-align: center; color: black;'>$Fdivorciado2</td>";
                echo "<td style='text-align: center; color: black;'>$Fsoltero2</td>";
                echo "<td style='text-align: center; color: black;'>$Fviudo2</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td style='text-align: center; color: black; font-weight: bold;'>Masculino</td>";
                echo "<td style='text-align: center; color: black;'>$mas2</td>";
                echo "<td style='text-align: center; color: black;'>$Munion2</td>";
                echo "<td style='text-align: center; color: black;'>$Mcasado2</td>";
                echo "<td style='text-align: center; color: black;'>$Mdivorciado2</td>";
                echo "<td style='text-align: center; color: black;'>$Msoltero2</td>";
                echo "<td style='text-align: center; color: black;'>$Mviudo2</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td style='text-align: center; color: black; font-weight: bold;'>Observaciones</td>";
                echo "<td style='text-align: center; color: black;'>".$fem2 + $mas2."</td>";
                echo "</tr>";

                // segundo grafico tabla 2
                echo "<div>";
                echo "<tr>";
                echo "<table id='tblDatos' class='table table-bordered table-hover'><h4 style  = 'color: black; font-weight: bold;'> datos relativos obtenidos del archivo $nombre2</h4>";
                echo "<td colspan='7' style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Distribución Sexo, Estado Civil</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Sexo</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Relativos</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Union Libre</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Casad@</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Divorciad@</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Soler@</td>";
                echo "<td style='text-align: center; background-color: beige; color: black; font-weight: bold;'>Viud@</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td style='text-align: center; color: black; font-weight: bold;'>Femenino</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($fem2 /($fem2 + $mas2)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Funion2/($fem2 + $mas2))/($fem2/($fem2 + $mas2)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Fcasado2/($fem2 + $mas2))/($fem2/($fem2 + $mas2)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Fdivorciado2/($fem2 + $mas2))/($fem2/($fem2 + $mas2)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Fsoltero2/($fem2 + $mas2))/($fem2/($fem2 + $mas2)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Fviudo2/($fem2 + $mas2))/($fem2/($fem2 + $mas2)) * 100, 2) ." %</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td style='text-align: center; color: black; font-weight: bold;'>Masculino</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($mas2 /($fem2 + $mas2)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Munion2/($fem2 + $mas2))/($fem2/($fem2 + $mas2)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Mcasado2/($fem2 + $mas2))/($fem2/($fem2 + $mas2)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Mdivorciado2/($fem2 + $mas2))/($fem2/($fem2 + $mas2)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Msoltero2/($fem2 + $mas2))/($fem2/($fem2 + $mas2)) * 100, 2) ." %</td>";
                echo "<td style='text-align: center; color: black;'>".number_format(($Mviudo2/($fem2 + $mas2))/($fem2/($fem2 + $mas2)) * 100, 2) ." %</td>";
                echo "</tr>";


                echo "</table>";
                echo "<br>";
                echo "<br>";
                echo "<br>";
                echo"<div>";
                echo '
                <div>
                <h4>Info obtenido de '.$nombre.'</h4>
                <div id="chart_divF1" class="col-md-6"></div>
                <div id="chart_divM1" class="col-md-6"></div>
                </div>
                ';

                echo "<br>";
                echo "<br>";
                echo "<br>";
                echo '
                <div>
                <h4>Info obtenido de '.$nombre.'</h4>
                <div id="chart_divF2" class="col-md-6"></div>
                <div id="chart_divM2" class="col-md-6"></div>
                </div>
                ';
                echo"</div>";
            ?> 
                
        
		</div>
            &nbsp;

        <div class= "linea_sep acomodarestilo">
            <h3 class= "acomodarestilo" style= "color:black">Criterio del grupo:</h3>
            <h3 class= "acomodarestilo" style= "color: black">
                En el apartado de los gráficos, se analiza diferentes conceptos. Lo primero a 
                evaluar es el estado civil presente en los sexos 'Masculino' y 'Femenino'. 
                Para esto se toma en cuenta los datos de dichas personas, capturados en el excel de 
                'CensoNacional_entrenamiento' y 'CensoNacional_prueba', estos documentos permiten saber el estado 
                civil actual, además de su sexo respectivo.
                En los gráficos se puede notar los diferentes valores porcentuales tanto para hombres 
                como para mujeres, esto recae debido a la información almacenada en dichos documentos. 
                En el documentos de 'CensoNacional_entrenamiento', son datos
                poco creíbles o ficticios, ya que no son tomados de una persona como tal. Entonces, 
                esto genera cierta diferencia en el momento que se muestra el gráfico del archivo 
                'CensoNacional_prueba', ya que estos sí son datos reales, existentes, 
                por lo que hay ciertos cambios en los valores porcentuales.
            </h3>
        </div>
	</main>

	<footer class="row pie">
		<?php
			include_once("segmentos/pie.inc");
		?>
	</footer>

	<!-- jQuery necesario para los efectos de bootstrap -->
    <script src="formatos/bootstrap/js/jquery-1.11.3.min.js"></script>
    <script src="formatos/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#tblDatos').dataTable({
                "language":{
                    "url": "dataTables.Spanish.lang"
                }
            });
        });
        $(document).ready(function(){
            $('#tblDatos2').dataTable({
                "language":{
                    "url": "dataTables.Spanish.lang"
                }
            });
        });
    </script>
    <script>
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChartF1);
                google.charts.setOnLoadCallback(drawChartM1);
                google.charts.setOnLoadCallback(drawChartF2);
                google.charts.setOnLoadCallback(drawChartM2);
                function drawChartF1(){
                    var data = google.visualization.arrayToDataTable(<?php echo json_encode($datosgraficoF); ?>);
                
                var options = {
                    width: 700,
                    height: 590,
                    title: 'Distribución de género Femenino por Estado Civil',
                    pieHole: 0, // Agujero en el medio (0 para un círculo completo)
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('chart_divF1'));
                  chart.draw(data, options);
                }
                function drawChartM1(){
                    var data = google.visualization.arrayToDataTable(<?php echo json_encode($datosgraficoM); ?>);
                
                var options = {
                    width: 700,
                    height: 590,
                    title: 'Distribución de género Masculino por Estado Civil',
                    pieHole: 0, // Agujero en el medio (0 para un círculo completo)
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('chart_divM1'));
                  chart.draw(data, options);
                }

                function drawChartF2(){
                    var data = google.visualization.arrayToDataTable(<?php echo json_encode($datosgraficoF2); ?>);
                
                var options = {
                    width: 700,
                    height: 590,
                    title: 'Distribución de género Femenino por Estado Civil',
                    pieHole: 0, // Agujero en el medio (0 para un círculo completo)
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('chart_divF2'));
                  chart.draw(data, options);
                }
                function drawChartM2(){
                    var data = google.visualization.arrayToDataTable(<?php echo json_encode($datosgraficoM2); ?>);
                
                var options = {
                    width: 700,
                    height: 590,
                    title: 'Distribución de género Masculino por Estado Civil',
                    pieHole: 0, // Agujero en el medio (0 para un círculo completo)
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('chart_divM2'));
                  chart.draw(data, options);
                }
                  </script>
</body>
</html>










