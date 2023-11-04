<?php
			class Users extends Controller {
				public function __construct(){
					$this->userModel = $this->model('User');
				}

				//validates user
				public function login(){
					$data = [
						'usuario'   => '',
						'contra'    => '', 
						'userError' => '',
						'passError' => ''
					];
					
					//create [POST] proccess 
					if($_SERVER['REQUEST_METHOD']== 'POST'){
						$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
						$data = [                    
							'usuario'    => trim($_POST['txtUsua']),
							'contra'     => trim($_POST['txtContra']),                    
							'userError'  => '',
							'passError'  => ''                
						];  
						
						//validate username data
						if(empty($data['usuario'])){
							$data['userError'] = 'El nombre del usuario es obligatorio';
						}
						
						//validate password data
						if(empty($data['contra'])){
							$data['passError'] = 'La contraseña es obligatoria';
						}
						
						//validate not error found
						if((empty($data['userError'])) && (empty($data['passError']))){
							//retrieve data user
							$user = $this->userModel->login($data);
							
							//register new user
							if($user){
								$this->createSession($user);                        
							}else{
								$data['passError'] = 'Los datos de ingreso son incorrectos. Favor verificar';
							}    
						}
					}//end post declaration           
					
					$this->view('users/login',$data);
				}
				
				//register a new user
				public function register(){
					$data = [                
						'usuario'    => '',
						'contra'     => '',
						'recontra'   => '',
						'userError'  => '',
						'passError'  => '',
						'passError2' => ''
						
					];
					
					//create [POST] proccess 
					if($_SERVER['REQUEST_METHOD']== 'POST'){
						$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
						$data = [                    
							'usuario'    => trim($_POST['txtUsua']),
							'contra'     => trim($_POST['txtContra']),
							'recontra'   => trim($_POST['txtContra2']),
							'userError'  => '',
							'passError'  => '',
							'passError2' => ''
						
						];  
						
						//crete validate patterns						
						$validaNombre = '/^[a-zA-Z]*$/';
						$validaContra = '/^[a-zA-Z0-9]*$/';
						
						//validate username data
						if(empty($data['usuario'])){
							$data['userError'] = 'El nombre del usuario es obligatorio';
						}elseif(!preg_match($validaNombre, $data['usuario'])){
							$data['userError'] = 'El nombre de usuario solo puede contener letras';
						}
						
						//validate password data
						if(empty($data['contra'])){
							$data['passError'] = 'La contraseña es obligatoria';
						}elseif(strlen($data['contra']) < 8){
							$data['passError'] = 'La contraseña debe tener al menos 8 caracteres';
						}elseif(!preg_match($validaContra, $data['contra'])){
							$data['passError'] = 'La contraseña debe tener al menos un número';
						}
						
						//validate confirm password data 
						if(empty($data['recontra'])){
							$data['passError2'] = 'La contraseña de confirmacion es obligatoria';
						}elseif(strlen($data['recontra']) < 8){
							$data['passError2'] = 'La contraseña de confirmacion debe tener al menos 8 caracteres';
						}elseif(!preg_match($validaContra, $data['recontra'])){
							$data['passError2'] = 'La contraseña de confirmacion debe tener al menos un número';
						}elseif($data['contra'] != $data['recontra']){
							$data['passError2'] = 'Las contraseñas no coinciden, favor confirmar sus datos';
						}
										
						//validate not error found
						if((empty($data['userError'])) && (empty($data['passError'])) && (empty($data['passError2']))){
							//hash password
							$data['contra'] = password_hash($data['contra'],PASSWORD_DEFAULT);
							
							//register new user
							if($this->userModel->register($data)){
								header('location: ' . urlRoot . '/users/login');
							}else{
								die('Algo salío mal...!');
							}                    
						}
					}//end post method
					$this->view('users/register',$data);
					
				}//end register function
				
				public function createSession($user){
					session_start();
					$_SESSION['autenticado'] = 'Si';
					$_SESSION['usuario'] = $user->nombre;
					header('location: ' . urlRoot . '/pages/index');
				}
                public function logout(){
                    unset($_SESSION['autenticado']);
                    unset($_SESSION['usuario']);
                    header('location: ' . urlRoot . '/pages/index');
                }
				 
			}

		?>