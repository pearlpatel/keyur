<?php 
class Login extends Controller{
	public function __construct(){
		parent::__construct();
		$this->Modal = $this->load_Modal('loginModel');	
		$this->Url->setBaseurl(ADMIN_URL);
	}

	public function checksignup(){
		$Input = $this->Input->getInputValue();
		$result = $this->Modal->checkUserSignup($Input);	
		return $result;
	}
	public function usersignup(){
		$Input = $this->Input->getInputValue();
		$result = $this->Modal->userSignup($Input);	
		return $result;
	}	
	public function relogin(){
		$Input = $this->Input->getInputValue();
		$result = $this->Modal->userLogin($Input);
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