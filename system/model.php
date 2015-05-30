<?php 
/**
* 
*/
class Model{

	protected $db, $load;
	
	function __construct(){
		$this->load = New Load;
		$this->db = $this->load->database();
	}
	
}
?>