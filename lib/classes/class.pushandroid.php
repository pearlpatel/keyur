<?php

class pushandroid{
	private $url;
	private $message;
	private $debug_mode;
	private $device_tokens;
	
	public $error;
	public $error_string;
	
	
	public function __construct(){
		$this->debug_mode = false;
		$this->url = API_PUSH_URL;
		$this->message = false;
		$this->error = false;
	}
	
	public function setMode($mode = false){
		$this->debug_mode = $mode;
		if($mode){
			// Debug mode
		}else{
			
		}
	}
	
	public function setMessage($message){
		if(isset($message)){
			if(!is_array($message)){
				//$message = (array)$message;
				$message = array('message'=>$message);
			}
			$this->message = $message;	
			return true;
		}else{
			return false;	
		}
	}
	
	public function setDeviceToken($tokens){
		if(is_array($tokens) && count($tokens) >= 1){
			$this->device_tokens = $tokens;	
		}	
	}
	
	// Main function
	public function send(){
		$fields = array( 'registration_ids' => $this->device_tokens,  'data' => $this->message,	);
		
		$headers = array(
					'Authorization: key=' . API_KEY_GOOGLE,
					'Content-Type: application/json'
				);

		// Open connection
		$ch = curl_init();
		
		// Set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $this->url);
		
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		// Disabling SSL Certificate support temporarly
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		
		// Execute post
		$result = curl_exec($ch);
		if ($result === FALSE) {
			$this->error_string = curl_error($ch);
			return false;
		}
		
		// Close connection
		curl_close($ch);
		return json_decode($result);
	}
}