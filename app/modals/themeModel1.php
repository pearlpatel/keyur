<?php
class ThemeModel extends Modal{
	public function __construct(){
		parent::__construct();
	}
	public function deleteTheme($themeId){
		$query = "DELETE FROM ThemeMaster WHERE Id = '$themeId'";
		$this->Database->ExecuteNoneQuery($query);	
	}
	public function setThemeStatus($themeId){
		$query = "SELECT ThemeStatus FROM ThemeMaster WHERE Id = '$themeId'";
		$resultset = $this->Database->getRow($query);
		if($resultset['ThemeStatus']==0){
			$query1 = "UPDATE ThemeMaster SET ThemeStatus='1' WHERE Id = '$themeId'";
		}else{
			$query1 = "UPDATE ThemeMaster SET ThemeStatus='0' WHERE Id = '$themeId'";
		}
		if($this->Database->ExecuteNoneQuery($query1) == 1):
			return true;
		else:
			return false;
		endif;
	}
	public function getInvidualThemeDetail($themeId){
		$query = "SELECT t.Id, t.Name, c.Name as CategoryName, t.Description, t.Preview, t.Images, t.Video, t.NoOfPhoto, t.NoOfVideo, t.NoOfText, t.Slidder, t.Top, t.Views, t.Likes FROM ThemeMaster t, CategoryMaster c WHERE t.Id = '$themeId' && t.CId=c.Id";
		$rsDetail =$this->Database->ExecuteQuery($query);
		return $rsDetail;
	}
	public function getInvidualTheme($themeId){
		$data=array();
		$query = "SELECT * FROM ThemeMaster WHERE Id = '$themeId'";
		$data['Theme'] = $this->Database->GetRow($query);
		$query = "SELECT Label FROM TextLabelMaster WHERE TId = '$themeId'";
		$data['LabelList'] = $this->resourceToArray($this->Database->ExecuteQuery($query));
		return $data;
	}
	public function getCategoryDetail(){
		$query = "SELECT  * FROM CategoryMaster WHERE Status=1";
		$rsDetail =$this->Database->ExecuteQuery($query);
		return $rsDetail;
	}
	public function getTheme(){
		$query = "SELECT t.Id, t.Name, t.Description, c.Name as Category, Preview, ThemeStatus FROM ThemeMaster t, CategoryMaster c WHERE t.CId=c.Id AND c.Status='1'";
		$rsDetail =$this->Database->ExecuteQuery($query);
		return $rsDetail;
	}
	public function getCategoryTheme($CId){
		$query = "SELECT t.Id, t.Name, t.Description, c.Name as Category, Preview, Slidder, top, ThemeStatus FROM ThemeMaster t, CategoryMaster c WHERE t.CId=c.Id AND t.CId='$CId'";
		$rsDetail =$this->Database->ExecuteQuery($query);
		return $rsDetail;
	}
	public function setTheme($Input,$themeId,$image,$images,$video){
		$query = "SELECT * FROM ThemeMaster WHERE Id <> '$themeId'";
		$resultset = $this->Database->getRow($query);
		if($this->Database->getLastAffectedRow($resultset) <1):
			return false;
		else:
			$join_date =date('Y-m-d h:i:s');	
			if(isset($themeId) && $themeId):
				$query = "UPDATE ThemeMaster SET Name ='$Input[txtThemeName]',Description='$Input[txtDesc]', NoOfPhoto='$Input[txtNoOfPhoto]', NoOfVideo='$Input[txtNoOfVideo]', NoOfText='$Input[txtNoOfText]', Description = '$Input[txtDesc]', Preview = '$image', Images = '$images', Video = '$video', CId='$Input[drpCatId]' WHERE Id = '$themeId'";
				$this->Database->ExecuteNoneQuery($query);
				$query="DELETE FROM TextLabelMaster WHERE TId='$themeId'";	
				$this->Database->ExecuteNoneQuery($query);		
			else:
				$query = "INSERT INTO ThemeMaster (CId, Name, Description, Preview, Images, Video, PostedDate, NoOfPhoto, NoOfVideo, NoOfText, Top) VALUES ($Input[drpCatId], '$Input[txtThemeName]',  '$Input[txtDesc]', '$image', '$images', '$video', NOW(), '$Input[txtNoOfPhoto]', '$Input[txtNoOfVideo]', '$Input[txtNoOfText]', '$Input[Top]')";	
				$this->Database->ExecuteNoneQuery($query);				
				$themeId=mysql_insert_id();
			endif;			
				$labels = $Input['label'];
				foreach( $labels as $label ) {
					$query = "INSERT INTO TextLabelMaster (TId, Label) VALUES ($themeId, '$label')";
					$this->Database->ExecuteNoneQuery($query);
				}			
			return true;
		endif;
	}
	public function addTopTheme($TId){
		
	}
	public function removeTopTheme($TId){
	
	}
	public function getTopTheme(){
		$data=array();
		$query = "SELECT t.Id, t.Name, t.Description, c.Name as Category, Preview FROM ThemeMaster t, CategoryMaster c WHERE t.CId=c.Id AND c.Status='1' AND t.ThemeStatus='1' AND Top='1'";
		$result =$this->Database->ExecuteQuery($query);
		//$query = "SELECT t.Id, t.Name, t.Description, c.Name as Category, Preview FROM ThemeMaster t, CategoryMaster c WHERE t.CId=c.Id AND c.Status='1' AND t.ThemeStatus='1' AND Top='0'";
		//$data['allTheme'] =$this->Database->ExecuteQuery($query);
		return $result;

	}

}
?>