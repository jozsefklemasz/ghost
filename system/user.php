<?php 

class user{
	
	private $loggedin, $id, $db, $user, $load;

	function __construct($load){
		$this->load = $load;
		$this->db = $this->load->database();
		if(isset($_SESSION['id'])){
			$this->id = $_SESSION['id'];
			$this->loggedin = True;
		} else {
			$this->loggedin = False;
		}

		return;
	}

	public function Loggedin(){
		return $this->loggedin;
	}

	public function Login($data){
		$sql = "SELECT id FROM user WHERE username='" . $this->db->escape($data['username']) . "' AND password='" . hash('sha256', $data['password']) . "'";
		
		if($this->user = $this->db->Out($sql)){
			// User with pw exists and valid
			$_SESSION['id'] = $this->user[0]['id'];
			return True;
		} else {
			// Failed login attempt;
			return False;
		}
	}

	public function Logout(){
		session_start();
		session_destroy();
		header('Location: /');
	}

}

?>