<?php 
class InbuiltModel extends Modal{
	public function __construct(){
		parent::__construct();
	}
	public function getData($Input){
		$data=array();
		$response = array();
		if($Input['cid']){
			$query = "SELECT Id, Name, Icon, Description, ParentId, PostedDate FROM CategoryMaster WHERE Status=1 && Id >'$Input[cid]'";
			$rsDetail = $this->resourceToArray($this->Database->ExecuteQuery($query));
			$data['Category']= $rsDetail;
		}
		if($Input['tid']){
			$query = "SELECT Id, CId, Name, Description, Preview, Images, Video, Likes, Views, NoOfPhoto, NoOfVideo, NoOfText, PostedDate FROM ThemeMaster WHERE ThemeStatus=1 && Id >'$Input[tid]'";
			$rsTheme = $this->resourceToArray($this->Database->ExecuteQuery($query));
			if($rsTheme):
					foreach($rsTheme as $key=>$value){
						$response[$key]['Id'] = $value['Id'];
						$response[$key]['CId'] = $value['CId'];
						$response[$key]['Name'] = $value['Name'];
						$response[$key]['Description'] = $value['Description'];
						$response[$key]['Preview'] = $value['Preview'];
						$response[$key]['Images'] = $value['Images'];
						$response[$key]['Video'] = $value['Video'];
						$response[$key]['Likes'] = $value['Likes'];
						$response[$key]['Views'] = $value['Views'];
						$response[$key]['NoOfPhoto'] = $value['NoOfPhoto'];
						$response[$key]['NoOfVideo'] = $value['NoOfVideo'];
						$response[$key]['NoOfText'] = $value['NoOfText'];
						$response[$key]['PostedDate'] = $value['PostedDate'];
						$responseLabel = array();
						$queryLabel = "SELECT Label FROM TextLabelMaster WHERE TId = '$value[Id]'";
						$resultLabel = $this->resourceToArray($this->Database->ExecuteQuery($queryLabel));
						foreach($resultLabel as $key1 => $value1){
							$responseLabel[$key1]['Label'] = $value1['Label'];
						}

						$response[$key]['LabelList'] = $responseLabel;
					}
			endif;
			$data['Theme']= $response;				
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