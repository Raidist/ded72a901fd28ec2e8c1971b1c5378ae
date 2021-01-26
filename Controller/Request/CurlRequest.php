<?php
	function post($url,$input=[]){
		$output = "";
		$input = json_encode($input);
		$init = curl_init();
		$fp = fopen(dirname(__FILE__).'/errorlog.txt', 'w');
		//print_r($init).die();
		curl_setopt($init, CURLOPT_URL,$url);
		curl_setopt($init, CURLOPT_ENCODING, '');
		curl_setopt($init, CURLOPT_POST, 1);
		curl_setopt($init, CURLOPT_POSTFIELDS,$input);
		curl_setopt($init, CURLOPT_VERBOSE, 1);
   		curl_setopt($init, CURLOPT_STDERR, $fp);

		curl_setopt($init, CURLOPT_HTTPHEADER, array(
    		'Content-Type: application/json',
		));
		curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
		//print_r($init).die();
		$output = curl_exec($init);

		curl_close($init);

		return $output;
	}

	function receiveData($url){
		$init = curl_init();
		curl_setopt($init, CURLOPT_URL, $url);
		curl_setopt($init,CURLOPT_RETURNTRANSFER,true);
		$output = curl_exec($init);

		return json_decode($output);
	}
?>