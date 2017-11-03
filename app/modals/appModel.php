<?php 
class AppModel extends Modal{
	public function __construct(){
		parent::__construct();
	}

	public function getDeveloperDetail(){
		$query = "SELECT  * FROM DeveloperMaster WHERE Status=1";
		$rsDetail =$this->Database->ExecuteQuery($query);
		return $rsDetail;
	}
	public function getApp(){
		$query = "SELECT a.Id,AppName,AcName,PackageName,Views,Downloads,AppStatus FROM AppMaster a, DeveloperMaster d WHERE a.DAId=d.Id";
		$rsDetail =$this->Database->ExecuteQuery($query);
		return $rsDetail;
	}
	public function getDevApp($DId){
		$query = "SELECT a.Id,AppName,AcName,PackageName,Views,Downloads,AppStatus FROM AppMaster a, DeveloperMaster d WHERE a.DAId=d.Id AND a.DAId='$DId'";
		$rsDetail =$this->Database->ExecuteQuery($query);
		return $rsDetail;
	}
	public function setApp($Input,$appUpdateId,$image,$bannerFile,$iconImage){
		if(isset($appUpdateId) && $appUpdateId){
			$query = "SELECT * FROM AppMaster WHERE PackageName = '$Input[txtPacName]' && Id <> '$appUpdateId'";
		}else{
			$query = "SELECT * FROM AppMaster WHERE PackageName = '$Input[txtPacName]'";
		}
		$resultset = $this->Database->getRow($query);
		if($this->Database->getLastAffectedRow($resultset) == 1):
			return false;
		else:
			$join_date =date('Y-m-d h:i:s');
			if(isset($appUpdateId) && $appUpdateId):
				   $query = "UPDATE AppMaster SET AppName = '$Input[txtAppName]', PackageName='$Input[txtPacName]', ShortDiscription = '$Input[txtDesc]', Logo = '$image', PromoBanner = '$bannerFile', DAId='$Input[drpDevAppId]', Icon='$iconImage' WHERE Id = '$appUpdateId'";
					if($this->Database->ExecuteNoneQuery($query) == 1):
						return true;
					endif;
				else:
					$query = "INSERT INTO AppMaster (DAId, AppName, PackageName, ShortDiscription, Logo, PromoBanner, PostedDate, Icon) VALUES ($Input[drpDevAppId], '$Input[txtAppName]', '$Input[txtPacName]', '$Input[txtDesc]', '$image', '$bannerFile', NOW(), '$iconImage')";

					if($this->Database->ExecuteNoneQuery($query) == 1):
						return true;
					else:
						return false;
					endif;
				endif;
		endif;
	}
	public function getInvidualApp($appId){
		$query = "SELECT * FROM AppMaster WHERE Id = '$appId'";
		$result = $this->Database->getRow($query);
		return $result;
	}
	public function setAppStatus($appId){
		$query = "SELECT AppStatus FROM AppMaster WHERE Id = '$appId'";
		$resultset = $this->Database->getRow($query);
		if($resultset['AppStatus']==0){
			$query1 = "UPDATE AppMaster SET AppStatus='1' WHERE Id = '$appId'";
		}else{
			$query1 = "UPDATE AppMaster SET AppStatus='0' WHERE Id = '$appId'";
		}
		if($this->Database->ExecuteNoneQuery($query1) == 1):
			return true;
		else:
			return false;
		endif;
	}
	
	public function deleteApp($appId){
		$query = "DELETE FROM AppMaster WHERE Id = '$appId'";
		$this->Database->ExecuteNoneQuery($query);	
	}
	public function getAppInfo($appId){
		$query = "SELECT a.Id,AppName,PackageName,ShortDiscription,Logo,PromoBanner,Icon,Views,Downloads,AppStatus,AcName FROM AppMaster a, DeveloperMaster d WHERE a.DAId=d.Id AND a.Id='$appId'";
		$rsDetail =$this->Database->ExecuteQuery($query);
		return $rsDetail;
	}
}

?>