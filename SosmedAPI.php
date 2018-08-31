<?php
require_once 'vendor/autoload.php';
use \Curl\Curl;

class SosmedAPI{

	private $token;
	private $response;
	private $apiUrl = 'http://localhost/sosmed-api/json';
	
	function  __construct($apiUrl=null){
		if(!empty($apiUrl) && filter_var($apiUrl, FILTER_VALIDATE_URL)) $this->apiUrl = $apiUrl;
	}
	
	public function setToken($token){
		$this->token=$token;
	}
	
	public function api($web, $type, array $param){
		$url = $this->apiUrl . "/". $web . "/". $type;
		
		$curl = new Curl();
		$curl->setHeader('Authorization', "Bearer $this->token");
		$curl->post($url, $param);

		if ($curl->error) {
			echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
		} else {
			$this->response = $curl->response;
			return $this;
		}
	}
	
	public function output(){
		return $this->response;
	}
	
	public function output_array(){
		return json_decode($this->response, true);
	}
	
}
