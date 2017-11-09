<?php

class Index extends Controller{
	public function __construct(){
		parent::__construct();
		$this->Modal = $this->load_modal('index');
		
		$this->Url->setBaseurl(ADMIN_URL);
	}	
	public function index(){
		$Input = $this->Input->getInputValue();
		return $Input;
	}
	public function getError(){
			return array('error'=>604);
	}
}