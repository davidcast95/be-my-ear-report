<?php 
include '../core/helper.php';
if (isset($_GET['name'])) {
	$method_name = $_GET['name'];
	if ($method_name == 'login') {
		if (validate_param($_POST, array('username','password'))) {
			if ($_POST['username'] == 'admin' && $_POST['password'] == 'admin') {
				session_start();
				$_SESSION['user'] = 'admin';
				echo 200;
			} else {
				echo 401;
			}
		}
	}
}
 ?>
