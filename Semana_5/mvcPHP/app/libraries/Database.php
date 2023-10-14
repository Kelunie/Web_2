<?php
	class Database{
		//declare private properties
		private $host = db_Servidor;
		private $name = db_Basedato;
		private $user = db_Usuario;
		private $pass = db_Contra;
				
		//create local dababase object
		private $coman;
		private $conex;
		private $error;
				
		//create default constructor
		public function __construct(){
			//create string conecction
			$auxConex = 'mysql:host=' . $this->host . ';dbname=' . $this->name;
					
			//create connection properties into array
			$opciones = array(PDO::ATTR_PERSISTENT => true,
								PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
					
			//try to crete live connection or retrive error connection
			try{
				$this->conex = new PDO($auxConex, $this->user, $this->pass, $opciones);
			}catch(PDOException $e){
				$this->error = $e->getMessage();
				echo $this->error;
			}            
		}
				
		//create SQL instruction
		public function query($auxSql){
			$this->coman = $this->conex->prepare($auxSql); 
		}
				
		//create bind between SQL sentence and required params 
		public function bind($parameter, $value, $type = null){
			//identifying param type
			switch(is_null($type)){
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break; 
				default:
					$type = PDO::PARAM_STR;
			}
					
			//binds internal SQL param with external param
			$this->coman->bindValue($parameter, $value, $type);
		}
				
				
		//execute SQL instruction
		public function execute(){
			return $this->coman->execute();
		}
				
		//retrieves a dataset
		public function resultSet(){
			$this->execute();
			return $this->coman->fetchAll(PDO::FETCH_OBJ);
		}
				
		//retrieves a single datarow
		public function singleRow(){
			$this->execute();
			return $this->coman->fetch(PDO::FETCH_OBJ);
		}

		//recoups the number of rows retrieved with SQL sentence
		public function rowCount(){
			$this->execute();
			return $this->coman->rowCount();
		}
	}
?>