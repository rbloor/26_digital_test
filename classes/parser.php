<?php 

class Parser {

	public $raw_data;
	public $parsed_data;
	public $content_type;

	public function __construct($request) {
		$this->parsed_data = new stdClass();
		$this->raw_data = $request->data;
		$this->content_type = $request->info['content_type'];
		return $this;
	}

	public function parse() {
		if (stripos($this->content_type, 'json') !== false) {
			$this->parseJson();
		} elseif(stripos($this->content_type, "xml") !== false) {
			$this->parseXml();
		} elseif(stripos($this->content_type, "text") !== false) {
			$this->parsePlain();
		} 
		return $this;
	}

	public function parseXml() {
		$this->parsed_data = json_decode(json_encode(simplexml_load_string($this->raw_data)));
	}

	public function parseJson() {
		$this->parsed_data = json_decode($this->raw_data);
	}

	public function parsePlain() {
		$values = preg_split("/(([a-z_]+):)/",$this->raw_data);
		$this->parsed_data->solved_challenge = trim($values[1]);
		$this->parsed_data->challenge = new StdClass();
		$this->parsed_data->challenge->type = trim($values[3]);
		$this->parsed_data->challenge->arguments = preg_split("/- /", trim($values[4]), -1, PREG_SPLIT_NO_EMPTY);
		$this->parsed_data->endpoint = trim($values[5]);
	}

}

?>