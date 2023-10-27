<?php
// creamos las variables para buscar la información (ya que $_SESSION no trae el id, lo haremos con una función)
$user = $this->userModel->getUserInfo($_SESSION['usuario']);
$id = $user->id;
$nam = $user->nombre;

// ahora hacemos la consulta de la tabla de blogs
$userBlog = $this->userModel->getUserPost($id);
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
            echo '<h1 class="mt-4">Posts de ' . $nam . '</h1>';
            echo '<a href="crear_post.php" class="btn btn-primary">Agregar Post</a>';

            if (empty($userBlog)) {
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
                foreach ($userBlog as $post) {
                    echo '<tr>';
                    echo '<td><a href="editar_post.php?id=' . $post->id . '">' . $post->titulo . '</a></td>';
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
