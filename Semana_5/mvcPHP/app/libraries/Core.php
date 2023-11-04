<?php
	class Core{
		//declare properties
		protected $currentController = 'Pages';
		protected $currentMethod = 'index';
		protected $params = [];
			
		//declare class constructor
		public function __construct(){
			$url = $this->getUrl();
				
			//$url[0] is a controller
			if(isset($url[0])){
				if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
					//set the new controller
					$this->currentController = ucwords($url[0]);

					//unset first array position
					unset($url[0]);
				}
			}
				
			//call the require controller
			require_once('../app/controllers/' . $this->currentController . '.php');
			$this->currentController = new $this->currentController;
				
			//evaluate method if exists
			if(isset($url[1])){
				if(method_exists($this->currentController, $url[1])){
					$this->currentMethod = $url[1];
						
					//unset second array position
					unset($url[1]);
				}
			}
				
			//get parameters
			$this->params = $url ? array_values($url) : [];
				
			//callback params
			call_user_func_array([$this->currentController, 
								    $this->currentMethod], 
									$this->params);
				
		}//end constructor method
			
		//create function gerURL
		//if wrong access try to use $_GET[ 'url' ]
		public function getUrl(){
			if(isset($_GET['page'])){
				$url = rtrim($_GET['page'], '/');
					
				//allows to filter variables as number or string
				$url = filter_var($url, FILTER_SANITIZE_URL);
					
				//chop variable into an array
				$url = explode('/',$url);
					
				return $url;                
			}//end if
		}//end method
			
	}//end class
?>