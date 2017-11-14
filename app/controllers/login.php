<?php 
class Login extends Controller{
	public function __construct(){
		parent::__construct();
		$this->Modal = $this->load_Modal('loginModel');	
		$this->Url->setBaseurl(ADMIN_URL);
	}
	public function checksignup(){
		$Input = $this->Input->getInputValue();
		$result = $this->Modal->setUserSignup($Input);	
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
	public function fileupload(){
		$Input = $this->Input->getInputValue();
		$result = $this->Modal->fileUpload($Input);
		return $result;
	}
}
?>