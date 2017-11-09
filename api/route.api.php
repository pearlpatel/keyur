<?php 
$api_route = array();
$api_route['index'] = new ApiRequest(
							'index/index',
							'POST',
							false, //'application/json',
							array(
								'uid'=>array('type'=>'number','required'=>true)
							)
						);
$api_route['checksignup'] = new ApiRequest(
							'login/checksignup',
							'POST',
							false, 
							array(
								'email'=>array('type'=>'email','required'=>true),
								'phone'=>array('type'=>'number','required'=>true)																
							)
						);
$api_route['usersignup'] = new ApiRequest(
							'login/usersignup',
							'POST',
							false, 
							array(
								'email'=>array('type'=>'email','required'=>true),
								'phone'=>array('type'=>'number','required'=>true),
								'deviceid'=>array('type'=>'text','required'=>true),
								'username'=>array('type'=>'text','required'=>true),
								'profilepic'=>array('type'=>'text','required'=>true),
								'status'=>array('type'=>'text','required'=>true)
							)
						);					
$api_route['relogin'] = new ApiRequest(
							'login/relogin',
							'POST',
							false, 
							array(
								'email'=>array('type'=>'email','required'=>true),
								'phone'=>array('type'=>'number','required'=>true),
								'deviceid'=>array('type'=>'text','required'=>true)
							)
						);


$api_route['setview'] = new ApiRequest(
							'appdev/setview',
							'POST',
							false, 
							array(
								'aId'=>array('type'=>'text','required'=>true)
							)
						);
$api_route['setdownload'] = new ApiRequest(
							'appdev/setdownload',
							'POST',
							false, 
							array(
								'aId'=>array('type'=>'text','required'=>true)
							)
						);

$api_route['getappdata'] = new ApiRequest(
							'appdev/getappdata',
							'POST',
							false,
							array(
								'devid'=>array('type'=>'number','required'=>true),
								'packname'=>array('type'=>'text','required'=>true)
							)
						);