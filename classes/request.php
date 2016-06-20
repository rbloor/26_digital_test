<?php 

class Request {

	public $endpoint;
	public $info;
	public $data;

	public function __construct($endpoint) {
		$this->endpoint = $endpoint;
		return $this;
	}

	public function get() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->endpoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		$this->data = curl_exec($ch);
		$this->info = curl_getinfo($ch);
		curl_close($ch);
		return $this;
	}

	public function validate() {
		// check for 200 response code and if url of response matches what we sent
		return (!empty($this->info) && $this->info['http_code'] == "200" && $this->info['url'] == STAGING_URL) ? true : false;
	}

}

?>