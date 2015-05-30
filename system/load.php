<?php 

final class Load{
	
	public function Model($model){

		$file  = 'mvc/model/' . strtolower($model) . '.php';
		
		$class = preg_replace('/[^a-zA-Z0-9]/', '', $model . 'Model');
		
		if (file_exists($file)) { 

			include_once($file);
			return new $class(new Load);

		} else {

			trigger_error('Error: Could not load model ' . $model . '!');
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
