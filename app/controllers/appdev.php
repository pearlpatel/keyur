<?php 
class AppDev extends Controller{
	public function __construct(){
		parent::__construct();
		$this->Modal = $this->load_Modal('appDevModel');	
		$this->Url->setBaseurl(ADMIN_URL);
	}

	public function setpriority(){
		$Input = $this->Input->getInputValue();
		$result = $this->Modal->setAppLinkPriority($Input);	
		return $result;
	}
	public function linkdevapp(){
		$Input = $this->Input->getInputValue();
		$result = $this->Modal->linkDevApp($Input);	
		return $result;
	}	
	public function unlinkdevapp(){
		$Input = $this->Input->getInputValue();
		$result = $this->Modal->unlinkDevApp($Input);	
		return $result;
	}	
	public function setview(){
		$Input = $this->Input->getInputValue();
		$result = $this->Modal->setAppView($Input);	
		return $result;
	}
	public function setdownload(){
		$Input = $this->Input->getInputValue();
		$result = $this->Modal->setAppDownload($Input);	
		return $result;
	}
	public function getappdata(){
		$Input = $this->Input->getInputValue();
		$result = $this->Modal->appByPackName($Input);	
		return $result;
	}
}
?>