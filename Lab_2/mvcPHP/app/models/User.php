<?php
	class User{
		private $db;
				
		//create database object
		public function __construct(){
			$this->db = new Database;
		}
				
		//retrive all user data
		public function getUsers(){
			$this->db->query('select * from usuarios');
			$regis = $this->db->resultSet();
			return $regis;
		}
        //retrieve an user data, loging function
        public function login($data){
            //create retrieve sentence
            $this->db->query('select * from usuarios where nombre = :nomb');
            
            //bind sentence with variable
            $this->db->bind(':nomb',$data['usuario']);
            
            //retrieve a single datarow
            $tupla = $this->db->singleRow();
            
            //update local variable with contrasena field from single row 
            $contra = $tupla->contrasena;        
            
            //validate passwords (retrieved pass with param pass)
            if(password_verify($data['contra'], $contra)){
                return $tupla;    
            }else{
                return false;
            }
        }
        
        // register new user function
        public function register($data){
            //create insert sentence
            $this->db->query('insert into usuarios(nombre,contrasena)values(:nomb,:cont)');
            
            //bind sentence with variable
            $this->db->bind(':nomb',$data['usuario']);
            $this->db->bind(':cont',$data['contra']);
            
            //execute SQL sentence
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }                            
        }// end register user function

        public function getPosts()
    {
        $this->db->query('SELECT id, titulo, contenido, imagen FROM blogs');
        $posts = $this->db->resultSet();
        return $posts;
    }
    // Obtener los posts de un usuario por su ID
    public function getUserInfo($nombre) {
        $this->db->query('SELECT * FROM usuarios WHERE nombre = :nomb');
        $this->db->bind(':nomb', $nombre);
        $in = $this->db->singleRow();
        return $in;
    }
    public function getUserPost($id) {
        $this->db->query('SELECT * FROM blogs WHERE usuario = :id');
        $this->db->bind(':id', $id);
        $post = $this->db->resultSet();
        return $post;
    }
    public function getPostById($post_id) {
        // Preparar la consulta SQL para seleccionar un post por su ID
        $this->db->query('SELECT * FROM blogs WHERE id = :post_id');
        
        // Enlazar el parámetro :post_id con el valor proporcionado
        $this->db->bind(':post_id', $post_id);
        
        // Ejecutar la consulta
        $post = $this->db->singleRow();
        
        return $post;
    }
    
    public function updatePostById($post_id, $titulo, $contenido, $imagen) {
        // Preparar la consulta SQL para actualizar un post por su ID
        $this->db->query('UPDATE blogs SET titulo = :titulo, contenido = :contenido, imagen = :imagen WHERE id = :post_id');
        
        // Enlazar los parámetros con los valores proporcionados
        $this->db->bind(':post_id', $post_id);
        $this->db->bind(':titulo', $titulo);
        $this->db->bind(':contenido', $contenido);
        $this->db->bind(':imagen', $imagen);
        
        // Ejecutar la consulta
        if ($this->db->execute()) {
            return true; // La actualización fue exitosa
        } else {
            return false; // La actualización falló
        }
    }
    public function getComentario($post_id) {
        // Preparar la consulta SQL para seleccionar comentarios de un post con nombres de usuarios
        $this->db->query('SELECT comentarios.*, usuarios.nombre AS nombre_usuario
                          FROM comentarios
                          INNER JOIN usuarios ON comentarios.usuario_id = usuarios.id
                          WHERE comentarios.blog_id = :post_id');
        
        // Enlazar el parámetro :post_id con el valor proporcionado
        $this->db->bind(':post_id', $post_id);
        
        // Ejecutar la consulta
        $comments = $this->db->resultSet();
        
        return $comments;
    }
    public function agregarComentario($blog_id, $usuario_id, $fecha, $contenido) {
        // Preparar la consulta SQL para insertar un nuevo comentario
        $this->db->query('INSERT INTO comentarios (blog_id, usuario_id, fecha, contenido) VALUES (:blog_id, :usuario_id, :fecha, :contenido)');
        
        // Enlazar los parámetros con los valores proporcionados
        $this->db->bind(':blog_id', $blog_id);
        $this->db->bind(':usuario_id', $usuario_id);
        $this->db->bind(':fecha', $fecha);
        $this->db->bind(':contenido', $contenido);
        
        // Ejecutar la consulta
        if ($this->db->execute()) {
            return true; // La actualización fue exitosa
        } else {
            return false; // La actualización falló
        }
    }
    
    public function addPost($iduser, $fecha, $titulo, $contenido, $imagen) {
    
        $this->db->query('insert into blogs (usuario, fecha, titulo, contenido, imagen)values(:iduser,:fecha,:titulo,:contenido,:imagen)');

        $this->db->bind(':iduser', $iduser);
        $this->db->bind(':fecha', $fecha);
        $this->db->bind(':titulo', $titulo);
        $this->db->bind(':contenido', $contenido);
        $this->db->bind(':imagen', $imagen);

        if ($this->db->execute()) {
            return true; // La actualización fue exitosa
        } else {
            return false; // La actualización falló
        }

	}
}
?>