<?php 
$current_page = 'models';
$page = 'Welcome to Be My Ear Project - Models';
include '../core/header.php';
include '../core/nav.php';
?>
<head>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/custom/models.css') ?>">
</head>

<div class="container">

	<h3>Models</h3>
	<?php 
	$files = scandir($models_dir);
	var_dump($files);
	$n = count($files); ?>
	<table class="table table-striped table-hover table-bordered">
		<thead class="thead-dark">
	    <tr>
	      <th>#</th>
	      <th>Name</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php for($i=2;$i<$n;$i++) { ?>
	  	<tr>
	  		<td><?= $i-1 ?></td>
		  	<td><?= $files[$i] ?></td>
	  	</tr>
	  	<?php } ?>
	  </tbody>
	</table>
	
</div>