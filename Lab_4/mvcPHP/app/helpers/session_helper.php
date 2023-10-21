<?php
			//open session 
			session_start();
			
			//validates if variable of session is setted
			function isLoggedIn(){
				if(isset($_SESSION['usuario'])){
					return true;
				}else{
					return false;
				}
			}   
		?>