<?php 
include 'config.php';
session_start();
if (isset($_SESSION['user'])) {
	header("Location:".$baseurl.'/login');
}
var_dump("tes");
 ?>
