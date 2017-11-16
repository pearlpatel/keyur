<?php 
class Inbuilt extends Controller{
	public function __construct(){
		parent::__construct();
		$this->Modal = $this->load_Modal('inbuiltModel');	
		$this->Url->setBaseurl(ADMIN_URL);
	}
	public function getcategory(){
		$result = $this->Modal->getCategoryDetail();	
		return $result;
	}	
	public function getalltheme(){
		$result = $this->Modal->getAllTheme();	
		return $result;
	}	
	public function gettoptheme(){
		$result = $this->Modal->getTopTheme();	
		return $result;
	}	
	public function getsliddertheme(){
		$result = $this->Modal->getSlidderTheme();	
		return $result;
	}	
	public function getcattheme(){
		$Input = $this->Input->getInputValue();
		$result = $this->Modal->getCatTheme($Input);	
		return $result;
	}	
	
}
?>