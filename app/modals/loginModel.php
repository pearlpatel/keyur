<?php 
class LoginModel extends Modal{
	public function __construct(){
		parent::__construct();
	}
	public function checkUserSignup($Input){
		$query="SELECT Id FROM UserMaster WHERE EmailId='$Input[email]' && PhoneNo='$Input[phone]'";	
		$resultset = $this->Database->getRow($query);
		if($this->Database->getLastAffectedRow($resultset) == 1):
			return array("error" => 410);
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
		//$query="SELECT Id FROM UserMaster WHERE EmailId='$Input[email]' || PhoneNo='$Input[phone]'";	
		//$resultset = $this->Database->getRow($query);
		//if($this->Database->getLastAffectedRow($resultset) == 1):
		//	$query="UPDATE UserMaster SET EmailId='$Input[email]', PhoneNo='$Input[phone]', DeviceId='$Input[deviceid]', UserName='$Input[username]', ProfilePic='$Input[profilepic]', Status='$Input[status]' WHERE EmailId='$Input[email]' || PhoneNo='$Input[phone]'";
		//else:
			$query="INSERT INTO UserMaster (EmailId, PhoneNo, DeviceId, UserName, ProfilePic, Status, PostedDate) VALUES ('$Input[email]', '$Input[phone]', '$Input[deviceid]', '$Input[username]', '$Input[profilepic]', '$Input[status]', NOW())";
		//endif;
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
		$errmsg = '';
		$url = "app/modals/upload.php"; // e.g. http://localhost/myuploader/upload.php // request URL
		$filename = $_FILES['file1']['name'];
		$filedata = $_FILES['file1']['tmp_name'];
		$filesize = $_FILES['file1']['size'];
		if ($filedata != '')
		{
			$headers = array("Content-Type:multipart/form-data"); // cURL headers for file uploading
			$postfields = array("filedata" => "@$filedata", "filename" => $filename);
			$ch = curl_init();
			$options = array(
				CURLOPT_URL => $url,
				CURLOPT_HEADER => true,
				CURLOPT_POST => 1,
				CURLOPT_HTTPHEADER => $headers,
				CURLOPT_POSTFIELDS => $postfields,
				CURLOPT_INFILESIZE => $filesize,
				CURLOPT_RETURNTRANSFER => true
			); // cURL options
			curl_setopt_array($ch, $options);
			curl_exec($ch);
			if(!curl_errno($ch))
			{
				$info = curl_getinfo($ch);
				if ($info['http_code'] == 200)
					echo $errmsg = "File uploaded successfully";
			}
			else
			{
				echo $errmsg = curl_error($ch);
			}
			curl_close($ch);
		}
		else
		{
			echo $errmsg = "Please select the file";
		}
	}
	
}
?>