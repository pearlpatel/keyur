<?php
class Theme extends Controller{
	public function __construct(){
		parent::__construct();
		$this->Modal = $this->load_modal('index');
		$this->Modal = $this->load_modal('themeModel');	
		$this->Url->setBaseurl(ADMIN_URL);
	}	
	public function index(){
		$Input = $this->Input->getInputValue();
		return $Input;
	}
	public function theme(){
		$data = array();
		$extension = array("jpeg","jpg","png","gif");
		$url = $this->Url->getUrlSegment();
		$GET = explode('/',$url);
		if(isset($GET[1]) && $GET[1] == "delete"):
			if($this->Modal->deleteTheme($GET[2]))
			$data['Message'] = "Your record has been deleted";
			$this->Url->redirect($this->Url->getBaseUrl().'theme/');
		endif;
		if(isset($GET[1]) && $GET[1]=='status'):
			$this->Modal->setThemeStatus($GET[2]);
			$this->Url->redirect($this->Url->getBaseUrl().'theme/');
		endif;
		if(isset($GET[1]) && isset($GET[2]) && is_numeric($GET[2])):
			$action = $GET[1];
			$themeUpdateId = $GET[2];
			$data['themeUpdateId'] = $themeUpdateId;
			$result = $this->Modal->getInvidualTheme($themeUpdateId);
			$data['theme_detail'] = $result;
		endif;
		// Post Back Handlling including Database Handling
		if($this->Input->isPostback): 
			$Input = $this->Input->getInputValue();
			if(empty($_FILES['imagePreview']['name']) && $GET[1]=='update'):
				$image=$Input['imagepreview'];
			else:
				//$newfilename = time().$_FILES['imagePreview']['name'];
				$newfilename=$this->File->resizeFile('imagePreview');
				
				$upload_dir = BASE_PATH.UPLOAD_THEME_PREVIEW;
				$this->File->Reset($upload_dir);
				$image = $this->File->UploadFile('imagePreview',$newfilename);
				$image = str_replace(BASE_PATH,'',$image);
				$image = str_replace(DS,'/',$image);
			endif;
			if(empty($_FILES['Video']['name']) && $GET[1]=='update'):
				$video=$Input['video'];
			else:
				$newFileName=UPLOAD_THEME_VIDEO.time().$_FILES['Video']['name'];                
				move_uploaded_file($_FILES["Video"]["tmp_name"][$key],$newFileName);
				$video=$newFileName;
			endif;
			$images='';			
			foreach($_FILES["imagePreview2"]["tmp_name"] as $key=>$tmp_name)
			{	
					$newFileName=time().$_FILES["imagePreview2"]["name"][$key];
					$fileName = $_FILES["imagePreview2"]["name"][$key];
					
					/*if($_FILES['imagePreview2']["type"][$key] == "image/jpeg" || $_FILES['imagePreview2']["type"][$key] == "image/pjpeg"){	
						$image_source = imagecreatefromjpeg($_FILES[$objName]["tmp_name"][$key]);
					}		
					if($_FILES['imagePreview2']["type"][$key] == "image/gif"){	
						$image_source = imagecreatefromgif($_FILES['imagePreview2']["tmp_name"][$key]);
					}	
					if($_FILES['imagePreview2']["type"][$key] == "image/bmp"){	
						$image_source = imagecreatefromwbmp($_FILES['imagePreview2']["tmp_name"][$key]);
					}			
					if($_FILES['imagePreview2']["type"][$key] == "image/x-png"){
						$image_source = imagecreatefrompng($_FILES['imagePreview2']["tmp_name"][$key]);
					}
					
					$remote_file = UPLOAD_GREED_IMAGES.$_FILES['imagePreview2']["name"][$key];
					imagejpeg($image_source,$remote_file,100);
					chmod($remote_file,0644);
					*/
					/*list($image_width, $image_height) = getimagesize($_FILES['imagePreview2']["tmp_name"][$key]);
					$new_width=floor(($image_width*20)/100);
					$new_height=floor(($image_height/$image_width)*$new_width);
				
					$new_image = imagecreatetruecolor($new_width , $new_height);
					$image_source = imagecreatefromjpeg($remote_file);
					
					imagecopyresampled($new_image, $image_source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
					imagejpeg($new_image,UPLOAD_GREED_IMAGES.$newfilename,100);*/
					//unlink($remote_file);
					//$this->File->resizeFile('imagePreview',UPLOAD_GREED_IMAGES.$newfilename);
					$newFileName=UPLOAD_THEME_IMAGES.$newFileName;
					move_uploaded_file($_FILES["imagePreview2"]["tmp_name"][$key],$newFileName);
					if($images==''){$images=$newFileName;
					}else{
						$images=$images.';'.$newFileName;
					}							  
				
			}
			if($GET[1]=='update' && $images==''):
				$images=$Input['imagepreview2'];
			endif;
			if(isset($GET[1])):
					if($GET[1]=='update'):
						$Form = array(
							array('drpCatId','number'),
							array('txtThemeName','text'),
							array('txtDesc','text'),
							array('txtNoOfPhoto','text'),
							array('txtNoOfVideo','text'),
							array('txtNoOfText','text')
						);
					else:
						$Form = array(
							array('drpCatId','number'),
							array('txtThemeName','text'),
							array('txtDesc','text'),
							array('txtNoOfPhoto','text'),
							array('txtNoOfVideo','text'),
							array('txtNoOfText','text')//,
							//array('imagePreview','file')
						);
					endif;
					if($this->Form->validate($Form)):	// Form is valid	
							if($this->Modal->setTheme($Input,$themeUpdateId,$image,$images, $video)):
								$data['Message'] = 'Theme has been Added/Updated';
								//$this->Url->redirect($this->Url->getBaseUrl().'theme/');
							else:
								$data['Message'] = 'Can not Add/Update Theme';
							endif;
					else:
						$data['Message'] = 'Invalid Form';
					endif;
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
		if(isset($GET[1]) && is_numeric($GET[1])):
			$data['theme_detail2'] = $this->Modal->getInvidualTheme($GET[2]);
		else:
			$data['theme_detail1'] = $this->Modal->getTheme();
		endif;
		$header = $this->load_view('admin/templates/header');
		$footer = $this->load_view('admin/templates/footer');
		$this->Template->setTemplate($header,$footer);
		$content = $this->load_view('admin/app_views/theme',$data);
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