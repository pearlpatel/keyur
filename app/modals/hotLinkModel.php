<?php 
class HotLinkModel extends Modal{
	public function __construct(){
		parent::__construct();
	}

	public function getAppForLink(){
		$query="SELECT a.Id, a.AppName, a.PackageName, d.AcName FROM AppMaster a, DeveloperMaster d WHERE d.Id=a.DAId && a.AppStatus='1' && a.HotLink='0'";
		$rsDetail =$this->Database->ExecuteQuery($query);
		return $rsDetail;
	}
	public function setHotLink($aId){
		$query="UPDATE AppMaster SET HotLink='1' WHERE Id='$aId'";
		$rsDetail =$this->Database->ExecuteNoneQuery($query);
		return $rsDetail;
	}
	public function unsetHotLink($aId, $lId){
		$query="UPDATE AppMaster SET HotLink='0' WHERE Id='$aId'";
		$rsDetail =$this->Database->ExecuteNoneQuery($query);
		return $rsDetail;
	}
	public function getAppLinkDetail(){
		$query="SELECT a.Id, a.AppName, a.PackageName, d.AcName FROM AppMaster a, DeveloperMaster d WHERE d.Id=a.DAId && a.AppStatus='1' && a.HotLink='1'";
		$rsDetail =$this->Database->ExecuteQuery($query);
		return $rsDetail;
	}
}
?>