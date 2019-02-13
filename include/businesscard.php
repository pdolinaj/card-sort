<?php

require_once('card.php');

class businesscard extends card {
	protected $w = 84;
	protected $h = 55;
	protected $d = 0.2;
	
	const pack_max = 50;
	const pack_depth = 10;
}