<?php
    session_start();
	header("Content-Type:application/json");
	header("Accept:application/json");

	$method = $_SERVER['REQUEST_METHOD'];
	$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

	switch ($method){
		case 'PUT':
			if(sizeof($request)==2){
				// update task
				if($request[1]=='task'){
					include_once("code/modtarea.inc");
				}
			}
			break;
	  	case 'POST':
			if(sizeof($request)==1){
				if($request[0]=='datos'){
					// register a new user
					include_once("code/datos.inc");
				}
			}else if(sizeof($request)==2){
				if($request[1]=='task'){
					// register a user task
					include_once("code/addtarea.inc");
				}
			}
			break;
	  	case 'GET':
			if(sizeof($request)==1){
				if($request[0]=='estudiante'){
					include_once("code/estudiante.inc");
				}elseif($request[0]=='estadisticas'){
                    include_once("code/estadistica.inc");
			    }elseif($request[0]=='elevar'){
                    include_once("code/elevar.inc");
                }
			}elseif(sizeof($request)==2){
                $_SESSION['val']=$request[1];
                if($request[0]==''){
                    deliver_response(204,"No Content","Your request is empty.");
                }elseif($request[0]=='elevar'){
                    include_once("code/3.inc");
                }elseif($request[0]=='entero'){
                    include_once("code/entero.inc");
                }
                else{
                    deliver_response(204,"No Content","Your request is empty.");
                }
            }
            else{
				deliver_response(204,"No Content","Your request is empty.");
			}
            
			break;
	   	case 'DELETE':
			if(sizeof($request)==2){
				if($request[1]=='task'){
					// remove task from todo list
					include_once("code/deltarea.inc");
				}
			}
			break;
	    default:
			deliver_response(405,"Method not allowed","");
			break;
	}// switch end

	/*----------------------------------------------------------------------*/
	/*Declarate http response functions or methods
	/*----------------------------------------------------------------------*/
	function deliver_response($status, $status_message,$data){
		header("HTTP/1.1 $status $status_message");

		$response["status"]=$status;
		$response["status_message"]=$status_message;
		$response["data"]=$data;
		$response["author"]="Kelunie";

		$json_response=json_encode($response);
		echo $json_response;
	}
?>









