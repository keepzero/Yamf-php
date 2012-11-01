<?php
//session_start();

//load config
include_once('config.php');

//run your apps
$myapp = new app($urls);
$myapp->run();

?>
