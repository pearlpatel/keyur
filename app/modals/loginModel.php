<?php 
class LoginModel extends Modal{
	public function __construct(){
		parent::__construct();
	}
	public function setUserSignup($Input){
		$query="SELECT Id FROM UserMaster WHERE EmailId='$Input[email]' && PhoneNo='$Input[phone]'";	
		$resultset = $this->Database->getRow($query);
		if($this->Database->getLastAffectedRow($resultset) == 1):
			return array("error" => 410);//return array("message" => 'User already exist');
		else:
			$query="SELECT Id FROM UserMaster WHERE EmailId='$Input[email]'";	
			$resultset = $this->Database->getRow($query);
			if($this->Database->getLastAffectedRow($resultset) == 1):
				return array("error" => 408);
			else:
				$query="SELECT Id FROM UserMaster WHERE PhoneNo='$Input[phone]'";	
				$resultset = $this->Database->getRow($query);
				if($this->Database->getLastAffectedRow($resultset) == 1):
					return array("error" => 409);
				else:
					return array("error" => 200);
				endif;
			endif;
		endif;
	}
	public function userSignup($Input){
		$query="INSERT INTO UserMaster (EmailId, PhoneNo, DeviceId, UserName, ProfilePic, Status, PostedDate) VALUES ('$Input[email]', '$Input[phone]', '$Input[deviceid]', '$Input[username]', '$Input[profilepic]', '$Input[status]', NOW())";
		$result =$this->Database->ExecuteNoneQuery($query);
		return $result;
	}
	public function userLogin($Input){
		$query="SELECT Id FROM UserMaster WHERE EmailId='$Input[email]' || PhoneNo='$Input[phone]'";	
		$resultset = $this->Database->getRow($query);
		if($this->Database->getLastAffectedRow($resultset) == 1):
			$query="UPDATE UserMaster SET EmailId='$Input[email]', PhoneNo='$Input[phone]', DeviceId='$Input[deviceid]' WHERE EmailId='$Input[email]' || PhoneNo='$Input[phone]'";
			$result =$this->Database->ExecuteNoneQuery($query);
			return $result;
		else:
			return array("error" => 401);
		endif;		
	}
	public function fileUpload($Input){
		$target_dir = "uploads/user_request/";
		$target_file = $target_dir . time().$Input["image"]["name"];				
		$video_path=$Input['image']['name'];				
		if(move_uploaded_file($Input["image"]["tmp_name"],$target_file)){
			return $Input['image'];
		}	
		else{
			return array("error" => 401);
		}
	}
}
?>