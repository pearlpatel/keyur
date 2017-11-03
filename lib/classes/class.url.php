<?php

class Url{

	private $BaseUrl;

	public function __construct($BaseUrl = false){

		if($BaseUrl){

			$this->BaseUrl = $BaseUrl;

		}

		trim($this->BaseUrl);

	}

	

	public function setBaseUrl($BaseUrl){

		self::__construct($BaseUrl);

	}

	

	// Public function

	// To get BaseUrl Url

	public function getBaseUrl(){

		return $this->BaseUrl;

	}

	

	// Public function

	// To get Request Url	

	public function getRequestUrl(){

		return 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

	}

	

	// Public function 

	// Will return Segment of user that is after the base url

	public function getUrlSegment($segment = FALSE){

		

		  $result = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		 $result = str_replace('www.','',$result);
		$result = substr($result,strlen($this->BaseUrl));
		$result = str_replace(INDEX,'',$result);



		$result = trim($result,'/');

		

		if(is_numeric($segment) ):

			$segments = explode('/',$result);

			return $segments[$segment];

		endif;
		//echo $result;
		return  $result;

	}

	

	

	// Public function 

	// to Redirect the page

	public function redirect($url){

		//$url = $this->BaseUrl.$url;

		header('Location: '.$url)

		or

		die('<script> window.location="'.$url.'";</script>');

	}

	

	

	// public function 

	// return the route of url

	public function getRoute($routes,$getAll = false){

		//display($routes);

		$Route = array();

		$Request  = $this->getUrlSegment();

		$Request = str_replace('/','-',trim($Request,'/').'/');



		foreach($routes as $key=>$value){

			$RegExp = '/^'. str_replace('/','-',trim($key,'/').'/').'/';



			if(preg_match($RegExp, $Request)){

				$Route[] = $value;

			}

		}

		if($getAll){

			// if user want all Routes than 

			// it will return in array of all routes

			return $Route;	

		}else{

			// if user want Execution routes

			// then it will return first route

			if(isset($Route[0])){

				return $Route[0];		

			}else{

				return false;	

			}

			

			

		}

		

	}



}