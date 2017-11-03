<?php

class pushiphone{
	private $url;
	private $password;
	private $certificate;
	private $message;
	private $debug_mode;
	private $device_tokens;
	
	public $error;
	public $error_string;
	private $apn;
	
	public function __construct(){
		$this->debug_mode = false;
		$this->url = 'ssl://gateway.push.apple.com:2195';
		$this->password = false;
		$this->certificate = false;
		$this->message = false;
		$this->error = false;
		$this->apn = false;
	}
	
	public function setMode($mode = false){
		$this->debug_mode = $mode;
		if($mode){
			// Debug mode
			$this->url = 'ssl://gateway.sandbox.push.apple.com:2195';
		}else{
			$this->url = 'ssl://gateway.push.apple.com:2195';
		}
	}
	
	public function setPassword($password){
		if(isset($password)){
			$this->password = $password;
			return true;
		}else{
			return false;	
		}
	}
	
	public function setCertificate($path){
		if(isset($path)){
			$this->certificate = $path;
			return true;
		}else{
			return false;	
		}
	}
	
	public function setMessage($message){
		if(isset($message)){
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
		if(! $this->certificate){ return false; }
		if(! $this->message){ return false; }
		if(! $this->password){ return false; }
		
		$flag = false;
		$sent = array();
		$not_sent = array();
		$invalid_token = array();
		
		$this->apn = stream_context_create();
		stream_context_set_option($this->apn, 'ssl', 'local_cert', $this->certificate);
		stream_context_set_option($this->apn, 'ssl', 'passphrase', $this->password);
		
		// Open a connection to the APNS server
		$fp = stream_socket_client($this->url, $this->error,$this->error_string, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $this->apn);
		
		if (!$fp){
			return false;
			// Faild to open stream
		}
		
		// Create the payload body
		$body['aps'] = array('alert' => $this->message,
						 'sound' => 'default');

		// Encode the payload as JSON
		$payload = json_encode($body);

		// Build the binary notification
		if(!(is_array($this->device_tokens) && count($this->device_tokens)>=1)){ return false; }
		foreach($this->device_tokens as $token){
			if(strlen($token) > 32 && strlen($token) < 75){
				$msg = chr(0) . pack('n', 32) . pack('H*', $token) . pack('n', strlen($payload)) . $payload;
				$result = fwrite($fp, $msg, strlen($msg));
				if (!$result){
					// Message is not Deliverd
					//$this->error_string = 'Message not delivered';
					$not_sent[] = $token;
				}else{
					//$this->error_string = 'Message has been delivered';
					$sent[] = $token;
				}	
			}else{
				$invalid_token[] = $token;
			}
		}
		$response = array();
		$response['sent'] = $sent;
		$response['not_sent'] = $not_sent;
		$response['invalid_token'] = $invalid_token;
		
		if(count($this->device_tokens) == count($sent) ){
			$response['status'] = 'ok';
		}elseif(count($sent) > 0 ){
			$response['status'] = 'partial';
		}else{
			$response['status'] = 'error';	
		}
		// Close the connection to the server
		fclose($fp);
		return $response;
		
	}
}