<?php
header('Content-Type: text/html; charset=UTF-8');

//global define
define('ROOT_PATH', str_replace("\\", "/", dirname(__FILE__)));
define('DS',DIRECTORY_SEPARATOR);
define('LIB_DIR',"lib");
define('APP_DIR',"app");
define('MOD_PATH', ROOT_PATH . DS . "app" . DS . "models");
define('CTL_PATH', ROOT_PATH . DS . "app" . DS . "controllers");
define('SITE_DOMAIN', "http://app.example.com/");

//URL maps
$urls = array(
    '/' => 'home',
);

//libs
include_once('lib/app.php');
include_once('lib/wmsmarty.php');
include_once('lib/default_controller.php');
include_once('lib/default_model.php');
include_once('lib/loader.php');

?>
