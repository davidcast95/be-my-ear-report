<?php 
include '../core/config.php';
if (isset($_GET['name']) && isset($_GET['type'])) {
	$model_name = $_GET['name'];
	$filename = 'result_'.$_GET['type'].'.csv';

	// output headers so that the file is downloaded rather than displayed
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=data.csv');
	echo $model_dirs.'/'.$model_name.'/reports/'.$filename;
	// create a file pointer connected to the output stream
	$output = fopen($model_dirs.'/'.$model_name.'/reports/'.$filename, 'r');


	// loop over the rows, outputting them
	while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
}
 ?>