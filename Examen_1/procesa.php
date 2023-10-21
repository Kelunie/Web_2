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
                    echo "<h4>Estructura.</h4>";
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
                    
                    echo "</table>";

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
                    echo "<h4>Datos.</h4>";
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

                }//fin del else (solo si el archivo fue procesado)
            ?>
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
    </script>
</body>
</html>










