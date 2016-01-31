<?php 

final class Load{

	function __construct($request = '', $response = ''){
		$this->request = $request;
		$this->response = $response;
	}
	
	public function Model($model){

		$file  = 'mvc/model/' . strtolower($model) . '.php';
		
		if(empty($c_arr)){
			$class = preg_replace('/[^a-zA-Z0-9]/', '', $controller . 'controller');
		} else {
			$class = end($c_arr);
			$class = preg_replace('/[^a-zA-Z0-9]/', '', $class . 'controller');
		}

		
		if (file_exists($file)) { 

			include_once($file);
			return new $class(new Load);

		} else {

			trigger_error('Error: Could not load model ' . $model . '!');
			exit();
						
		}

	}

	public function Controller($controller){

		$file = 'mvc/controller/' . strtolower($controller) . '.php';

		$c_arr = explode('/', $controller);
		
		if(empty($c_arr)){
			$class = preg_replace('/[^a-zA-Z0-9]/', '', $controller . 'controller');
		} else {
			$class = end($c_arr);
			$class = preg_replace('/[^a-zA-Z0-9]/', '', $class . 'controller');
		}

		if (file_exists($file)) { 

			include_once($file);
			$modular_controller = new $class(new Load, $this->request, $this->response);
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

	public function Language($file){
		if(isset($_SESSION['language'])){
			if($_SESSION['language'] != 'en'){
				$file_en = 'mvc/language/en/' . strtolower($file) . '.php';	
			}
			$file = 'mvc/language/' . $_SESSION['language'] . '/' . strtolower($file) . '.php';	
			if(file_exists($file)){
				include_once($file);
				return $language;
			} else {
				if(file_exists($file_en)){
					include_once($file_en);
					return $language;
				} else {
					echo 'Cannot load language: ' . $file;
					exit;
				}
			}
		} else {
			$file_en = 'mvc/language/en/' . strtolower($file) . '.php';
			if(file_exists($file_en)){
				include_once($file_en);
				return $language;
			} else {
				echo 'Cannot load language: ' . $file;
				exit;
			}
		}
	}

	public function User(){
		include_once('system/user.php');
		return new user(new Load);
	}

	public function Database($server='', $user='', $password='', $db=''){
		include_once('system/db.php');
		if($server!='' && $user!='' && $db!=''){
			return new DB($server, $user, $password, $db);
		} else {
			return new DB(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		}
	}

	public function Mail(){

		include_once('system/load.php');
		return new mail;

	}
	
}
?>
