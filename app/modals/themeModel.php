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
	public function getInvidualTheme($themeId){
		$query = "SELECT * FROM ThemeMaster WHERE Id = '$themeId'";
		$result = $this->Database->getRow($query);
		return $result;
	}
	public function getCategoryDetail(){
		$query = "SELECT  * FROM CategoryMaster WHERE Status=1 AND Id<>1 ORDER BY ParentId";
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
	public function setTheme($Input,$themeUpdateId,$image,$images,$video){
		$query = "SELECT * FROM ThemeMaster WHERE Id <> '$themeUpdateId'";
		$resultset = $this->Database->getRow($query);
		if($this->Database->getLastAffectedRow($resultset) <1):
			return false;
		else:
			$join_date =date('Y-m-d h:i:s');	
			if(isset($themeUpdateId) && $themeUpdateId):
				$query = "UPDATE ThemeMaster SET Name ='$Input[txtThemeName]',Description='$Input[txtDesc]', NoOfPhoto='$Input[txtNoOfPhoto]', NoOfVideo='$Input[txtNoOfVideo]', NoOfText='$Input[txtNoOfText]', Description = '$Input[txtDesc]', Preview = '$image', Images = '$images', Video = '$video', CId='$Input[drpCatId]' WHERE Id = '$themeUpdateId'";					
			else:
				$query = "INSERT INTO ThemeMaster (CId, Name, Description, Preview, Images, Video, PostedDate, NoOfPhoto, NoOfVideo, NoOfText) VALUES ($Input[drpCatId], '$Input[txtThemeName]',  '$Input[txtDesc]', '$image', '$images', '$video', NOW(), '$Input[txtNoOfPhoto]', '$Input[txtNoOfVideo]', '$Input[txtNoOfText]')";					
			endif;
			if($this->Database->ExecuteNoneQuery($query) == 1):
				return true;
			else:
				return false;
			endif;
		endif;
	}
}
?>