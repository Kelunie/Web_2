<?php

// Verificar si el usuario ha iniciado sesión
if (isLoggedIn()) {
    $user = new User();
    $user_id = $_SESSION['user_id']; // Suponiendo que $_SESSION['user_id'] contiene el ID del usuario autenticado

    // Obtener la información del usuario actualmente autenticado
    $userInfo = $user->getUserInfo($user_id);

    // Obtener los posts del usuario actual
    $posts = $user->getUserPosts($user_id);

    // Resto del código de la página de perfil
} else {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header('Location: login.php');
    exit();
}
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
        <div class="container">
            <h1 class="mt-4">Perfil de Usuario: <?php echo $userInfo->nombre; ?></h1>

            <?php if (empty($posts)) : ?>
                <p>No hay posts disponibles para este usuario.</p>
            <?php else : ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Contenido</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $post) : ?>
                            <tr>
                                <td><?php echo $post->titulo; ?></td>
                                <td><?php echo $post->contenido; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </main>
    <footer class="col-12 linea_sep">
        <?php
        require_once(appRoot . '/views/includes/pie.php');
        ?>
    </footer>
</body>
</html>
