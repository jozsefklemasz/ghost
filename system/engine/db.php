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

	function __destruct(){
		$this->conn = null;
		$this->query = null;
	}

	public function GetResults(){
		if($this->query){
			$this->results = $this->query->fetchAll();
			return $this->results;
		} else {
			return false;
		}
	}

	public function Prepare($sql){
		if($this->conn){
			try{
				$this->query = $this->conn->prepare($sql);
				$this->last_query = $sql;
				return true;
			} catch(PDOException $e){
				echo $e->getMessage();
				return false;
				die();
			}
		} else {
			return false;
		}
	}

	public function Execute($execute_data = array()){
		if($this->query){
			try{
				$this->query->execute($execute_data);
			} catch(PDOException $e){
				echo $e->getMessage();
				return false;
				die();
			}
		} else {
			return false;
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