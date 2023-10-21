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
    public function getUserPosts($user_id) {
        $this->db->query('SELECT id, titulo, contenido, imagen FROM blogs WHERE usuario = :user_id');
        $this->db->bind(':user_id', $user_id);
        $posts = $this->db->resultSet();
        return $posts;
    }
    public function getUserInfo($user_id) {
        $this->db->query('SELECT * FROM usuarios WHERE id = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->singleRow();
    }

	}
?>