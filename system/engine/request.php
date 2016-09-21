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
        $filteredPost = filter_input_array(INPUT_POST, $_POST);
        $filteredGet = filter_input_array(INPUT_GET, $_GET);

		if(isset($filteredPost) && !empty($filteredPost)){
			$this->post = $filteredPost;
		} else {
			$this->post = false;
		}

		if(isset($filteredGet) && !empty($filteredGet)){
			$this->get = $filteredGet;
		} else {
			$this->get = false;
		}
	}
}