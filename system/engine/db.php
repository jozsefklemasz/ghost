<?php
/**
 * 
 * PDO database handler
 */
final class DB{
	/**
         *
         * @var PDO Connection;
         */
	private $conn;
        
        /**
         *
         * @var PDO Current prepared query
         */
        private $query;
        
        /**
         *
         * @var PDO results
         */
        private $results;
        
        /**
         *
         * @var string Last query;
         */
        private $last_query;
        
        /**
         * 
         * @param string $server
         * @param string $user
         * @param string $pass
         * @param string $name
         */
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

        /**
         * Returns true if we are connected to the database
         * @return boolean
         */
	public function Connected(){
		return $this->connected;
	}

        /**
         * Returns an array of results or false if there are no results
         * @return array
         */
	public function GetResults(){
		if($this->query){
			$this->results = $this->query->fetchAll();
			return $this->results;
		} else {
			return false;
		}
	}

        /**
         * Prepares an sql query, returns false if the query was wrong
         * @param string $sql
         * @return boolean
         */
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
        
        /**
         * Tries to execute a query
         * @param array $execute_data
         * @return boolean
         */
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
        
        /**
         * Returns the last query string, or false if there weren't any queries yet.
         * @return boolean or string;
         */
	public function GetLastQuery(){
		if($this->last_query != ''){
			return $this->last_query;
		} else {
			return false;
		}
	}
}
?>