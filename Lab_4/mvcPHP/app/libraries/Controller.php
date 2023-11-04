<?php
class Controller
{

	//load the model from file
	public function model($model)
	{
		require_once('../app/models/' . $model . '.php');

		//instance a new model
		return new $model();
	}

	//load the view from file
	public function view($view, $data = [])
	{
		if (file_exists('../app/views/' . $view . '.php')) {
			require_once('../app/views/' . $view . '.php');
		} else {
			die("View does not exists...!");
		}
	}
}
?>