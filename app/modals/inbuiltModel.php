<?php 
class InbuiltModel extends Modal{
	public function __construct(){
		parent::__construct();
	}
	public function getCategoryDetail(){
		$query = "SELECT  * FROM CategoryMaster WHERE Status=1";
		$rsDetail = $this->resourceToArray($this->Database->ExecuteQuery($query));
		if($rsDetail){return $rsDetail;
		} else{return array("error" => 608);}	
	}
	public function getAllTheme(){
		$query = "SELECT  * FROM ThemeMaster WHERE ThemeStatus=1";
		$rsDetail = $this->resourceToArray($this->Database->ExecuteQuery($query));
		if($rsDetail){return $rsDetail;
		} else{return array("error" => 607);}	
	}
	public function getTopTheme(){
		$query = "SELECT  * FROM ThemeMaster WHERE ThemeStatus=1 AND Top=1";
		$rsDetail = $this->resourceToArray($this->Database->ExecuteQuery($query));
		if($rsDetail){return $rsDetail;
		} else{return array("error" => 607);}	
	}
	public function getSlidderTheme(){
		$query = "SELECT  * FROM ThemeMaster WHERE ThemeStatus=1 AND Slidder=1";
		$rsDetail = $this->resourceToArray($this->Database->ExecuteQuery($query));
		if($rsDetail){return $rsDetail;
		} else{return array("error" => 607);}	
	}
	public function getCatTheme($Input){
		$query = "SELECT  t.Id, CId, t.Name, c.Name as CategpryName, t.Description, Preview, Images, Video, NoOfPhoto, NoOfVideo, NoOfText, Likes, Views FROM CategoryMaster c, ThemeMaster t WHERE c.Status=1 AND c.Id=t.CId AND t.CId='$Input[cid]' AND t.ThemeStatus=1";
		$rsDetail = $this->resourceToArray($this->Database->ExecuteQuery($query));
		if($rsDetail){return $rsDetail;
		} else{return array("error" => 607);}	
	}
}
?>