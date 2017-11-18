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
		//if(isset($_SESSION['user'])):
			$this->Url->redirect(ADMIN_URL.'user/');
		//endif;
		//$content = $this->load_view('admin/login',$data);
		//$this->Template->setContent($content);
		//$this->Template->render();
	}
	public function user(){
		$data = array();
		$result = $this->Modal->getUserDetail();
		$data['userList'] = $result;
		$header = $this->load_view('admin/templates/header');
		$footer = $this->load_view('admin/templates/footer');
		$this->Template->setTemplate($header,$footer);
		$content = $this->load_view('admin/app_views/user',$data);
		$this->Template->setContent($content);
		$this->Template->render();
	}
	public function category(){
		$data = array();
		$result = $this->Modal->getAllCategoryDetail();
		$data['tab_1'] = $result;
		$url = $this->Url->getUrlSegment();
		$GET = explode('/',$url);
		
		$categoryUpdateId = isset($GET[1])&&isset($GET[2])&&is_numeric($GET[2])&&$GET[1]=='update'?$GET[2]:false;
		$categoryStatusId = isset($GET[1])&&isset($GET[2])&&is_numeric($GET[2])&&$GET[1]=='status'?$GET[2]:false;
		$categoryDeleteId = isset($GET[1])&&isset($GET[2])&&is_numeric($GET[2])&&$GET[1]=='delete'?$GET[2]:false;
		
		if($categoryDeleteId):
			$this->Modal->deleteCategory($categoryDeleteId);
			$data['message'] = "Record has been deleted successfully";
			$this->Url->redirect($this->Url->getBaseUrl().'category');
		endif;
		
		if($categoryStatusId):
			$this->Modal->setCategoryStatus($categoryStatusId);
			$this->Url->redirect($this->Url->getBaseUrl().'category');
		endif;
		if(isset($GET[1]) && isset($GET[2]) && is_numeric($GET[2])):
			$action = $GET[1];
			$appUpdateId = $GET[2];
			$data['categoryUpdateId'] = $categoryUpdateId;
			$result = $this->Modal->getInvidualCategory($categoryUpdateId);
			$data['cat_detail'] = $result;
		endif;
		if($this->Input->isPostback):	
			$Input = $this->Input->getInputValue();
			if(empty($_FILES['fileIcon']['name']) && $GET[1]=='update'):
				$IconFile=$Input['icon'];
			else:
				$IconFile='uploads/cat_icon/'.time().$_FILES["fileIcon"]["name"];
				move_uploaded_file($_FILES["fileIcon"]["tmp_name"],$IconFile);
			endif;
			$Form = array(
						array('txtCatName','text'),
						array('txtDesc','text'),
					);
			if($this->Form->validate($Form)):
					if($this->Modal->setCategoryDetail($Input,$IconFile,$categoryUpdateId)):
						$this->Url->redirect($this->Url->getBaseUrl().'category/');
					else:
						$data['error'] = "email address already exists";
					endif;
			else:
				$data['error'] = "Invalid Form";
			endif;
		endif;
				$catDetail =$this->Modal->getCategoryDetail();
		$data['category'] = array(
			'type' => 'resource',
			'contant'=>array(
				'resource' => $catDetail,
				'value_field' => 'Id',
				'label_field' => 'Name'
			)
		);
		$catDetail1 =$this->Modal->getCategoryDetail();
		$data['category1'] = array(
			'type' => 'resource',
			'contant'=>array(
				'resource' => $catDetail1,
				'value_field' => 'Id',
				'label_field' => 'Name'
			)
		);

		$header = $this->load_view('admin/templates/header');
		$footer = $this->load_view('admin/templates/footer');
		$this->Template->setTemplate($header,$footer);
		$content = $this->load_view('admin/app_views/category',$data);
		$this->Template->setContent($content);
		$this->Template->render();
	}
	public function logout(){
		unset($_SESSION['user']);
		$var = session_destroy();
		if($var){
			$this->Url->redirect(ADMIN_URL.'login/');
		}else{
			$this->Url->redirect(ADMIN_URL.'user/');
		}
	}
}