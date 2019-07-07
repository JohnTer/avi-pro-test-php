<?php 
include 'listener.php';
include 'dbsettings.php';

$api = new ApiListener($DBPATH);
$api->listen();
?>
