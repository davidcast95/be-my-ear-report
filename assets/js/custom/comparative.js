
var isTraining = true, isTesting = false
var iteration = true

var epoch = false
var training_json_data = [], testing_json_data = []
var models_name = []


$(document).ready(function() {
	$('#ctc-loading').hide()
	$('#cer-loading').hide()
	$('.model-button').click(function() {
		if ($(this).html() == 'Add') {
			$(this).html('Remove')
			add(this.value)
			this.className = 'model-button btn btn-sm btn-danger'
		} else {
			$(this).html('Add')
			this.className = 'model-button btn btn-sm btn-warning'
			remove(this.value)
		}
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

function add(model_name) {
	models_name.push(model_name)
	$('#ctc-loading').fadeIn()
	$('#cer-loading').fadeIn()
	$.post(baseurl+'/comparative/method.php', {
		name : "read_training_csv",
		filepath : models_dir+'/'+model_name+'/reports/result_training.csv'
	}).done(function(data) {
		training_json_data.push(JSON.parse(data))
		updateGraph()
	})

	$.post(baseurl+'/comparative/method.php', {
		name : "read_testing_csv",
		filepath : models_dir+'/'+model_name+'/reports/result_testing.csv'
	}).done(function(data) {
		testing_json_data.push(JSON.parse(data))
		updateGraph()
	})
}

function remove(model_name) {
	var deletedIndex = models_name.indexOf(model_name)
	if (deletedIndex > -1) {
		models_name.splice(deletedIndex, 1)
		training_json_data.splice(deletedIndex, 1)
		testing_json_data.splice(deletedIndex, 1)
	}
	updateGraph()
}

function updateGraph() {
	if (isTraining && isTesting) {
		if (iteration) {
			chartData = []
			for (var i=0;i<training_json_data.length;i++) {
				chartData.push({
					x: training_json_data[i].iteration,
					y: training_json_data[i].loss_by_iteration,
					name: models_name[i] + ' - Training'
				})
				chartData.push({
					x: testing_json_data[i].iteration,
					y: testing_json_data[i].loss_by_iteration,
					name: models_name[i] + ' - Testing'
				})
			}
			comparativeGraph('ctc-graph', chartData, 'iteration', 'ctc-loss', "CTC (Connectionist Temporal Classification) Loss")
		} else {
			chartData = []
			for (var i=0;i<training_json_data.length;i++) {
				chartData.push({
					x: training_json_data[i].epoch,
					y: training_json_data[i].loss_by_epoch,
					name: models_name[i] + ' - Training'
				})
				chartData.push({
					x: testing_json_data[i].epoch,
					y: testing_json_data[i].loss_by_epoch,
					name: models_name[i] + ' - Testing'
				})
			}
			comparativeGraph('ctc-graph', chartData, 'epoch', 'ctc-loss', "CTC (Connectionist Temporal Classification) Loss")
		}
		
	} else if (isTraining) {
		if (iteration) {
			chartData = []
			for (var i=0;i<training_json_data.length;i++) {
				chartData.push({
					x: training_json_data[i].iteration,
					y: training_json_data[i].loss_by_iteration,
					name: models_name[i] + ' - Training'
				})
			}
			console.log(chartData)
			comparativeGraph('ctc-graph', chartData, 'iteration', 'ctc-loss', "CTC (Connectionist Temporal Classification) Loss")
		} else {
			chartData = []
			for (var i=0;i<training_json_data.length;i++) {
				chartData.push({
					x: training_json_data[i].epoch,
					y: training_json_data[i].loss_by_epoch,
					name: models_name[i] + ' - Training'
				})
			}
			comparativeGraph('ctc-graph', chartData, 'epoch', 'ctc-loss', "CTC (Connectionist Temporal Classification) Loss")
		}
		
	} else if (isTesting) {
		if (iteration) {
			chartData = []
			for (var i=0;i<training_json_data.length;i++) {
				chartData.push({
					x: testing_json_data[i].iteration,
					y: testing_json_data[i].loss_by_iteration,
					name: models_name[i] + ' - Testing'
				})
			}
			comparativeGraph('ctc-graph', chartData, 'iteration', 'ctc-loss', "CTC (Connectionist Temporal Classification) Loss")
		} else {
			chartData = []
			for (var i=0;i<training_json_data.length;i++) {
				chartData.push({
					x: testing_json_data[i].epoch,
					y: testing_json_data[i].loss_by_epoch,
					name: models_name[i] + ' - Testing'
				})
			}
			comparativeGraph('ctc-graph', chartData, 'epoch', 'ctc-loss', "CTC (Connectionist Temporal Classification) Loss")
		}
	}
	if (!epoch) {
		chartData = []
		for (var i=0;i<training_json_data.length;i++) {
			chartData.push({
				x: testing_json_data[i].iteration,
				y: testing_json_data[i].cer_by_iteration,
					name: models_name[i]
			})
		}
		comparativeGraph('cer-graph', chartData, 'iteration', 'cer', "CER (Character Error Rate)")
	} else {
		chartData = []
		for (var i=0;i<training_json_data.length;i++) {
			chartData.push({
				x: testing_json_data[i].epoch,
				y: testing_json_data[i].cer_by_epoch,
					name: models_name[i]
			})
		}
		comparativeGraph('cer-graph', chartData, 'epoch', 'cer', "CER (Character Error Rate)")
	}
	
	$('#ctc-loading').fadeOut()
	$('#cer-loading').fadeOut()
}


function comparativeGraph(id,data,axisx="",axisy="",plotTitle="") {
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
	Plotly.newPlot( graph, data, layout);
}


