<?php 
include 'config.php';
include 'helper.php';
include 'app.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title><?= (isset($page)) ? $page : '' ?></title>
	<script src="<?= base_url('assets/js/jquery.js') ?>" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.css') ?>">
	<script type="text/javascript" src="<?= base_url('assets/js/bootstrap.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/config.js') ?>"></script>
</head>
