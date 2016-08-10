<?php

	class DB{
		
		private $conn, $query, $results, $last_query;

		function __construct($server='', $user='', $pass='', $name=''){
			if($server == '' || $user == '' || $pass == '' || $name == ''){
				return false;
			}

			try{
				$db_details = 'mysql:host=' . $server . ';dbname=' . $name . ';charset=utf8';
				$this->conn = new PDO($db_details, $user, $pass);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e){
				echo $e->getMessage();
				die();
			}
		}

		public function GetResults(){
			return $this->results;
		}

		public function Prepare($sql){
			try{
				$this->query = $this->conn->prepare($sql);
				$this->last_query = $sql;
				return true;
			} catch(PDOException $e){
				echo $e->getMessage();
				return false;
				die();
			}
		}

		public function Execute($execute_data = array()){
			
			try{
				$this->query->execute();
				$this->results = $this->query->fetchAll();
			} catch(PDOException $e){
				echo $e->getMessage();
				return false;
				die();
			}

		}

		public function GetLastQuery(){
			if($this->last_query != ''){
				return $this->last_query;
			} else {
				return false;
			}
		}



	}
?>