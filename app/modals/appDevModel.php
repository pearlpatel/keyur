<?php 
class AppDevModel extends Modal{
	public function __construct(){
		parent::__construct();
	}
	public function linkDevApp($Input){
		$lId = json_decode(stripslashes($Input['lId']));
		for($i=0;$i<count($lId);$i++){
			$query="INSERT INTO LinkMaster (AId, LinkId) VALUES('$lId[$i]', '$Input[aId]')";
			$result =$this->Database->ExecuteNoneQuery($query);
		}
		return $result;
	}
	public function unlinkDevApp($Input){
		$lId = json_decode(stripslashes($Input['lId']));
		for($i=0;$i<count($lId);$i++){
			$query="DELETE FROM LinkMaster WHERE AId='$lId[$i]' AND LinkId='$Input[aId]'";
			$result =$this->Database->ExecuteNoneQuery($query);
		}
		return $result;
	}
	public function appByPackName($Input){
		$query = "SELECT Id,AppName,PackageName,ShortDiscription,Logo,Icon,PromoBanner,Views,Downloads FROM AppMaster WHERE AppStatus='1' && DAId='$Input[devid]'";
		$response1 = $this->resourceToArray($this->Database->ExecuteQuery($query));	
		$query = "SELECT Id FROM AppMaster WHERE PackageName='$Input[packname]'";
		$result =$this->Database->getRow($query);
		if($result):
			$query="SELECT a.Id,d.AcName,AppName,PackageName,ShortDiscription,Logo,Icon,PromoBanner,Views,Downloads FROM AppMaster a, LinkMaster l, DeveloperMaster d WHERE (a.Id=l.LinkId && l.AId='$result[Id]' && Banner='1' && d.Id=a.DAId && a.AppStatus='1' && d.Status='1') || (a.HotLink='1' && d.Id=a.DAId && a.AppStatus='1' && d.Status='1') GROUP BY a.Id Order By l.Priority";
			$response2 = $this->resourceToArray($this->Database->ExecuteQuery($query));
			$query="SELECT a.Id,d.AcName,AppName,PackageName,ShortDiscription,Logo,Icon,Views,Downloads FROM AppMaster a, LinkMaster l, DeveloperMaster d WHERE (a.Id=l.LinkId && l.AId='$result[Id]' && d.Id=a.DAId && a.AppStatus='1' && d.Status='1') || (a.HotLink='1' && d.Id=a.DAId && a.AppStatus='1' && d.Status='1') GROUP BY a.Id Order By l.Priority";
			$response3 = $this->resourceToArray($this->Database->ExecuteQuery($query));					
		else:
			$response2=array();
			$response3=array();				
		endif;	
		$response=array("AllApp"=>$response1,"WithBanner"=>$response2,"WithoutBanner"=>$response3);		
		return $response;
	}
	public function setAppLinkPriority($Input){
		$index = json_decode(stripslashes($Input['index']));
		$lId = json_decode(stripslashes($Input['lId']));
		for($i=0;$i<count($lId);$i++){
			$query="UPDATE LinkMaster SET Priority='$index[$i]' WHERE AId='$Input[aId]' && LinkId='$lId[$i]'";
			$result =$this->Database->ExecuteNoneQuery($query);
		}
		return $result;
	}
	public function setAppView($Input){
		$query = "SELECT Views FROM AppMaster WHERE PackageName='$Input[aId]'";
		$result =$this->Database->getRow($query);
		if($result):
			$view=(int)$result['Views']+1;
			$query="UPDATE AppMaster SET Views='$view' WHERE PackageName='$Input[aId]'";
			$result =$this->Database->ExecuteNoneQuery($query);
			return $result;
		else:
			return array("error" => 404);
		endif;
	}
	public function setAppDownload($Input){
		$query = "SELECT Downloads FROM AppMaster WHERE PackageName='$Input[aId]'";
		$result =$this->Database->getRow($query);
		if($result):
			$download=(int)$result['Downloads']+1;
			$query="UPDATE AppMaster SET Downloads='$download' WHERE PackageName='$Input[aId]'";
			$result =$this->Database->ExecuteNoneQuery($query);
			return $result;
		else:
			return array("error" => 404);
		endif;
	}
}

?>