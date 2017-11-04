<?php

session_save_path("/tmp");

@session_start();

date_default_timezone_set("Asia/Kolkata");

// Site Setting

define('SITE_NAME', 'Admin For App');

define('SITE_PHONE', '');

// Global Setting
define('BASE_PATH', dirname(dirname(__FILE__)));

define('BASE_URL', 'http://localhost/keyurWork/');

define('INDEX', 'index.php');

define('DS', DIRECTORY_SEPARATOR);

define('APP_URL', BASE_URL.'app/');

define('API_URL', BASE_URL.INDEX.'/'.'api/');

define('ADMIN_URL', BASE_URL.INDEX.'/'.'admin/');

define('APP_JS', BASE_URL.'app/views/cms/js/');

define('USER_APP_JS', BASE_URL.'app/views/cms/js/');

define('URL', BASE_URL.INDEX.'/');

ini_set('session.save_path',BASE_PATH.DS.'tmp'.DS.'session');

error_reporting(0);

define('DEBUG_MODE', true);

define('DB_NAME', 'keyur_app');

define('DB_USER', 'root');

define('DB_PASSWORD', '');

define('DB_HOST', 'localhost');

define('DB_CHARSET', 'utf8');

define('DB_COLLATE', '');

/*****	Dir Settings	*****/

define('DIR_CONFIG',BASE_PATH.DS.'config');

define('DIR_APP',BASE_PATH.DS.'app');

define('DIR_SYS',BASE_PATH.DS.'sys');

define('DIR_CONTROLLER',DIR_APP.DS.'controllers');

define('DIR_MODAL',DIR_APP.DS.'modals');

define('DIR_VIEW',DIR_APP.DS.'views');

define('DIR_LIBRARY',BASE_PATH.DS.'lib');

define('UPLOAD_DIR','uploads');
define('PICTURE_DIR',BASE_URL.'uploads/');
define('UPLOAD_ICON','uploads/cat_icon/');
define('UPLOAD_ICON','uploads/icon/');
define('UPLOAD_BANNER','uploads/promoBanners/');

define('DEFAULT_CONTROLLER','index');

define('DEFAULT_ACTION','index');

// Load Class	//
require_once(DIR_LIBRARY.'/classes/class.database-access.php');

require_once(DIR_LIBRARY.'/classes/class.url.php');

require_once(DIR_LIBRARY.'/classes/class.input.php');

require_once(DIR_LIBRARY.'/classes/class.file.php');

//require_once(DIR_SYS.'/core/template.php');

require_once(DIR_SYS.'/core/controller.php');

require_once(DIR_SYS.'/core/modal.php');

require_once(BASE_PATH.'/lib/helpers/helper.debug.php');

$Url = new Url(BASE_URL.INDEX);

$ApiUrl = new Url(API_URL);

$AdminUrl = new Url(ADMIN_URL);