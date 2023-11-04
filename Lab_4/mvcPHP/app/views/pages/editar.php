<?php
    // revisamos si es usuario que esta logeado es dueño del post
    $userinfo = $this->userModel->getUserInfo($_SESSION['usuario']);
    $iduser = $userinfo->id;
    $nam = $userinfo->nombre;

    if (isset($_POST['editar'])) {
        // Obtenemos los datos del formulario
        $idpost = $_POST['id'];
        $titulo = $_POST['title'];
        $contenido = $_POST['content'];
        $imagen = file_get_contents($_FILES['image']['tmp_name']);

        // Llama a tu función de actualización de post con los datos proporcionados
        $resultado = $this->userModel->updatePostById($idpost, $titulo, $contenido, $imagen);

        if ($resultado) {
            // La actualización fue exitosa
            echo "La actualización se realizó correctamente";
            header('Location: ' .urlRoot.'/pages/perfil');
        } else {
            // La actualización falló
            echo "La actualización no se pudo completar";
        }
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
            if ($iduser == $data['usuario']) {
                echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editPostModal">
                    Edit Post
                </button>';

                echo '
                <div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editPostModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPostModalLabel">Editar Post</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="editar" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="'.$data["idpost"].'">
                                    
                                    <div class="form-group">
                                        <label for="title">Titulo</label>
                                        <input type="text" class="form-control" name="title" value="'.$data["titulo"].'">
                                    </div>

                                    <div class="form-group">
                                        <label for="content">Contenido</label>
                                        <textarea class="form-control" name="content">'.$data["contenido"].'</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="image"></label>
                                        <img src="data:image/jpeg;base64,' . base64_encode($data["imagen"]) . '" alt="Imagen" width="200" height="150">
                                        <input type="file" class="form-control-file" name="image">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="editar">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';

            }else{
                print_r('No es dueño del post');
            }
            echo '<div class="container">';
            echo '<h1 class="mt-4">Post '.$data['titulo'].'</h1>';
            echo '<table class="table table-bordered">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Título</th>';
                echo '<th>Contenido</th>';
                echo '<th>Imagen</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                echo '<tr>';
                echo '<td>' . $data['titulo']. '</td>';
                echo '<td>' . $data['contenido']. '</td>';
                echo '<td><img src="data:image/jpeg;base64,' . base64_encode($data['imagen']) . '" alt="Imagen" width="200" height="150"></td>';
                echo'</tr>';
                echo '</tbody>';
                echo '</table>';
            
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