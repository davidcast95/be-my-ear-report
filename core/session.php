<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';
session_start();
if (isset($_SESSION['user'])) {
	header("Location:".$baseurl.'/login');
}
var_dump($baseurl.'/login');
 ?>
