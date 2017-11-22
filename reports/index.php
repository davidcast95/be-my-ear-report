<?php 
$current_page = 'reports';
$page = 'Welcome to Be My Ear Project - Reports';
include '../core/header.php';
include '../core/nav.php';
?>
<head>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/custom/reports.css') ?>">
</head>


<div class="container">
	
	<h3>Reports</h3>
	<p>All of the report will be presented by chart</p>
	<?php 
	$files = scandir($models_dir);
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
	  	<?php for($i=2;$i<$n;$i++) { ?>
	  	<tr>
	  		<td><?= $i+1 ?></td>
		  	<td><?= $files[$i] ?></td>
		  	<td><a class="btn btn-sm btn-primary" href="view.php?name=<?= $files[$i] ?>">View</a></td>
	  	</tr>
	  	<?php } ?>
	  </tbody>
	</table>
	
</div>