<?php 
class HotLink extends Controller{
	public function __construct(){
		parent::__construct();
		$this->Modal = $this->load_Modal('hotLinkModel');	
		$this->Url->setBaseurl(ADMIN_URL);
	}
	public function link(){
		$data = array();
		$url = $this->Url->getUrlSegment();
		$GET = explode('/',$url);
		
		if(isset($GET[1]) && $GET[1]=='link' && is_numeric($GET[2])):
			$appLinkDetail =$this->Modal->setHotLink($GET[2]);			
		endif;
		if(isset($GET[1]) && $GET[1]=='unlink' && is_numeric($GET[2])):
			$appLinkDetail =$this->Modal->unsetHotLink($GET[2]);			
		endif;
		
		$appDetail =$this->Modal->getAppForLink($GET[2], $GET[4]);
		$data['apps_info'] = $appDetail;
		$appLinkDetail =$this->Modal->getAppLinkDetail($GET[4]);
		$data['app_link_detail'] = $appLinkDetail;
				
		if(isset($GET[1]) && is_numeric($GET[2])):
			$this->Url->redirect($this->Url->getBaseUrl().'hotLink');			
		endif;
		
		$header = $this->load_view('admin/templates/header');
		$footer = $this->load_view('admin/templates/footer');
		$this->Template->setTemplate($header,$footer);
		$content = $this->load_view('admin/app_views/hotLink',$data);
		$this->Template->setContent($content);
		$this->Template->render();
	}
}
?>