<?php 
require_once('config/config.php');
require_once('config/route.php');
if(!is_dir(UPLOAD_DIR)){	mkdir(UPLOAD_DIR,0755); }
$GET = $Url->getUrlSegment();
$GET = explode('/',$GET);
$isApiRequest = strtolower($GET[0])=='api'?true:false;
$isAdmin = strtolower($GET[0])=='admin'?true:false;
$isCMS = strtolower($GET[0])=='cms'?true:false;
if($isApiRequest):
	require_once(BASE_PATH.'/lib/classes/class.api-request.php');
	require_once(BASE_PATH.'/api/route.api.php');
	require_once(BASE_PATH.'/api/index.php');
elseif($isAdmin):
	$Request  = $AdminUrl->getRoute($admin_route);
	$Request = trim($Request,'/');
	$Request = explode('/',$Request);
	$ControllerFile = DIR_CONTROLLER.DS.$Request[0].'.php'; 
	$ControllerFile = file_exists($ControllerFile)?$ControllerFile:false;
	if($ControllerFile){
		require_once($ControllerFile);
		if(class_exists($Request[0])){
			$Controller = new $Request[0]();
			if(method_exists($Controller,$Request[1])){
				$Controller->$Request[1]();
			}else{
			}
		}else{
		}
	}else{
		echo '<h1 style="text-align:center">404</h1>';
	}
else:
	$Request  = $Url->getRoute($route);
	$Request = trim($Request,'/');
	$Request = explode('/',$Request);
	$ControllerFile = DIR_CONTROLLER.DS.$Request[0].'.php'; 
	$ControllerFile = file_exists($ControllerFile)?$ControllerFile:false;
	if($ControllerFile){
		require_once($ControllerFile);
		if(class_exists($Request[0])){
			$Controller = new $Request[0]();
			if(method_exists($Controller,$Request[1])){
				$Controller->$Request[1]();
			}else{
			}
		}
	}else{
		echo '<h1 style="text-align:center">404</h1>';
	}
endif;