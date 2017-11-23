<?php 
include '../core/config.php';
session_start();
session_destroy();
header("Location:".$baseurl.'/login');
 ?>