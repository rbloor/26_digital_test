<?php 

class Solver {

	public $answer = "";

	public function solve($type, $args) {
		switch ($type) {
			case 'addition':
				$this->answer = array_sum($args);
			break;
			case 'multiplication':
				$this->answer =  array_product($args);
			break;
			case 'is_palindrome':
				$this->answer =  strrev($args[0]) == $args[0];
			break;
			case 'is_anagram':
				$this->answer = (count_chars($args[0], 1) == count_chars($args[1], 1));
			break;
			case 'next_fibonacci_number':
				$this->answer =  round(pow((sqrt(5)+1)/2, count($args)+1) / sqrt(5));
			break;
			default:
				return false;
			break;
		}
		return true;
	}

}

?>