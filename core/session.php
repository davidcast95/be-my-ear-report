<?php 
include 'config.php';
session_start();
var_dump($_SESSION);
if (!isset($_SESSION['user'])) {
	// header("Location:".$baseurl.'/login');
}
 ?>
