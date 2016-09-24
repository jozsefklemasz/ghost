<?php

class InstallModel extends Model{
	public function Install(){
		if($this->db->Connected()){
			if(!$this->db->SetCollation()){
				return 'Cant set db collation to utf8!';
			}
			
			$sql = "CREATE TABLE user 
			(user_id int NOT NULL AUTO_INCREMENT,
			username varchar(60),
			password text,
			primary key (user_id))";
			
			if($this->db->Prepare($sql)){
				$this->db->Execute();
			} else {
				return 'Could not create user table!';
			}

			$sql = "CREATE TABLE user_token (user_token text,
			user_id int NOT NULL,
			primary key(user_id))";
			if($this->db->Prepare($sql)){
				$this->db->Execute();
			} else {
				return 'Could not create user_token table!';
			}
			
			
			return 0;
		} else {
			return 'No db connection, check config.php!';
		}

	}
}