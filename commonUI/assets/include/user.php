<?php

include_once 'db.php';

class User{
	
	private $db;
	private $db_table = "user_data";
	
	public function __construct(){
		$this->db = new DbConnect();
	}
	
	public function isLoginExist($username, $password){		
		
		$query = "select * from " . $this->db_table . " where u_id = '$username' AND u_pass = '$password' Limit 1";
		$result = mysqli_query($this->db->getDb(), $query);
		if(mysqli_num_rows($result) > 0){
			mysqli_close($this->db->getDb());
			return true;
		}		
		mysqli_close($this->db->getDb());
		return false;		
	}
	
	public function createNewRegisterUser($name, $uid, $password){

		
		
		$query = "insert into ". $this->db_table . "(u_name,u_id,u_pass) values ('$name','$uid','$password')";

		$inserted = mysqli_query($this->db->getDb(), $query);

		if($inserted == 1){
			$json['success'] = 1;									
		}else{
			$json['success'] = 0;
		}
		mysqli_close($this->db->getDb());
		return $json;
	}
	
	public function loginUsers($username, $password){
			
		$json = array();
		$canUserLogin = $this->isLoginExist($username, $password);
		if($canUserLogin){
			$json['success'] = 1;
		}else{
			$json['success'] = 0;
		}
		return $json;
	}

}


?>