<?php
$user = new User();

// Obtener los posts de los usuarios
$posts = $user->getPosts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once(appRoot . '/views/includes/enca.php');
    ?>
    <title><?php echo siteName; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container">
    <header class="col-12">
        <?php
        require_once(appRoot . '/views/includes/menu.php');
        ?>        
    </header>
    <main class="col-12 linea_sep">
        <?php
        if (isLoggedIn()) {
            echo '<div class="container">';
            echo '<h1 class="mt-4">Posts de Usuarios</h1>';

            if (empty($posts)) {
                echo '<p>No hay posts disponibles.</p>';
            } else {
                echo '<table class="table table-bordered">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Título</th>';
                echo '<th>Contenido</th>';
                echo '<th>Imagen</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($posts as $post) {
                    echo '<tr>';
                    echo '<td>' . $post->titulo . '</td>';
                    echo '<td>' . $post->contenido . '</td>';
                    echo '<td>' . $post->imagen . '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            }

            echo '</div>';
        } else {
            echo "Por favor autentíquese antes de continuar.";
        }
        ?>
    </main>
    <footer class="col-12 linea_sep">
        <?php
        require_once(appRoot . '/views/includes/pie.php');
        ?>
    </footer>
</body>
</html>
