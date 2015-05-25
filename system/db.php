<?php
	
	/**
	* DEFAULT DB CLASS
	*/
	class DB{
		
		private $conn, $insert_id;

		function __construct($server, $user, $pass, $name){
			$this->conn = mysqli_connect($server, $user, $pass, $name);
			$this->conn->set_charset('utf8');

			if (mysqli_connect_errno()) {
			    printf("Connect failed: %s\n", mysqli_connect_error());
			    exit();
			}
		}

		public function Out($sql){
			$res = $this->conn->query($sql);
			if($res->num_rows){
				$final = array();
				while($row = $res->fetch_array(MYSQLI_ASSOC)){
					$final[] = $row;
				}
				return $final;
			} else {
				echo $this->conn->error;
				return False;
			}
		}

		public function In($sql){
			if($this->conn->query($sql)){
				$this->insert_id = $this->conn->insert_id;
				return True;
			} else {
				echo $this->conn->error;
				return False;
			}
		}

		public function last_id(){
			if(isset($this->insert_id)){
				return $this->insert_id;
			} else {
				return False;
			}
		}

		public function escape($string){
			return $this->conn->real_escape_string($string);
		}
	}

?>