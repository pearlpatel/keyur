<?php 
class App extends Controller{
	public function __construct(){
		parent::__construct();
		$this->Modal = $this->load_Modal('appModel');	
		$this->Url->setBaseurl(ADMIN_URL);
	}
	public function apps(){
		$data = array();
		$url = $this->Url->getUrlSegment();
		$GET = explode('/',$url);
		if(isset($GET[1]) && $GET[1] == "delete"):
			if($this->Modal->deleteApp($GET[2]))
			$data['Message'] = "Your record has been deleted";
			$this->Url->redirect($this->Url->getBaseUrl().'app/');
		endif;
		if(isset($GET[1]) && $GET[1]=='status'):
			$this->Modal->setAppStatus($GET[2]);
			$this->Url->redirect($this->Url->getBaseUrl().'app/');
		endif;	
		if(isset($GET[1]) && isset($GET[2]) && is_numeric($GET[2])):
			$action = $GET[1];
			$appUpdateId = $GET[2];
			$data['appUpdateId'] = $appUpdateId;
			$result = $this->Modal->getInvidualApp($appUpdateId);
			$data['app_detail'] = $result;
		else:
		// nothing to do
		endif;
		// Post Back Handlling including Database Handling
		if($this->Input->isPostback): 
			$Input = $this->Input->getInputValue();
			if(empty($_FILES['fileImage']['name']) && $GET[1]=='update'):
					$image=$Input['logo'];
			else:
				$upload_dir = BASE_PATH.DS.UPLOAD_LOGO;
				$this->File->Reset($upload_dir);
				$image = $this->File->UploadFile('fileImage');
				$image = str_replace(BASE_PATH,'',$image);
				$image = str_replace(DS,'/',$image);
			endif;
			if(empty($_FILES['iconImage']['name']) && $GET[1]=='update'):
					$iconImage=$Input['icon'];
			else:
				$upload_dir = BASE_PATH.DS.UPLOAD_ICON;
				$this->File->Reset($upload_dir);
				$iconImage = $this->File->UploadFile('iconImage');
				$iconImage = str_replace(BASE_PATH,'',$iconImage);
				$iconImage = str_replace(DS,'/',$iconImage);
			endif;
			if(empty($_FILES['bannerFile']['name']) && $GET[1]=='update'):
					$bannerFile=$Input['banner'];
			else:
				$upload_dir = BASE_PATH.DS.UPLOAD_BANNER;
				$this->File->Reset($upload_dir);
				$bannerFile = $this->File->UploadFile('bannerFile');
				$bannerFile = str_replace(BASE_PATH,'',$bannerFile);
				$bannerFile = str_replace(DS,'/',$bannerFile);
			endif;
			if(isset($GET[1])):
					if($GET[1]=='update'):
						$Form = array(
							array('drpDevAppId','number'),
							array('txtAppName','text'),
							array('txtPacName','text'),
							array('txtDesc','text'),
						);
					else:
						$Form = array(
							array('drpDevAppId','number'),
							array('txtAppName','text'),
							array('txtPacName','text'),
							array('txtDesc','text'),
							array('fileImage','file'),
							array('iconImage','file'),
							array('bannerFile','file')
						);
					endif;
					if($this->Form->validate($Form)):	// Form is valid							
							if($this->Modal->setApp($Input,$appUpdateId,$image,$bannerFile,$iconImage)):
								$data['Message'] = 'App has been Added/Updated';
								$this->Url->redirect($this->Url->getBaseUrl().'app/');
							else:
								$data['Message'] = 'Can not Add/Update App';
							endif;
					else:
						$data['Message'] = 'Invalid Form';
					endif;
			endif;
		endif;

		$DevAccDetail =$this->Modal->getDeveloperDetail();
		$data['developer_ac'] = array(
			'type' => 'resource',
			'contant'=>array(
				'resource' => $DevAccDetail,
				'value_field' => 'Id',
				'label_field' => 'AcName'
			)
		);
		$DevAccDetail1 =$this->Modal->getDeveloperDetail();
		$data['developer_acc'] = array(
			'type' => 'resource',
			'contant'=>array(
				'resource' => $DevAccDetail1,
				'value_field' => 'Id',
				'label_field' => 'AcName'
			)
		);
		if(isset($GET[1]) && is_numeric($GET[1])):
			$data['apps_detail'] = $this->Modal->getDevApp($GET[1]);
		else:
			$data['apps_detail'] = $this->Modal->getApp();
		endif;
		$header = $this->load_view('admin/templates/header');
		$footer = $this->load_view('admin/templates/footer');
		$this->Template->setTemplate($header,$footer);
		$content = $this->load_view('admin/app_views/app',$data);
		$this->Template->setContent($content);
		$this->Template->render();
	}
	
	public function viewAppDetail(){
		$url = $this->Url->getUrlSegment();
		$GET = explode('/',$url);
		$appId = isset($GET[1])?$GET[1]:'';
		$result= $this->Modal->getAppInfo($appId);
		$data['detail'] = $result;
		$header = $this->load_view('admin/templates/header');
		$footer = $this->load_view('admin/templates/footer');
		$this->Template->setTemplate($header,$footer);
		$content = $this->load_view('admin/app_views/appDetail',$data);
		$this->Template->setContent($content);
		$this->Template->render();
	}
}
?>