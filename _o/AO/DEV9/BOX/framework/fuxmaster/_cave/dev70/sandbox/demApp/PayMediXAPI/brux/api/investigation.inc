<?php
#DEFINE VARIABLES
$input = array('bind' => '');

if(isset($_REQUEST)){
	if(!empty($_REQUEST['oinvestigation'])){$input['bind'] = $_REQUEST['oinvestigation'];}
}

#REQUIRED
if(empty($input['bind'])){$response['code'] = 'E400A1'; $response['response'] = array('reason' => 'oINVESTIGATION Required');}


#PROCESS
else {
	$result = obtain::investigation($input['bind']);
	if($result === 'NO_RECORD'){$response['code'] = 'E200F9'; $response['response'] = array('reason' => 'no record found', 'request' => 'denied');}
	elseif($result === FALSE){
		$response['code'] = 'E520';
		$response['response'] = array('reason' => 'unknown', 'request' => 'denied');
	}
	else {
		$response['action'] = 'success';
		$response['code'] = 'E200';

		$response['response'] = array();
		if(is_array($result)){
			$response['response'] = array_merge($result, $response['response']);
		}
	}
}
?>