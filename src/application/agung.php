<?php
/**
 * Agung framework's core file
 * Created with love and in hurry condition
 * 
 * This framework created and implemented for efficiency work, it's nothing serious
 * @author Degung Priambodo <blog.zen8.tk>
 * @version 1.0
 * 
 */

// get url
$url 	= isset($_GET['url']) ? $_GET['url'] : '';
$http 	= 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 's' : '') . '://';

// menentukan baseurl dan basepath
$jebret = explode(".",$_SERVER['HTTP_HOST']);
if ($jebret[0] == "www")
	define('BASE_PATH', $http."". BASE .DS. 'public' .DS);
else
	define('BASE_PATH', $http. BASE .DS. 'public' .DS);

define('BASE_URL', $http. BASE .DS);

// panggil file-flie library utama
require_once (ROOT .DS. 'library' .DS. 'model.class.php');
require_once (ROOT .DS. 'library' .DS. 'view.class.php');
require_once (ROOT .DS. 'library' .DS. 'controller.class.php');

// fungsi autoload
function __autoload($className) {
	$dir = ROOT.DS.str_replace("\\", DS, $className).".php";
	if (file_exists($dir)) require_once($dir);
}

// fungsi atur pesan error
function setReporting() {
	if (DEVELOPMENT_ENVIRONMENT == true) {
		error_reporting(E_ALL);
		ini_set('display_errors', 'On');
	} else {
		error_reporting(E_ALL);
		ini_set('display_error', 'Off');
		ini_set('log_errors', 'On');
		ini_set('error_log', ROOT.'/tmp/log/error.log');
	}
}

// fungsi panggil controller sesuai nilai $url
function callHook() {
	global $url;

	$urlArray 	= explode("/", $url);
	$controller	= (!empty($urlArray[0])) ? $urlArray[0] : DEFAULT_CONTROLLER;
	
	$controllerPath = ROOT.'/src/application/controllers/'.ucfirst($controller).'Controller.php';

	if (file_exists($controllerPath)) {
		array_shift($urlArray);
		$action 	= (!empty($urlArray[0])) ? $urlArray[0] : "index";
		
		array_shift($urlArray);
		$parameter 	= $urlArray;

		require_once $controllerPath;
		$controllerName = ucfirst($controller) . "Controller";
		$object 	= new $controllerName();

		if (method_exists($controllerName, $action)) {
			call_user_func_array(array($object, $action), $parameter);
		} else {
			header('location: '.BASE_URL."home");
			exit();
			// die("Aksi tidak ditemukan!");
		}
	} else {
		header('location: '.BASE_URL."home");
		exit();
		// die("Controller tidak ditemukan!");
	}
}