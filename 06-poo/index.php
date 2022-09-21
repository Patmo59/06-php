<?php
require "./routes.php";
require "./class/Autoloader.php";
require "./class/Router.php";

Autoloader::register();
Router::routing();
?>