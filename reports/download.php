<?php 
include '../core/config.php';
if (isset($_GET['name']) && isset($_GET['type'])) {
	$model_name = $_GET['name'];
	$filename = 'result_'.$_GET['type'].'.csv';

	$filetarget = $models_dir.'/'.$model_name.'/reports/'.$filename;
	// output headers so that the file is downloaded rather than displayed
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename='.$model_name.'-'.$filename);
	// create a file pointer connected to the output stream
	$output = fopen($filetarget, 'r');
	while (!feof($output)) {
	    echo fread($output, filesize($filetarget));
	}
}
 ?>