<?php

class AdminModel extends Modal{
	public function __construct(){
		parent::__construct();
	}	
	public function getLoginDetail($UserName,$Password){
		$query = "SELECT * FROM AdminMaster WHERE AdminName = '$UserName' && Password = '$Password'";
		$resultset = $this->Database->getRow($query);
		return $resultset;
		if($this->Database->getLastAffectedRow($resultset) == 1):
			$_SESSION['user']=$resultset;
			return true;
		else:
			return false;
		endif;
	}
	public function getUserDetail(){
		$query = "SELECT Id, EmailId, PhoneNo, ProfilePic, UserName, Status, PostedDate FROM UserMaster ";
		$resultset = $this->Database->ExecuteQuery($query);
		return $resultset;
	}
	public function getCategoryDetail(){
		$query = "SELECT Id, Name FROM CategoryMaster WHERE ParentId=1";
		$resultset = $this->Database->ExecuteQuery($query);
		return $resultset;
	}
	public function getAllCategoryDetail(){
		$query = "SELECT Id, Icon, Name, Description, Status FROM CategoryMaster Where Id<>1";
		$resultset = $this->Database->ExecuteQuery($query);
		return $resultset;
	}
	public function getInvidualCategory($catId){
		$query = "SELECT * FROM CategoryMaster WHERE Id = '$catId'";
		$result = $this->Database->getRow($query);
		return $result;
	}
	public function setCategoryDetail($Input,$IconFile,$categoryUpdateId){
		if(isset($categoryUpdateId) && $categoryUpdateId){
			$query = "SELECT * FROM CategoryMaster WHERE Name = '$Input[txtCatName]' && Id <> '$categoryUpdateId'";
		}else{
			$query = "SELECT * FROM CategoryMaster WHERE Name = '$Input[txtCatName]'";
		}
		$resultset = $this->Database->getRow($query);
		if($this->Database->getLastAffectedRow($resultset) == 1):
			return false;
		else:
			$join_date =date('Y-m-d h:i:s');
			if(isset($categoryUpdateId) && $categoryUpdateId):
				$query = "UPDATE CategoryMaster SET Icon='$IconFile', Description = '$Input[txtDesc]', Name = '$Input[txtCatName]', ParentId='$Input[drpCatId]' WHERE Id = '$categoryUpdateId'";
					if($this->Database->ExecuteNoneQuery($query) == 1):
						return true;
					endif;
				else:
					$query = "INSERT INTO CategoryMaster VALUES(DEFAULT, '$IconFile', '$Input[txtCatName]', '$Input[txtDesc]', '$Input[drpCatId]', '0', '$join_date')";
					if($this->Database->ExecuteNoneQuery($query) == 1):
						return true;
					else:
						return false;
					endif;
				endif;
		endif;
	}
	public function setCategoryStatus($catId){
		$query = "SELECT Status FROM CategoryMaster WHERE Id = '$catId'";
		$resultset = $this->Database->getRow($query);
		if($resultset['Status']==0){
			$query1 = "UPDATE CategoryMaster SET Status='1' WHERE Id = '$catId'";
		}else{
			$query1 = "UPDATE CategoryMaster SET Status='0' WHERE Id = '$catId'";
		}
		if($this->Database->ExecuteNoneQuery($query1) == 1):
			return true;
		else:
			return false;
		endif;
	}
}
?>