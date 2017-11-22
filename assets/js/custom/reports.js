
var isTraining = true, isTesting = false
var iteration = true

var epoch = false
var training_json_data, testing_json_data
$(document).ready(function() {
	$.post(baseurl+'/reports/method.php', {
		name : "read_training_csv",
		filepath : report_dir+'/result_training.csv'
	}).done(function(data) {
		$('#ctc-loading').fadeOut()
		training_json_data = JSON.parse(data)
		updateGraph()
	})

	$.post(baseurl+'/reports/method.php', {
		name : "read_testing_csv",
		filepath : report_dir+'/result_testing.csv'
	}).done(function(data) {
		$('#cer-loading').fadeOut()
		testing_json_data = JSON.parse(data)
		updateGraph()
	})

	$('#training-radio-button').click(function() {
		isTraining = document.getElementById('training-radio-button').checked
		updateGraph()
	})
	$('#testing-radio-button').click(function() {
		isTesting = document.getElementById('testing-radio-button').checked
		updateGraph()
	})
	$('#ctc-axis').on('change', function() {
		iteration = this.value == 'iteration'
		updateGraph()
	})
	$('#cer-axis').on('change', function() {
		epoch = this.value == 'epoch'
		updateGraph()
	})

})

function updateGraph() {
	if (isTraining && isTesting) {
		if (iteration) {
			comparativeGraph('ctc-graph',{
			x:training_json_data.iteration, 
			y:training_json_data.loss_by_iteration,
			name: 'Training'
			}, {
			x: testing_json_data.iteration,
			y: testing_json_data.loss_by_iteration,
			name: 'Testing'
			}, 'iteration', 'ctc-loss', "CTC (Connectionist Temporal Classification) Loss")
		} else {
			comparativeGraph('ctc-graph',{
			x:training_json_data.epoch, 
			y:training_json_data.loss_by_epoch,
			name: 'Training'
			}, {
			x: testing_json_data.epoch,
			y: testing_json_data.loss_by_epoch,
			name: 'Testing'
			}, 'epoch', 'ctc-loss', "CTC (Connectionist Temporal Classification) Loss")
		}
		
	} else if (isTraining) {
		if (iteration) {
			defaultGraph('ctc-graph',{
			x:training_json_data.iteration,
			y: training_json_data.loss_by_iteration }, 'iteration', 'ctc-loss', "CTC (Connectionist Temporal Classification) Loss")
		} else {
			defaultGraph('ctc-graph',{
			x:training_json_data.epoch,
			y: training_json_data.loss_by_epoch }, 'epoch', 'ctc-loss', "CTC (Connectionist Temporal Classification) Loss")
		}
		
	} else if (isTesting) {
		if (iteration) {
			defaultGraph('ctc-graph',{
			x: testing_json_data.iteration,
			y: testing_json_data.loss_by_iteration }, 'iteration', 'ctc-loss', "CTC (Connectionist Temporal Classification) Loss")
		} else {
			defaultGraph('ctc-graph',{
			x: testing_json_data.epoch,
			y: testing_json_data.loss_by_epoch }, 'epoch', 'ctc-loss', "CTC (Connectionist Temporal Classification) Loss")
		}
	}
	if (!epoch) {
		defaultGraph('cer-graph',{
		x: testing_json_data.iteration,
		y: testing_json_data.cer_by_iteration }, 'iteration', 'cer', "CER (Character Error Rate)")
	} else {
		defaultGraph('cer-graph',{
		x: testing_json_data.epoch,
		y: testing_json_data.cer_by_epoch }, 'epoch', 'cer', "CER (Character Error Rate)")
	}
}

function defaultGraph(id, data, x = "", y = "", plotTitle = "") {
	var graph = document.getElementById(id);
	var layout = {
		title: plotTitle,
		xaxis:{
			title: x
		},
		yaxis:{
			title: y
		}
	}
	Plotly.newPlot( graph, [data], layout );
}

function comparativeGraph(id,x,y,axisx="",axisy="",plotTitle="") {
	var graph = document.getElementById(id);
	var layout = {
		title: plotTitle,
		xaxis:{
			title: axisx
		},
		yaxis:{
			title: axisy
		}
	}
	Plotly.newPlot( graph, [x,y], layout );
}


