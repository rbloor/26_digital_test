<?php 

class Parser {

	public $data;

	public function parse($raw, $content_type) {
		if (stripos($content_type, 'json') !== false) {
			$this->parseJson($raw);
		} elseif(stripos($content_type, "xml") !== false) {
			$this->parseXml($raw);
		} elseif(stripos($content_type, "text") !== false) {
			$this->parsePlain($raw);
		} 
	}

	public function parseXml($raw) {
		$this->data = simplexml_load_string($raw);
	}

	public function parseJson($raw) {
		$this->data = json_decode($raw);
	}

	public function parsePlain($raw) {
		preg_match_all("/([a-z_]+):(.(?![a-z_]+:))+/",$raw, $matches);
		foreach($matches[0] as $key => $value) {
			$temp = preg_split("/:/", $value);
			if ($temp[0] == 'arguments') {
				$this->data[$temp[0]] = preg_split('/-\s/', $value, -1, PREG_SPLIT_NO_EMPTY);
			} else {
				$this->data[$temp[0]] = $temp[1];
			}
		}
	}

}

?>