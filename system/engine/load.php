<?php 

final class Load{

	private $controller;

	private $request;

	private $response;

	private $cookie;

	function __construct($request = '', $response = '', $cookie = ''){
		$this->request = $request;
		$this->response = $response;
		$this->cookie = $cookie;
	}

	public function SetParentController(&$controller){
		$this->controller = $controller;
	}
	
	public function Model($model){
		$modelName = strtolower($model);
		$file  = 'mvc/model/' . $modelName . '.php';

		$pathArray = explode('/', $model);

		if(empty($pathArray)){
			$newModelName = $modelName;
			$cleanModelName = $modelName;
		} else {
			$cleanModelName = end($pathArray);
			$newModelName = implode('_', $pathArray);
		}
		
		$originModelName = $cleanModelName . 'model';
		$newModelName = preg_replace('/[^a-zA-Z0-9_]/', '', 'model_'.$newModelName);

		if (file_exists($file)) { 
			include_once($file);
			$this->controller->$newModelName = new $originModelName(new Load);
		} else {
			trigger_error('Could not load model: ' . $model . '!');
			exit();
						
		}

	}

	public function Controller($controller){

		$file = 'mvc/controller/' . strtolower($controller) . '.php';

		$c_arr = explode('/', $controller);
		
		if(empty($c_arr)){
			$class = preg_replace('/[^a-zA-Z0-9]/', '', $controller . 'controller');
		} else {
			$last_item = end($c_arr);
			$class = preg_replace('/[^a-zA-Z0-9]/', '', $last_item . 'controller');
		}

		if (file_exists($file)) { 

			include_once($file);
			$modular_controller = new $class($this, $this->request, $this->response, $this->cookie);
			$modular_controller->index();

			if($modular_controller->View()){
				$modular_vars = $modular_controller->data;
				if(!empty($modular_vars)){
					extract($modular_vars);	
				}

				$output = require($modular_controller->GetView());
				return $output;
			}

			return $modular_controller->GetView();

		} else {

			trigger_error('Error: Could not load controller ' . $controller . '!');
			exit();
						
		}

	}

	public function User(){
		include_once('system/engine/user.php');
		return new user($this, $this->cookie);
	}

	public function Database($server='', $user='', $password='', $db=''){
		require_once('system/engine/db.php');
		if($server!='' && $user!='' && $db!=''){
			return new DB($server, $user, $password, $db);
		} else {
			return new DB(DB_SERVER, DB_USER, DB_PASS, DB_NAME, DB_DEBUG);
		}
	}
	
}
?>
