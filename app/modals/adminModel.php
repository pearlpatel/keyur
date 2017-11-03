<?php

class AdminModel extends Modal{

	public function __construct(){
		parent::__construct();
	}
	public function setDeveloperDetail($Input,$developerUpdateId){
		if(isset($developerUpdateId) && $developerUpdateId){
			$query = "SELECT * FROM DeveloperMaster WHERE EmailId = '$Input[txtEmail]' && Id <> '$developerUpdateId'";
		}else{
			$query = "SELECT * FROM DeveloperMaster WHERE EmailId = '$Input[txtEmail]'";
		}
		$resultset = $this->Database->getRow($query);
		if($this->Database->getLastAffectedRow($resultset) == 1):
			return false;
		else:
			$join_date =date('Y-m-d h:i:s');
			if(isset($developerUpdateId) && $developerUpdateId):
				$query = "UPDATE DeveloperMaster SET AcName = '$Input[txtName]', EmailId = '$Input[txtEmail]' WHERE Id = '$developerUpdateId'";
					if($this->Database->ExecuteNoneQuery($query) == 1):
						return true;
					endif;
				else:
					$query = "INSERT INTO DeveloperMaster VALUES(DEFAULT, '$Input[txtEmail]', '$Input[txtName]', '1', '$join_date')";
					if($this->Database->ExecuteNoneQuery($query) == 1):
						return true;
					else:
						return false;
					endif;
				endif;
		endif;
	}
	public function setDeveloperStatus($developerId){
		$query = "SELECT Status FROM DeveloperMaster WHERE Id = '$developerId'";
		$resultset = $this->Database->getRow($query);
		if($resultset['Status']==0){
			$query1 = "UPDATE DeveloperMaster SET Status='1' WHERE Id = '$developerId'";
		}else{
			$query1 = "UPDATE DeveloperMaster SET Status='0' WHERE Id = '$developerId'";
		}
		if($this->Database->ExecuteNoneQuery($query1) == 1):
			return true;
		else:
			return false;
		endif;
	}
	public function getLoginDetail($UserName,$Password){
		$query = "SELECT * FROM AdminMaster WHERE UserName = '$UserName' && Password = '$Password'";
		$resultset = $this->Database->getRow($query);
		return $resultset;
		if($this->Database->getLastAffectedRow($resultset) == 1):
			$_SESSION['user']=$resultset;
			return true;
		else:
			return false;
		endif;
	}
	public function getDeveloperDetail(){
		$query = "SELECT Id, EmailId, AcName, Status FROM DeveloperMaster ";
		$resultset = $this->Database->ExecuteQuery($query);
		return $resultset;
	}	
}

?>