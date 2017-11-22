<?php 
function validate_param($request, $params) {
	$validate = true;
	foreach ($params as $param) {
		if (!isset($request[$param]))
				$validate = false;
	}
	return $validate;
}
function base_url($extend_path) {
	global $baseurl;
	return $baseurl.'/'.$extend_path;
}
 ?>
