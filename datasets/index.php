<?php 
$current_page = 'datasets';
$page = 'Welcome to Be My Ear Project - Models';
include '../core/header.php';
include '../core/nav.php';
?>
<head>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/custom/models.css') ?>">
</head>

<div class="container">

	<h3>Datasets</h3>
	<?php 
	$files = scandir($datasets_dir);
	$n = count($files); ?>
	<table class="table table-striped table-hover table-bordered">
		<thead class="thead-dark">
	    <tr>
	      <th>#</th>
	      <th>Name</th>
	      <th>Action</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php for($i=2;$i<$n;$i++) {
	  	 ?>
	  	<tr class="button-directory">
	  		<td><?= $i-1 ?></td>
		  	<td><?= $files[$i] ?></td>
		  	<td><a class="btn btn-sm btn-primary" href="view.php?name=<?= $files[$i] ?>">View</a></td>
	  	</tr>
	  	<?php } ?>
	  </tbody>
	</table>
	
</div>

<script type="text/javascript" src="<?= base_url('assets/js/custom/datasets.js') ?>"></script>