<?php
final class Request{

	public $post, $get;

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
	}
}