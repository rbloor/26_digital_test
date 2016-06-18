<?php 

class Request {

	public $info;
	public $data;

	public function __contruct() {
		return $this;
	}

	public function get($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		$this->data = curl_exec($ch);
		$this->info = curl_getinfo($ch);
		curl_close($ch);
	}

	public function validate() {
		return (!empty($this->info) && $this->info['http_code'] == "200") ? true : false;
	}

}

?>