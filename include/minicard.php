<?php

require_once('card.php');

class minicard extends card {
	const pack_max = 100;
	const pack_depth = 20;
	
	public function __construct() {
		$this->w = 70;
		$this->h = 28;
		$this->d = 0.2;
	}
}