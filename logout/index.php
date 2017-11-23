<?php 
include '../core/config.php';
session_destroy();
header("Location:".$baseurl.'/login');
 ?>