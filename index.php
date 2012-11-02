<?php
//session_start();

//load config
include('config.php');

//run your apps
$myapp = new app($urls);
$myapp->run();

?>
