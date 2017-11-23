<?php 
if (isset($_GET['name'])) {
	$name = $_GET['name'];
}
$current_page = 'datasets';
$page = 'Welcome to Be My Ear Project - Models';
include '../core/header.php';
include '../core/nav.php';
?>
<head>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/custom/models.css') ?>">
</head>

<div class="container">

	<h3>Datasets - <?= $name ?></h3>
	<h4>Training</h4>
	<?php 
	$files = scandir($datasets_dir.'/'.$name.'/train');
	$wav = array();
	foreach ($files as $file) {
		if (substr($file, -3) == 'wav') {
			array_push($wav, str_replace('.wav', '', $file));
		}
	} ?>
	Total datasets: <?= count($wav) ?>
	<table class="table table-striped table-hover table-bordered">
		<thead class="thead-dark">
	    <tr>
	      <th>#</th>
	      <th>Name</th>
	      <th>Action</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php for($i=0;$i<$n;$i++) {
	  	 ?>
	  	<tr class="button-directory">
	  		<td><?= $i-1 ?></td>
		  	<td><?= $wav[$i] ?></td>
		  	<td></td> 
	  	</tr>
	  	<?php } ?>
	  </tbody>
	</table>
	<h4>Testing</h4>
	<?php 
	$files = scandir($datasets_dir.'/'.$name.'/dev');
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
		  	<td></td>
	  	</tr>
	  	<?php } ?>
	  	<tr>
	  		<td colspan=3>Total datasets: <?= $n ?></td>
	  	</tr>
	  </tbody>
	</table>

	
</div>

<script type="text/javascript" src="<?= base_url('assets/js/custom/datasets.js') ?>"></script>