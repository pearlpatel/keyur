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
$api_route['setpriority'] = new ApiRequest(
							'appdev/setpriority',
							'POST',
							false, 
							array(
								'aId'=>array('type'=>'number','required'=>true),
								'lId'=>array('type'=>'text','required'=>true),
								'index'=>array('type'=>'text','required'=>true)
							)
						);
$api_route['linkdevapp'] = new ApiRequest(
							'appdev/linkdevapp',
							'POST',
							false, 
							array(
								'aId'=>array('type'=>'number','required'=>true),
								'lId'=>array('type'=>'text','required'=>true)
							)
						);
$api_route['unlinkdevapp'] = new ApiRequest(
							'appdev/unlinkdevapp',
							'POST',
							false, 
							array(
								'aId'=>array('type'=>'number','required'=>true),
								'lId'=>array('type'=>'text','required'=>true)
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