<?php
class Admin extends Controller{
	public function __construct(){
		parent::__construct();
		$this->Modal = $this->load_modal('index');
		$this->Modal = $this->load_modal('adminModel');	
		$this->Url->setBaseurl(ADMIN_URL);
	}	
	public function index(){
		$Input = $this->Input->getInputValue();
		return $Input;
	}
	public function login(){
		$data = array();
		if($this->Input->isPostback):
			$Input = $this->Input->getInputValue();
			$Form = array(
				array('txtUserName','text'),
				array('txtPassword','text')
			);
			if($this->Form->validate($Form)):
				$result = $this->Modal->getLoginDetail($Input['txtUserName'],$Input['txtPassword']);	
			else:
				$data['error'] = "Invalid Form";
			endif;
			if($result):
				$_SESSION['user'] = $result;
			else:
				$data['error'] = "Invalid User Name and Password";
			endif;
		endif;
		if(isset($_SESSION['user'])):
			$this->Url->redirect(ADMIN_URL.'developer/');
		endif;
		$content = $this->load_view('admin/login',$data);
		$this->Template->setContent($content);
		$this->Template->render();
	}
	public function developer(){
		$data = array();
		$result = $this->Modal->getDeveloperDetail();
		$data['tab_1'] = $result;
		$url = $this->Url->getUrlSegment();
		$GET = explode('/',$url);
		if(isset($GET[2])):
			$developerId = isset($GET[2])?$GET[2]:'';
			$result = $this->Modal->getDeveloperDetail($developerId);
			$data['tab_2'] = $result;
		endif;
		
		$developerUpdateId = isset($GET[2])&&isset($GET[3])&&is_numeric($GET[3])&&$GET[2]=='update'?$GET[3]:false;
		$developerStatusId = isset($GET[1])&&isset($GET[2])&&is_numeric($GET[2])&&$GET[1]=='status'?$GET[2]:false;
		$developerDeleteId = isset($GET[1])&&isset($GET[2])&&is_numeric($GET[2])&&$GET[1]=='delete'?$GET[2]:false;
		
		if($developerDeleteId):
			$this->Modal->deleteUser($developerId);
			$data['message'] = "Record has been deleted successfully";
			$this->Url->redirect($this->Url->getBaseUrl().'developer');
		endif;
		
		if($developerStatusId):
			$this->Modal->setDeveloperStatus($developerStatusId);
			$this->Url->redirect($this->Url->getBaseUrl().'developer');
		endif;
		if($this->Input->isPostback):	
			$Input = $this->Input->getInputValue();
			$Form = array(
						array('txtName','text'),
						array('txtEmail','email'),
					);
			if($this->Form->validate($Form)):
					if($this->Modal->setDeveloperDetail($Input,$developerId)):
						$this->Url->redirect($this->Url->getBaseUrl().'developer/');
					else:
						$data['error'] = "email address already exists";
					endif;
			else:
				$data['error'] = "Invalid Form";
			endif;
		endif;
		$header = $this->load_view('admin/templates/header');
		$footer = $this->load_view('admin/templates/footer');
		$this->Template->setTemplate($header,$footer);
		$content = $this->load_view('admin/app_views/developer',$data);
		$this->Template->setContent($content);
		$this->Template->render();
	}
	public function logout(){
		unset($_SESSION['user']);
		$var = session_destroy();
		if($var){
			$this->Url->redirect(ADMIN_URL.'login/');
		}else{
			$this->Url->redirect(ADMIN_URL.'developer/');
		}
	}
}