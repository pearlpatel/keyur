<?php 
class Inbuilt extends Controller{
	public function __construct(){
		parent::__construct();
		$this->Modal = $this->load_Modal('inbuiltModel');	
		$this->Url->setBaseurl(ADMIN_URL);
	}
	public function getdata(){
		$Input = $this->Input->getInputValue();
		$result = $this->Modal->getData($Input);	
		return $result;
	}
	
}
?>