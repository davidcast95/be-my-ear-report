<?php 
include '../core/helper.php';

if (isset($_POST['name'])) {
	$method_name = $_POST['name'];
	if ($method_name == 'read_training_csv') {
		if (validate_param($_POST, array('filepath'))) {
			if (file_exists($_POST['filepath'])) {
				if (($handle = fopen($_POST['filepath'], "r")) !== FALSE) {
				    $json_row['iteration'] = array();
				    $json_row['epoch'] = array();
				    $json_row['batch'] = array();
					$json_row['alpha'] = array();
					$json_row['loss_by_iteration'] = array();
					$json_row['loss_by_epoch'] = array();
					$json_row['target'] = array();
					$json_row['decode'] = array();
					$c= 0;
					$epoch=0;
					$total_loss=0;
					$n_batch=0;
					$avg_loss=-1;
					$notfirst = false;
				    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
				    	
				    	if ((int)$data[0] == 0) {
				    		if ($notfirst) {
				    			$avg_loss = $total_loss / $n_batch;
				    			$total_loss = 0;
				    			$n_batch = 0;
				        		array_push($json_row['epoch'], $epoch);
				        		array_push($json_row['loss_by_epoch'], $avg_loss);
				        		$epoch++;
				    		}
				    		$notfirst = true;
				    	}
				  		//READING SEQUENCE ROW OF CSV
						// //COLUMN :
						// //BATCH,LEARNING_RATE,TARGET_SENTENCE,LOSS,DECODE
				        if (count($data) == 6) {
				        	array_push($json_row['iteration'], $c);
				        	$c++;
				        	array_push($json_row['batch'], (int)$data[0]);
				        	array_push($json_row['alpha'], (float)$data[1]);
				        	array_push($json_row['target'], $data[2]);
				        	array_push($json_row['loss_by_iteration'], (float)$data[3]);
				        	array_push($json_row['decode'], $data[4]);

				        	$total_loss+= (float)$data[3];
				    		$n_batch++;
						}
				    }
				    fclose($handle);
				    echo json_encode($json_row);
				}
			}
			
		}
	}
	if ($method_name == 'read_testing_csv') {
		if (validate_param($_POST, array('filepath'))) {
			if (file_exists($_POST['filepath'])) {
				if (($handle = fopen($_POST['filepath'], "r")) !== FALSE) {
				    $json_row['iteration'] = array();
				    $json_row['epoch'] = array();
				    $json_row['batch'] = array();
					$json_row['alpha'] = array();
					$json_row['loss_by_iteration'] = array();
					$json_row['loss_by_epoch'] = array();
					$json_row['target'] = array();
					$json_row['decode'] = array();
					$json_row['cer_by_iteration'] = array();
					$json_row['cer_by_epoch'] = array();
					
					$c= 0;
					$epoch=0;
					$total_loss=0;
					$total_cer=0;
					$n_batch=0;
					$avg_loss=-1;
					$avg_cer=-1;
					$notfirst = false;
				    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
				    	if ((int)$data[0] == 0) {
				    		if ($notfirst) {
				    			$avg_loss = $total_loss / $n_batch;
				    			$avg_cer = $total_cer / $n_batch;
				    			$total_loss = 0;
				    			$total_cer = 0;
				    			$n_batch = 0;
				        		array_push($json_row['epoch'], $epoch);
				        		array_push($json_row['loss_by_epoch'], $avg_loss);
				        		array_push($json_row['cer_by_epoch'], $avg_cer);
				        		$epoch++;
				    		}
				    		$notfirst = true;
				    	}
				  		//READING SEQUENCE ROW OF CSV
						// //COLUMN :
						// //BATCH,LEARNING_RATE,TARGET_SENTENCE,LOSS,DECODE
				        if (count($data) == 6) {
				        	array_push($json_row['iteration'], $c);
				        	$c++;
				        	array_push($json_row['batch'], (int)$data[0]);
				        	array_push($json_row['alpha'], (float)$data[1]);
				        	array_push($json_row['loss_by_iteration'], (float)$data[2]);
				        	array_push($json_row['decode'], $data[3]);
				        	array_push($json_row['target'], $data[4]);
				        	array_push($json_row['cer_by_iteration'], $data[5]);

				        	$total_loss+= (float)$data[2];
				        	$total_cer+= (float)$data[5];
				    		$n_batch++;
						}
				    }
				    fclose($handle);
				    echo json_encode($json_row);
				}
			}
			
		}
	}
}

 ?>