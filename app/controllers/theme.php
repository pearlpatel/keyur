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
	public function viewthemedetail(){
		$data = array();
		$url = $this->Url->getUrlSegment();
		$GET = explode('/',$url);
		if(isset($GET[1]) && is_numeric($GET[1])):
			$result = $this->Modal->getInvidualThemeDetail($GET[1]);
			$data['theme_detail'] = $result;
		endif;
		$header = $this->load_view('admin/templates/header');
		$footer = $this->load_view('admin/templates/footer');
		$this->Template->setTemplate($header,$footer);
		$content = $this->load_view('admin/app_views/viewthemedetail',$data);
		$this->Template->setContent($content);
		$this->Template->render();
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
			$preview='';$video='';
			$Input = $this->Input->getInputValue();
			if(empty($_FILES['imagePreview']['name']) && $GET[1]=='update'):
				$preview=$Input['imagepreview'];
			else:
				$newfilename=$this->File->resizeFile('imagePreview');
				$preview='uploads/theme_preview/'.$newfilename;
				move_uploaded_file($_FILES["imagePreview"]["tmp_name"],$preview);

			endif;
			if(empty($_FILES['Video']['name']) && $GET[1]=='update'):
				$video=$Input['video'];
			else:
				$target_dir = "uploads/theme_video/";
				$video = $target_dir . time().basename($_FILES["Video"]["name"]);
				move_uploaded_file($_FILES["Video"]["tmp_name"],$video);
			endif;
			$images='';			
			foreach($_FILES["imagePreview2"]["tmp_name"] as $key=>$tmp_name)
			{		
					$newFileName=time().$_FILES["imagePreview2"]["name"][$key];
					$fileName = $_FILES["imagePreview2"]["name"][$key];
					if($fileName!=''){
						switch(strtolower($_FILES["imagePreview2"]['type'][$key]))
						{
							case 'image/jpeg':
								$image = imagecreatefromjpeg($_FILES["imagePreview2"]['tmp_name'][$key]);
								break;
							case 'image/png':
								$image = imagecreatefrompng($_FILES["imagePreview2"]['tmp_name'][$key]);
								break;
							case 'image/gif':
								$image = imagecreatefromgif($_FILES["imagePreview2"]['tmp_name'][$key]);
								break;
						}
						// Target dimensions
						list($image_width, $image_height) = getimagesize($_FILES["imagePreview2"]["tmp_name"][$key]);
						$new_width=floor(($image_width*20)/100);
						$new_height=floor(($image_height/$image_width)*$new_width);
						// Get current dimensions
						$old_width  = imagesx($image);
						$old_height = imagesy($image);
						
						// Create new empty image
						$new = imagecreatetruecolor($new_width, $new_height);
						
						// Resize old image into new
						imagecopyresampled($new, $image, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);
						$new_name=time().$_FILES["imagePreview2"]['name'][$key];
						// Catch the imagedata
						ob_start();
						imagejpeg($new, 'uploads/greed_images/'.$new_name, 90);
						// Destroy resources
						imagedestroy($image);
						imagedestroy($new);
						
						$newFileName='uploads/theme_images/'.$new_name;
						move_uploaded_file($_FILES["imagePreview2"]["tmp_name"][$key],$newFileName);
						if($images==''){$images=$newFileName;
						}else{
							$images=$images.';'.$newFileName;
						}							  
					}
			}
			if($GET[1]=='update' && $images==''):
				$images=$Input['imagepreview2'];
			endif;
			if(isset($GET[1]) && ($GET[1]=='update' || $GET[1]=='add')):
					if($this->Modal->setTheme($Input,$themeUpdateId,$preview,$images, $video)):
						$data['Message'] = 'Theme has been Added/Updated';
						$this->Url->redirect($this->Url->getBaseUrl().'theme/');
					else:
						$data['Message'] = 'Can not Add/Update Theme';
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
	public function top(){
		$data = array();
		$url = $this->Url->getUrlSegment();
		$GET = explode('/',$url);		
		if(isset($GET[1]) && $GET[1]=='remove' && is_numeric($GET[2])):
			$this->Modal->removeTopTheme($GET[2]);	
			$this->Url->redirect($this->Url->getBaseUrl().'top');		
		endif;
		if(isset($GET[1]) && $GET[1]=='add' && is_numeric($GET[2])):
			$this->Modal->addTopTheme($GET[2]);	
			$this->Url->redirect($this->Url->getBaseUrl().'top');		
		endif;	
		$themeDetail =$this->Modal->getTopTheme();
		$data['top_theme_detail'] = $themeDetail;
		$themeDetail =$this->Modal->getWitoutTopTheme();
		$data['theme_detail'] = $themeDetail;
		$header = $this->load_view('admin/templates/header');
		$footer = $this->load_view('admin/templates/footer');
		$this->Template->setTemplate($header,$footer);
		$content = $this->load_view('admin/app_views/top',$data);
		$this->Template->setContent($content);
		$this->Template->render();
	}
	public function slidder(){
		$data = array();
		$url = $this->Url->getUrlSegment();
		$GET = explode('/',$url);		
		if(isset($GET[1]) && $GET[1]=='remove' && is_numeric($GET[2])):
			$this->Modal->removeSlidderTheme($GET[2]);	
			$this->Url->redirect($this->Url->getBaseUrl().'slidder');		
		endif;
		if(isset($GET[1]) && $GET[1]=='add' && is_numeric($GET[2])):
			$this->Modal->addSliderTheme($GET[2]);	
			$this->Url->redirect($this->Url->getBaseUrl().'slidder');		
		endif;	
		$themeDetail =$this->Modal->getSlidderTheme();
		$data['slidder_theme_detail'] = $themeDetail;
		$themeDetail =$this->Modal->getWitoutSlidderTheme();
		$data['theme_detail'] = $themeDetail;
		$header = $this->load_view('admin/templates/header');
		$footer = $this->load_view('admin/templates/footer');
		$this->Template->setTemplate($header,$footer);
		$content = $this->load_view('admin/app_views/slidder',$data);
		$this->Template->setContent($content);
		$this->Template->render();
	}
}