<?php 
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
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
	$root = '../../../..';
	$dir = $datasets_dir.'/'.$name.'/train';
	$files = scandir($dir);
	$wav = array();
	$targets = array();
	foreach ($files as $file) {
		if (substr($file, -3) == 'wav') {
			array_push($wav, str_replace('.wav', '', $file));
		}
		if (substr($file, -3) == 'txt') {
			$fileread = fopen($dir.'/'.$file, 'r');
			$text = fread($fileread,filesize($dir));
			array_push($targets, $text);
		}
	} ?>
	Total datasets: <?= count($wav) ?>
	<table class="table table-striped table-hover table-bordered">
		<thead class="thead-dark">
	    <tr>
	      <th>#</th>
	      <th>Name</th>
	      <th>Label</th>
	      <th>Action</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php for($i=0;$i<count($wav);$i++) {
	  	 ?>
	  	<tr class="button-directory">
	  		<td><?= $i+1 ?></td>
		  	<td><?= $wav[$i] ?></td>
		  	<td><?= $targets[$i] ?></td>
		  	<td>
		  		<audio id="<?= $wav[$i] ?>" src="<?= $root.'/'.$dir.'/'.$wav[$i].'.wav' ?>"></audio>
			  <button onclick="document.getElementById('<?= $wav[$i] ?>').play();">Play </button>
  			</td> 
	  	</tr>
	  	<?php } ?>
	  </tbody>
	</table>

	<h4>Testing</h4>
	<?php 
	$dir = $datasets_dir.'/'.$name.'/dev';
	$files = scandir($dir);
	$wav = array();
	$targets = array();
	foreach ($files as $file) {
		if (substr($file, -3) == 'wav') {
			array_push($wav, str_replace('.wav', '', $file));
		}
		if (substr($file, -3) == 'txt') {
			$fileread = fopen($dir.'/'.$file, 'r');
			$text = fread($fileread,filesize($dir));
			array_push($targets, $text);
		}
	} ?>
	Total datasets: <?= count($wav) ?>
	<table class="table table-striped table-hover table-bordered">
		<thead class="thead-dark">
	    <tr>
	      <th>#</th>
	      <th>Name</th>
	      <th>Label</th>
	      <th>Action</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php for($i=0;$i<count($wav);$i++) {
	  	 ?>
	  	<tr class="button-directory">
	  		<td><?= $i+1 ?></td>
		  	<td><?= $wav[$i] ?></td>
		  	<td><?= $targets[$i] ?></td>
		  	<td>
		  		<audio class="play-button" src="<?= $dir.'/'.$wav[i].'.wav' ?>"></audio>Play</button>
  			</td> 
	  	</tr>
	  	<?php } ?>
	  </tbody>
	</table>

	
</div>

<script type="text/javascript" src="<?= base_url('assets/js/custom/datasets.js') ?>"></script>