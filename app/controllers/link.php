<?php 
class Link extends Controller{
	public function __construct(){
		parent::__construct();
		$this->Modal = $this->load_Modal('linkModel');	
		$this->Url->setBaseurl(ADMIN_URL);
	}
	public function link(){
		$data = array();
		$url = $this->Url->getUrlSegment();
		$GET = explode('/',$url);
		$DevAccDetail =$this->Modal->getDeveloperDetail();
		$data['developer_ac'] = array(
			'type' => 'resource',
			'contant'=>array(
				'resource' => $DevAccDetail,
				'value_field' => 'Id',
				'label_field' => 'AcName'
			)
		);
		if(isset($GET[1]) && $GET[1]=="dev" && isset($GET[2]) && is_numeric($GET[2])):
			$appDetail =$this->Modal->getDevApp($GET[2]);
			$data['app_info'] = array(
				'type' => 'resource',
				'contant'=>array(
					'resource' => $appDetail,
					'value_field' => 'Id',
					'label_field' => 'AppName'
				)
			);
		endif;
		if(isset($GET[5]) && $GET[5]=='link' && is_numeric($GET[6])):
			$appLinkDetail =$this->Modal->linkAppDetail($GET[4], $GET[6]);			
		endif;
		if(isset($GET[5]) && $GET[5]=='unlink' && is_numeric($GET[6])):
			$appLinkDetail =$this->Modal->unlinkAppDetail($GET[4], $GET[6]);			
		endif;
		if(isset($GET[5]) && $GET[5]=='banner' && is_numeric($GET[6])):
			$appLinkDetail =$this->Modal->setLinkAppBanner($GET[4], $GET[6]);			
		endif;
		if(isset($GET[3]) && $GET[3]=="app" && isset($GET[4]) && is_numeric($GET[4])):
			$appDetail =$this->Modal->getAppForLink($GET[2], $GET[4]);
			$data['apps_info'] = $appDetail;
			$appLinkDetail =$this->Modal->getAppLinkDetail($GET[4]);
			$data['app_link_detail'] = $appLinkDetail;
		endif;
		if(isset($GET[5]) && is_numeric($GET[6])):
			$this->Url->redirect($this->Url->getBaseUrl().'link/dev/'.$GET[2].'/app/'.$GET[4]);			
		endif;
		$header = $this->load_view('admin/templates/header');
		$footer = $this->load_view('admin/templates/footer');
		$this->Template->setTemplate($header,$footer);
		$content = $this->load_view('admin/app_views/link',$data);
		$this->Template->setContent($content);
		$this->Template->render();
	}
}
?>