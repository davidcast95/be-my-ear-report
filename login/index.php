<?php 

$current_page = '';
$page = 'Welcome to Be My Ear Project - Login';
include '../core/header.php';
session_start();
if (isset($_SESSION['user'])) {
	header("Location:".$baseurl.'/models');
}
 ?>
 <head>
 	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/custom/login.css') ?>">
 	</head>
<div class="container">
	<h2 class="title">Welcome to Be My Ear Project</h2>
	<div class="row">
		<div class="col offset-4 col-4">
			<div id="login-form" class="jumbotron">
			  <h1 class="display">Login</h1>
			  <div class="form-group">
		      <label>Username</label>
		      <input type="text" id="username" class="form-control" placeholder="enter your username">
		      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
		    </div>
		    <div class="form-group">
		      <label for="exampleInputEmail1">Password</label>
		      <input type="password" id="password" class="form-control" placeholder="enter your password">
		    </div>
		    <div id="login-warning" class="alert alert-dismissible alert-warning">
				  <small>username or password cannot be empty</small>
				</div>
				<div id="login-failed" class="alert alert-dismissible alert-danger">
				  <small>username or password invalid</small>
				</div>
				 <button id="login-button" class="btn btn-primary">Login </button><img id="loading" width="50px" src="<?= base_url('assets/img/spinner.gif') ?>"></img>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= base_url('assets/js/custom/login.js') ?>"></script>

 