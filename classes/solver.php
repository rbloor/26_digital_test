<?php 

class Solver {

	public $answer;
	public $type;
	public $arguments;

	public function __construct($parser) {
		$this->type = $parser->parsed_data->challenge->type;
		$this->arguments = $parser->parsed_data->challenge->arguments;
		return $this;
	}

	public function solve() {
		switch ($this->type) {
			case 'addition':
				$this->solve_addition();
			break;
			case 'multiplication':
				$this->solve_multiplication();
			break;
			case 'is_palindrome':
				$this->solve_palindrome();
			break;
			case 'is_anagram':
				$this->solve_anagram();
			break;
			case 'next_fibonacci_number':
				$this->solve_fibonacci();	
			break;
		}
		return $this;
	}

	public function solve_addition() {
		$this->answer = array_sum($this->arguments);
	}

	public function solve_multiplication() {
		$this->answer = array_product($this->arguments);
	}

	public function solve_palindrome() {
		$string = preg_replace("/[^a-z]/", "", strtolower($this->arguments[0]));
		$this->answer =  strrev($string) == $string ? 1 : 0;
	}

	public function solve_anagram() {
		$string1 = preg_replace("/[^a-z]/", "", strtolower($this->arguments[0]));
		$string2 = preg_replace("/[^a-z]/", "", strtolower($this->arguments[1]));
		$this->answer = (count_chars($string1, 1) == count_chars($string2, 1)) ? 1 : 0;
	}

	public function solve_fibonacci() {
		$this->answer =  round(pow((sqrt(5)+1)/2, count($this->arguments)+1) / sqrt(5));
	}

}

?>