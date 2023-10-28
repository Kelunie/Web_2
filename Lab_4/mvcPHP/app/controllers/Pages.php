<?php
class Pages extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index(){
        $user = $this->userModel->getUsers(); 
        
        $data = ['title' => 'Página principal',
                 'name'  => 'Kelunie',
                 'users' => $user];
        
        $this->view('pages/index', $data);
    }

    public function about()
    {
        $this->view('pages/about');
    }
    public function perfil(){
        // creamos las variables para buscar la información (ya que $_SESSION no trae el id, lo haremos con una función)
        $user = $this->userModel->getUserInfo($_SESSION['usuario']);
        $id = $user->id;
        $nam = $user->nombre;

        // ahora hacemos la consulta de la tabla de blogs
        $userBlog = $this->userModel->getUserPost($id);
        $data = ['nam' => $nam, 'userBlog' => $userBlog];

        $this->view('pages/perfil', $data);
        return $data;
    }
    public function editar(){
        $info = $this->userModel->getPostById($_GET['id']);
        $idpost = $info->id;
        $titulo = $info->titulo;
        $contenido = $info->contenido;
        if (!empty($info->imagen)) {
            $imagen = $info->imagen;
        } else {
            $imagen = null; // Define $imagen como nulo si la ruta está vacía
        }
        $usuario = $info->usuario;
        $data = ['titulo' => $titulo, 'idpost' => $idpost, 'contenido' => $contenido, 'imagen' => $imagen
        , 'usuario' => $usuario];
        $this->view('pages/editar', $data);
    }
}
?>