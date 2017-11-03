<?php 
class DevLinkModel extends Modal{
	public function __construct(){
		parent::__construct();
	}
	public function getAllApp(){
		$query = "SELECT a.Id, CONCAT_WS(' - ', AppName, AcName) AS ApName FROM AppMaster a, DeveloperMaster  d WHERE a.DAId=d.Id && Status='1' && AppStatus='1' ORDER BY AppName";
		$rsDetail =$this->Database->ExecuteQuery($query);
		return $rsDetail;
	}
	public function getDeveloperDetail(){
		$query = "SELECT  * FROM DeveloperMaster WHERE Status='1' ORDER BY AcName";
		$rsDetail =$this->Database->ExecuteQuery($query);
		return $rsDetail;
	}
	public function getDevApp($dId){
		$query = "SELECT Id, AppName FROM AppMaster WHERE DAId='$dId' && AppStatus='1' ORDER BY AppName";
		$rsDetail =$this->Database->ExecuteQuery($query);
		return $rsDetail;
	}
	public function getAppForLink($aId, $dId){
		$query="SELECT a.Id, a.AppName, a.PackageName, d.AcName FROM AppMaster a, DeveloperMaster d WHERE a.Id<>'$aId' && d.Id=a.DAId && a.DAId='$dId' && a.AppStatus='1' && a.HotLink='0' && a.Id NOT IN (SELECT AId FROM LinkMaster WHERE LinkId='$aId')";
		$rsDetail =$this->Database->ExecuteQuery($query);
		return $rsDetail;
	}
	public function getAppLinkDetail($aId){
		$query="SELECT a.Id, a.AppName, a.PackageName, d.AcName, l.Banner FROM AppMaster a, DeveloperMaster d, LinkMaster l WHERE d.Id=a.DAId && a.AppStatus='1' && l.LinkId='$aId' && l.aId=a.Id";
		$rsDetail =$this->Database->ExecuteQuery($query);
		return $rsDetail;
	}
	public function linkAppDetail($aId, $lId){
		$query="INSERT INTO LinkMaster (AId, LinkId) VALUES('$aId', '$lId')";
		$rsDetail =$this->Database->ExecuteNoneQuery($query);
		return $rsDetail;
	}
	public function unlinkAppDetail($aId, $lId){
		$query="DELETE FROM LinkMaster WHERE AId='$aId' && LinkId='$lId'";
		$rsDetail =$this->Database->ExecuteNoneQuery($query);
		return $rsDetail;
	}	
	public function setLinkAppBanner($aId, $lId){
		$query = "SELECT Banner FROM LinkMaster WHERE AId = '$aId' && LinkId='$lId'";
		$resultset = $this->Database->getRow($query);
		if($resultset['Banner']==0){
			$query1 = "UPDATE LinkMaster SET Banner='1' WHERE AId = '$aId' && LinkId='$lId'";
		}else{
			$query1 = "UPDATE LinkMaster SET Banner='0' WHERE AId = '$aId' && LinkId='$lId'";
		}
		if($this->Database->ExecuteNoneQuery($query1) == 1):
			return true;
		else:
			return false;
		endif;
	}
}
?>