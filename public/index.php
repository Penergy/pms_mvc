<?php

// ob_start();

if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

/**
 * The full path to the directory which holds "app", WITHOUT a trailing DS.
 *
 */
if (!defined('ROOT')) {
	// define('ROOT', dirname(dirname(dirname(__FILE__))));
	define('ROOT',dirname(dirname(__FILE__)));
}


$url = $_GET['url'];

/**
 * 对library文件夹下的bootstrap.php发起了请求
 *
 */
require_once(ROOT.DS.'library'.DS.'bootstrap.php');

// $var = array('a'=>'pizza', 'b'=>'cookies', 'c'=>'celery');
// fb($var);
// fb($var, "An array");
// fb($var, FirePHP::WARN);
// fb($var, FirePHP::INFO);
// fb($var, 'An array with an Error type', FirePHP::ERROR);