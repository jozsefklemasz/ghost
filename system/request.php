<?php
final class Request{

	public $post, $get, $session;

	function __construct(){

		if($_POST){
			$this->post = $_POST;
		} else {
			$this->post = false;
		}

		if($_GET){
			$this->get = $_GET;
		} else {
			$this->get = false;
		}

		if($_SESSION){
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