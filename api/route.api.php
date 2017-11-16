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
								'email'=>array('type'=>'text','required'=>true),
								'phone'=>array('type'=>'number','required'=>true)																
							)
						);
$api_route['usersignup'] = new ApiRequest(
							'login/usersignup',
							'POST',
							false, 
							array(
								'email'=>array('type'=>'text','required'=>true),
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
								'email'=>array('type'=>'text','required'=>true),
								'phone'=>array('type'=>'number','required'=>true),
								'deviceid'=>array('type'=>'text','required'=>true)
							)
						);
$api_route['getcategory'] = new ApiRequest(
							'inbuilt/getcategory',
							'GET',
							false, 
							array()
						);
$api_route['getalltheme'] = new ApiRequest(
							'inbuilt/getalltheme',
							'GET',
							false, 
							array()
						);
$api_route['gettoptheme'] = new ApiRequest(
							'inbuilt/gettoptheme',
							'GET',
							false, 
							array()
						);
$api_route['getsliddertheme'] = new ApiRequest(
							'inbuilt/getsliddertheme',
							'GET',
							false, 
							array()
						);
$api_route['getcattheme'] = new ApiRequest(
							'inbuilt/getcattheme',
							'POST',
							false, 
							array(
								'cid'=>array('type'=>'number','required'=>true),							
							)
						);
$api_route['fileupload'] = new ApiRequest(
							'login/fileupload',
							'POST',
							false, 
							array(
								'image'=>array('type'=>'file','required'=>true),
								'userid'=>array('type'=>'text','required'=>true)
								)
						);