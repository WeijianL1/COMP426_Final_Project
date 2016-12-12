<?php
date_default_timezone_set('America/New_York');

class UserInfo
{
	private $gender;
	private $user_id;
	private $dob;
	private $portrait;
	private $phone;

	public static function connect() {
		return new mysqli("classroom.cs.unc.edu",
											"weijian",
											"123456",
											"weijiandb"
											);
	}
	
	public static function getIDs() {
		$mysqli = UserInfo::connect();

		$res = $mysqli->query("select user_id from UserInfo");
		

		$id_array = array();

		if ($res) {
			while ($next_row = $res->fetch_array()) {
				$id_array[] = intval($next_row['user_id']);
			}
		}
		
		return $id_array;
	}


	public static function getUserInfoByID($id) {
		$mysqli = UserInfo::connect();

    	$result = $mysqli->query("select * from UserInfo where user_id = " . $id);
    	if ($result) {
    		if ($result->num_rows == 0) {
    			return null;
    		}

    	$UserInfo_info = $result->fetch_array();
    	
    	$gender = $UserInfo_info['gender'];
    	$user_id = $UserInfo_info['user_id'];
    	$dob = $UserInfo_info['dob'];
    	$portrait = $UserInfo_info['portrait'];
    	$phone = $UserInfo_info['phone'];
 
    	return new UserInfo($gender,$user_id,$dob,$portrait,$phone);
    	}
	}
	
	public function getJSON() {
		$json = array(
				"gender"=>$this->gender,
				"user_id"=>$this->user_id,
				"dob"=>$this->dob,
				"portrait"=>$this->portrait, 
				"phone"=>$this->phone
			);
		 return json_encode($json);
	}

	private function __construct
	($gender,$user_id,$dob,$portrait,$phone) 
	{
		$this->gender = $gender;
		$this->user_id = $user_id;
		$this->dob = $dob;
		$this->portrait = $portrait;
		$this->phone = $phone;
	}

}
?>