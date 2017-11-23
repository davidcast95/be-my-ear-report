<?php 
$report_name = '';
if (isset($_GET['name'])) {
	$report_name = $_GET['name'];
}
$current_page = 'reports';
$page = 'Reports - '.$report_name;
include '../core/header.php';
include '../core/nav.php';

$report_dir = $models_dir.'/'.$report_name.'/reports';
if ($report_name == '' || !file_exists($report_dir)) {
	header("Location:".base_url('reports'));
}
?>
<head>
	<script type="text/javascript" src="<?= base_url('assets/js/plotly.js') ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/custom/reports.css') ?>">
</head>
<script type="text/javascript">
	var report_dir = "<?= $report_dir ?>";
</script>

<div class="container">
	<h3>Reports - <?= $report_name ?></h3>
	<h4>CTC (Connectionist Temporal Connectionist) Loss</h4>
	<a class="btn btn-sm btn-success" target="_blank" href="download.php?name=<?= $report_name ?>&type=training">Download</a>
	<div class="card text-white bg-info">
	  <div class="card-body">
	    <blockquote class="card-blockquote">
	    <div class="row">
	    	<div class="col">
	    		<strong>Data type</strong>
			      <div class="form-check">
				      <label class="form-check-label">
				        <input type="checkbox" class="form-check-input" id="training-radio-button" checked="">
				        Training Data
				      </label>
				    </div>
				    <div class="form-check">
					    <label class="form-check-label">
					        <input type="checkbox" class="form-check-input" id="testing-radio-button">
					      	Testing Data
					     </label>
					   </div>
	    	</div>
	    	<div class="col">
	    		<strong>XY-Axis</strong>
			      <div class="form-group">
				      <select id="ctc-axis" class="form-control" id="exampleSelect1">
				        <option value="iteration">Iteration - CTC Loss</option>
				        <option value="epoch">Epoch (Batch cumulative) - CTC Loss</option>
				      </select>
				    </div>
	    	</div>
	    </div>
	      
	    </blockquote>
	  </div>
	</div>
	<div class="text-center"><img style="text-align:center;" id="ctc-loading" src="<?= base_url('assets/img/spinner.gif') ?>"></img></div>
	<div id="ctc-graph" class="graph"></div>
	<h4>CER (Character Error Rate) Loss</h4>
	<a class="btn btn-sm btn-success" target="_blank" href="download.php?name=<?= $report_name ?>&type=testing">Download</a>
	<div class="card text-white bg-info">
	  <div class="card-body">
	    <blockquote class="card-blockquote">
	    <div class="row">
	    	<div class="col">
	    		<strong>XY-Axis</strong>
			      <div class="form-group">
				      <select id="cer-axis" class="form-control" id="exampleSelect1">
				        <option value="iteration">Iteration - CER</option>
				        <option value="epoch">Epoch (Batch cumulative) - CER</option>
				      </select>
				    </div>
	    	</div>
	    </div>
	      
	    </blockquote>
	  </div>
	</div>
	<div class="text-center"><img style="text-align:center;" id="cer-loading" src="<?= base_url('assets/img/spinner.gif') ?>"></img></div>
	<div id="cer-graph" class="graph"></div>
</div>
<script type="text/javascript" src="<?= base_url('assets/js/custom/reports.js') ?>"></script>