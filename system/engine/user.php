<?php 

class User{
	
	private $loggedin, $userId, $db, $user, $load, $userToken;

	function __construct($load, $cookie){
		$this->load = $load;
		$this->db = $this->load->database();
		$this->cookie = $cookie;

		if($this->userToken = $this->cookie->Get('user_token')){
			if($userId = $this->ValidateCookieData($userToken)){
				$this->userId = $userId;
				$this->loggedin = true;	
			} else {
				$this->loggedin = false;
			}
		} else {
			$this->loggedin = false;
		}
	}

	public function Create($username, $password)
	{	
		$password = $this->HashPassword($password);
		$sql = "INSERT INTO user VALUES(NULL, :username, :password)";
		$this->db->Prepare($sql);
		$this->db->Execute([':username'=>$username, ':password'=>$password]);
	}

	public function LoggedIn(){
		return $this->loggedin;
	}

	public function Login($data){
		if(!empty($data) && !$this->loggedin){		
			$hashedPassword = $this->HashPassword($data['password']);
			$sql = "SELECT user_id, username FROM user WHERE username=:username AND password=:password";
			$this->db->Prepare($sql);
			$this->db->Execute([':username' => $data['username'], ':password' => $hashedPassword]);	
			if($result = $this->db->GetResults()){
				$hashedUserToken = $this->GenerateUserToken($result[0]);
				$this->SetUserToken($hashedUserToken, $result[0]['user_id']);
				$this->userId = $result[0]['user_id'];
				$this->loggedin = true;
				$this->cookie->Set('user_token', $hashedUserToken);

				return true;
			} else {
				$this->loggedin = false;
				return false;
			}
		}
	}

	private function ValidateCookieData($userToken){
		$sql = "SELECT user_id FROM user_token WHERE user_token=:user_token";
		$this->db->Prepare($sql);
		$this->db->Execute([':user_token' => $userToken]);
		if($result = $this->db->GetResults()){
			return $result[0]['user_id'];
		}
	}

	private function SetUserToken($userToken, $userId){
		$sql = "INSERT INTO user_token VALUES(:user_token, :user_id)";
		$this->db->prepare($sql);
		$this->db->Execute([':user_token'=>$userToken, ':user_id' => $userId]);
	}

	private function GenerateUserToken($data){
		return hash('sha256', $data['username'] . time() . $data['user_id']);
	}

	private function HashPassword($password){
		return hash('sha256', $password);
	}

	public function Logout(){
		if($this->userId){
			$sql = "DELETE FROM user_token WHERE user_id=:user_id AND user_token=:user_token";
			
			$this->db->Prepare($sql);
			$this->db->Execute([':user_id' => $this->userId, ':user_token' => $this->userToken]);

			$this->cookie->Delete('user_token');
		}
	}

}

?>