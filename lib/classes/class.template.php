<?php
class Template{
	private $before_content;
	private $content;
	private $after_content;
	
	public $isAjaxCall;
	
	public function __construct(){
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			/* special ajax here */
			//alert('Ajax Call');
			$this->isAjaxCall = true;
		}else{
			$this->isAjaxCall = false;
			//alert('Normal Call');	
		}
		
	}
	
	public function setTemplate($header = false,$footer = false){
		if($header){
			$this->before_content = $header;
		}
		if($footer){
			$this->after_content = $footer;	
		}
		return true;
	}
	
	public function setContent($content = false){
		if($content){
			$this->content = $content;
			return true;
		}else{
			return false;	
		}
	}
	public function getContent(){
		return $this->content;	
	}
	
	public function getHtml(){
		if($this->isAjaxCall){
			return $this->content;
		}else{
			return $this->before_content.$this->content.$this->after_content;	
		}
		
	}
	public function render(){
		echo $this->getHtml();
		return true;
	}
}