<?php
final class Request{

	public $post, $get, $session;

	function __construct(){

		if(isset($_POST) && !empty($_POST)){
			$this->post = $_POST;
		} else {
			$this->post = false;
		}

		if(isset($_GET) && !empty($_GET)){
			$this->get = $_GET;
		} else {
			$this->get = false;
		}

		if(isset($_SESSION) && !empty($_SESSION)){
			$this->session = $_SESSION;
		} else {
			$this->session = false;
		}

	}

	public function SessionReset(){
		session_start();
		session_destroy();
		return True;
	}

}