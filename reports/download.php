<?php 
include '../core/config.php';
if (isset($_GET['name']) && isset($_GET['type'])) {
	$model_name = $_GET['name'];
	$filename = 'result_'.$_GET['type'].'.csv';

	// output headers so that the file is downloaded rather than displayed
	// header('Content-Type: text/csv; charset=utf-8');
	// header('Content-Disposition: attachment; filename=data.csv');
	// create a file pointer connected to the output stream
	$output = fopen($model_dirs.'/'.$model_name.'/reports/'.$filename, 'r');
	echo $model_dirs.'/'.$model_name.'/reports/'.$filename;
	var_dump($output);
	// loop over the rows, outputting them
	while ($row = fread($output, 0)) echo $row;
}
 ?>