<?php
    // Nuevos datos para la tabla sin la edad
    $datos = array(
        array('AARÓN', 'CONTRERAS ALVARADO', 'Cerebro'),
        array('YENDRY', 'MORERA CARMONA', 'Coordinador'),
        array('JUAN JOSE', 'VÁSQUEZ SÁNCHEZ', 'Impulsor'),
        array('CALEB', 'RODRIGUEZ CORDERO', 'Implementador'),
        array('DANIEL', 'OBANDO NAVARRO', 'Finalizador')
    );
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		require_once(appRoot . '/views/includes/enca.php');
	?>
	<title><?php echo siteName; ?></title>
    <style>
        
        table {
            margin: 0 auto;
            background-color: white;
            box-shadow: 3px 3px 5px 0px #888;
        }

        
        td {
            padding: 10px;
            text-align: center;
            vertical-align: middle;
        }

        tr{
            padding: 10px;
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body class="container">
	<header class="col-12">
		<?php
			require_once(appRoot . '/views/includes/menu.php');
		?>        
	</header>
	<main class="col-12 linea_sep">
        <h2>Miembros del grupo:</h2>
        <br>
    <table border="0">
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Rol</th>
        </tr>

        <?php
        // Recorrer los datos y crear filas de la tabla
        foreach ($datos as $fila) {
            echo '<tr>';
            foreach ($fila as $valor) {
                echo '<td>' . $valor . '</td>';
            }
            echo '</tr>';
        }
        ?>
    </table>				
	</main>
	<footer class="col-12 linea_sep">
		<?php
			require_once(appRoot . '/views/includes/pie.php');
		?>
	</footer>
</body>
</html>