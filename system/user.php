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

	public function loggedin(){
		return $this->loggedin;
	}

	public function Create($data){
		$sql = "INSERT INTO users VALUES(NULL, '" . $this->db->escape($data['reg_user']) . "', '" . $this->db->escape($data['reg_pass']) . "', '" . $this->db->escape($data['reg_anon']) . "')";
	}

	public function vote($type, $id){
		if($this->loggedin){
			
			if($type == 'news'){
				$sql = "SELECT vote FROM votes WHERE user_id='" . $this->id . "' AND news_id='" . $id . "'";
				if($vote = $this->db->Out($sql)){
					return $vote[0]['vote'];
				} else {
					return False;
				}
			} else {

			}

		}
	}

	public function get($vn){
		if(isset($this->$vn)){
			return $this->$vn;
		} else {
			return 'variable ' . $vn . ' not exists';
		}
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

	public function logout(){
		session_start();
		session_destroy();
		header('Location: /');
	}

	public function name($id){
		if($id){
			$sql = "SELECT name FROM users WHERE id='" . $id . "'";
			$user = $this->db->Out($sql);
			if(!empty($user)){
				return $user[0]['name'];
			} else {
				return 'Deleted user';
			}
		}
	}
}

?>