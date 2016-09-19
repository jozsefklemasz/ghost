<?php 
/**
 * Models are handling the communication between the controller layer and the database.
 * The $db variable contains a database handler, the $load variable
 * contains the loader class.
 */
class Model{
        /**
         *
         * @var class $db       Database class
         */
        protected $db;
        /**
         *
         * @var class $load     Loader Class
         */
	protected $load;
                
	function __construct(){
		$this->load = New Load;
		$this->db = $this->load->database();
	}
	
}
?>