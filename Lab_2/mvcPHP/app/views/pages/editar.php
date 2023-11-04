<?php
    // revisamos si es usuario que esta logeado es dueño del post
    $userinfo = $this->userModel->getUserInfo($_SESSION['usuario']);
    $iduser = $userinfo->id;
    $nam = $userinfo->nombre;
    $idpost= $_GET['id'];
    $fechaActual = date('Y-m-d H:i:s');

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
    if (isset($_POST['comentar'])) {
        // Obtén los datos del formulario de comentarios
        $idpost = intval($_POST['idpost']);
        $usuario_id = intval($_POST['usuarioid']);
        $fec = $_POST['fecha'];
        $contenido = strval($_POST['contenido']);
    
        // Llama a tu función para agregar comentarios
        print_r($idpost);
        print_r($usuario_id);
        print_r($fec);
        print_r($contenido);
        #$resultado = $this->userModel->agregarComentario($idpost, $usuario_id, $fec, $contenido);
    
        /*if ($resultado) {
            // El comentario se agregó con éxito
            echo "El comentario se agregó correctamente";
        } else {
            // El comentario no se pudo agregar
            echo "No se pudo agregar el comentario";
        }*/
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>
<body class="container">
    <header class="col-12">
        <?php
        require_once(appRoot . '/views/includes/menu.php');
        ?>
        <style>
            /* Estilo personalizado para la caja de comentarios */
        .comentario-box {
            background-color: #f0f0f0; /* Cambia este valor al color que desees */
            border: 1px solid #ddd; /* Añade un borde si lo deseas */
            padding: 10px; /* Espaciado interno */
            margin-bottom: 10px; /* Espaciado inferior */
        }

        </style>
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
                echo '</div>';
                echo '<div class="container mt-3">';
                echo '<div class="comentario-box">'; // Agrega la clase comentario-box
                echo '<div class="card-body">';
                echo '<h5 class="card-title" style="text-align: right;"> ' . $nam . ' <i class="fas fa-user"></i></h5>';
                echo '<form action="comentar" method="post" enctype="multipart/form-data">';
                echo '<input type="hidden" name="idpost" value="' . $idpost . '">';
                echo '<input type="hidden" name="usuarioid" value="' . $iduser . '">';
                echo '<input type="hidden" name="fecha" value="' . $fechaActual . '">';
                echo '<div class="form-group">';
                echo '<label for="contenido">Contenido</label>';
                echo '<textarea class="form-control" name="contenido" placeholder="Escribe tu comentario" rows="5" maxlength="500" required></textarea>';
                echo '</div>';
                echo '<button type="submit" class="btn btn-primary" name="comentar">Agregar Comentario</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

                foreach ($data['com'] as $comentario) {
                    echo '<div class="container mt-3">';
                    echo '<div class="comentario-box">'; // Agrega la clase comentario-box
                    echo '<div class="card-body">';
                    
                    // Agrega un ícono de usuario de Font Awesome
                    echo '<h5 class="card-title"><i class="fas fa-user"></i> ' . $comentario->nombre_usuario . '</h5>';
                    echo '<br>';
                    echo '<p class="card-text">' . $comentario->contenido . '</p>';
                    echo '<p class="card-text" style="text-align: right;">Posted: ' . $comentario->fecha . '</p>';
                    // ... otros campos de comentario que quieras mostrar
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            
        } else {
            echo "Por favor autentíquese antes de continuar.";
        }
        ?>
    </main>
    <footer class="col-12 linea_sep">
        <?php
        require_once(appRoot . '/views/includes/pie.php');
        ?>;
    </footer>
</body>
</html>