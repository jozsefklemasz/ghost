<?php
/**
 * Contains post/get data;
 */
final class Request{
        /**
         *
         * @var class $post     Contains $_POST data;    
         */
	public $post;
        /**
         *
         * @var class $get      Contains $_GET data;
         */
        public $get;
        
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