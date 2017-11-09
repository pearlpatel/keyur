<?php
class Input {
	public $isPostback;
	public function __construct(){
		$this->isPostback = count($_POST)>0?TRUE:FALSE;	
	}
	private function _fetchFromArray($array,$index){
		if(is_object($array)){
			$array = (array) $array;	
		}
		if(is_array($array)){
			if(isset($array[$index])){
				return $array[$index];
			}
		}
		return false;
	}	

	public function getContentType(){
		$CotentType = substr($this->Server('CONTENT_TYPE').';',0,strpos($this->Server('CONTENT_TYPE'),';'));
		if(empty($CotentType)){
			return $this->Server('CONTENT_TYPE');	
		}
		return $CotentType;
	}

	public function getMethod(){
		return $this->Server('REQUEST_METHOD');
	}
	public function Post($index = false){
		if($index){
			return $this->_fetchFromArray($_POST,$index);	
		}else{
			return $_POST;	
		}
	}	
	public function Get($index = false){
		if($index){
			return $this->_fetchFromArray($_GET,$index);	
		}else{
			return $_GET;	
		}	
	}
	public function setSession($key,$value){
		$_SESSION[$key] = $value;	
	}

	public function Session($index = false){
		if($index){
			return $this->_fetchFromArray($_SESSION,$index);	
		}else{
			return $_SESSION;	
		}	
	}
	public function Server($index = false){
		if($index){
			return $this->_fetchFromArray($_SERVER,$index);	
		}else{
			return $_SERVER;	
		}
	}

	public function Put($index = false){
		return false;
	}

	public function getInputValue($type =false){
		if(! $type){ $type = $this->getContentType(); }
		$Values = array();
		switch ($type){
			case 'application/json':
				// If Centent Type is "application/json"
					$input = urldecode(file_get_contents('php://input'));
					 //For Testing in client
					$Obje2 = explode('&',$input);
					if(count($Obje2)>=1){
						foreach($Obje2 as $param){
							$temp = array();
							$temp = explode('=',$param);
							$Values[$temp[0]] = $temp[1];
						}
					}

					// For Live (android Apps)
					//$Values = json_decode($input);
					
					// Converting Object into Array
					$Values = (array)$Values;
				break;
			case 'application/octet-stream':
			case 'multipart/form-data':
					$Values = $_REQUEST;
					foreach($_FILES as $Key=>$File){
						$Values[$Key] = $File;
					}
				break;
			default:
					//$input = urldecode(file_get_contents('php://input'));
					switch($this->getMethod()){
						case 'GET':
								$Values = $this->Get();
							break;
						case 'POST':
								$Values = $this->Post();
							break;
						case 'PUT':
								$Values = $this->Put();
							break;
						case 'DELETE':
							break;	
					}
				break;
		}
		return $Values;
	}
}