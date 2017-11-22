<?php 
class InbuiltModel extends Modal{
	public function __construct(){
		parent::__construct();
	}
	public function getData($Input){
		$data=array();
		if($Input['cid']){
			$query = "SELECT Id, Name, Icon, Description, ParentId, PostedDate FROM CategoryMaster WHERE Status=1 && Id >'$Input[cid]'";
			$rsDetail = $this->resourceToArray($this->Database->ExecuteQuery($query));
			$data['Category']= $rsDetail;
		}
		if($Input['tid']){
			$query = "SELECT Id, CId, Name, Description, Preview, Images, Video, Likes, Views, NoOfPhoto, NoOfVideo, NoOfText, PostedDate FROM ThemeMaster WHERE ThemeStatus=1 && Id >'$Input[tid]'";
			$rsTheme = $this->resourceToArray($this->Database->ExecuteQuery($query));
			$data['Theme']= $rsTheme;				
		}
		if($Input['top']){
			$top = "SELECT Id FROM ThemeMaster WHERE ThemeStatus=1 AND Top=1";
			$rsTop = $this->resourceToArray($this->Database->ExecuteQuery($top));
			$data['Top']= $rsTop;				
		}
		if($Input['slidder']){
			$top = "SELECT Id FROM ThemeMaster WHERE ThemeStatus=1 AND Slidder=1";
			$rsTop = $this->resourceToArray($this->Database->ExecuteQuery($top));
			$data['Slidder']= $rsTop;				
		}
		return $data;
	}
}
?>