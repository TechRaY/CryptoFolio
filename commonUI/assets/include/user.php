<?php

include_once 'db.php';

class User{
	
	private $db;
	private $db_table = "users";
	
	public function __construct(){
		$this->db = new DbConnect();
	}
	
	public function isLoginExist($username, $password){		
				
		$query = "select * from " . $this->db_table . " where Email = '$username' AND Password = '$password' Limit 1";
		$result = mysqli_query($this->db->getDb(), $query);
		if(mysqli_num_rows($result) > 0){
			mysqli_close($this->db->getDb());
			return true;
		}		
		mysqli_close($this->db->getDb());
		return false;		
	}
	
	public function createNewRegisterUser($firstname,$lastname, $email, $password,$address,$contact){


			
		$query = "insert into ". $this->db_table . "(First_Name, Last_Name, Email, Password, Contact, Address, created_at) values ('$firstname','$lastname',  '$email', '$password','$contact','$address',NOW())";

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