<?php
/**
 * load model and view
 */
class Controller
{	
	public function model($model){
		require_once '../app/models/' . $model . '.php';
		// Instatiate new model
		return new $model;
	}

	public function view($view, $data = []){
		if (file_exists('../app/views/' . $view . '.php')) {
			require_once '../app/views/' . $view . '.php';
		}
		else 
			die('View do not exist');
	}
}