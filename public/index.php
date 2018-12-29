<?php
session_start();
date_default_timezone_set('Asia/Makassar');
// konstanta ROOT & DS
define('ROOT', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);

/*$loader = require '../vendor/autoload.php';
$loader->add('application', __DIR__.'/../src/application/agung.php');*/

// ================ file konfigurasi framework ================ //
require_once (ROOT .DS. 'config' .DS. 'config.php');
// ================== file utama framework ==================== //
require_once (ROOT .DS. 'src/application' .DS. 'agung.php');
// fungsi menampilkan error
setReporting();
// fungsi memanggil controller
callHook();
?>
