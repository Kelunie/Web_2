<?php
    $userinfo = $this->userModel->getUserInfo($_SESSION['usuario']);
    $iduser = $userinfo->id;
    $nam = $userinfo->nombre;
    $fechaActual = date('Y-m-d H:i:s');
    print_r($iduser);
    
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
            echo '<h1 class="mt-4">Posts de ' . $data['nam'] . '</h1>';
            echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPostModal">
                    Agregar Post
                </button>';

                echo '
                <div class="modal fade" id="addPostModal" tabindex="-1" role="dialog" aria-labelledby="addPostModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addPostModalLabel">Agregar Post</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="'.urlRoot.'/posts/addpost.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="'.$iduser.'">
                                    <input type="hidden" name="id" value="'.$fechaActual.'">
                                    <div class="form-group">
                                        <label for="title">Titulo</label>
                                        <input type="text" class="form-control" name="title" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="content">Contenido</label>
                                        <textarea class="form-control" name="content"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="image"></label>
                                        <input type="file" class="form-control-file" name="image">
                                    </div>
                                    <input type="submit" name="agregar" value="Agregar Post" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';

            if (empty($data['userBlog'])) {
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
                foreach ($data['userBlog'] as $post) {
                    echo '<tr>';
                    echo '<td><a class="" href="'.urlRoot.'/pages/editar?id='.$post->id.'">'.$post->titulo.'</a></td>';
                    echo '<td>' . $post->contenido . '</td>';
                    echo '<td><img src="data:image/jpeg;base64,' . base64_encode($post->imagen) . '" alt="Imagen" width="200" height="150"></td>';

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
