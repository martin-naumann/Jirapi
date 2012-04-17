<?php

defined('BASE_PATH') || define('BASE_PATH', realpath(dirname(__FILE__)));

// adds jirapi to the include path
set_include_path(get_include_path() . PATH_SEPARATOR . BASE_PATH . '/../lib' . PATH_SEPARATOR . BASE_PATH . '/lib');

function jirapi_autoload($class) {
	$file = str_replace("\\", "/", $class) . ".php";
	require_once $file;
}

spl_autoload_register('jirapi_autoload');
