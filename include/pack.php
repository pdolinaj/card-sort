<?php

/**
 * The pack object is basically an array of similar cards. It uses some of PHP's 
 * SPL interfaces so that we can handle the object as an array.
 * 
 * @author Dan Burzynski
 */

class pack implements Iterator, Countable, ArrayAccess{
	private $position = 0;
	private $array = array();

	public function __construct() {
		$this->position = 0;
	}
	
	public function rewind() {
		$this->position = 0;
	}
	
	public function current() {
		return $this->array[$this->position];
	}
	
	public function key() {
		return $this->position;
	}
	
	public function next() {
		++$this->position;
	}
	
	public function valid() {
		return isset($this->array[$this->position]);
	}
	
	public function count() {
		return count($this->array);
	}
	
	public function offsetSet($offset, $value) {
		$this->array[$offset] = $value;
	}
	
	public function offsetExists($offset) {
		return isset($this->array[$offset]);
	}
	
	public function offsetUnset($offset) {
		unset($this->array[$offset]);
	}
	
	public function offsetGet($offset) {
		return isset($this->array[$offset]) ? $this->array[$offset] : null;
	}
	
	/**
	 * Sort the contents of a pack in either accending or decending (depending on
	 * flag set) greyscale colour order. NOTE, this will not work with non-greyscale
	 * colurs so don't use it for that!
	 * 
	 * @param bool $asc True for assending, false for not
	 */
	public function bgSort($asc=true) {
		// Rearange the contents of the pack based on the bg colour 
		
		$tmp = array();
		
		for ($i = 0; $i < count($this); $i++) {
			for ($j = 0; $j < count($this); $j++) {
				$this_colour = hexdec(preg_replace('/#/', '', $this[$i]->get_bg_colour()));
				$next_colour = hexdec(preg_replace('/#/', '', $this[$j]->get_bg_colour()));
						
				if ($asc) {
					if ($this_colour < $next_colour) {
						// Switch them around
						
						$tmp = $this[$i];
						$this[$i] = $this[$j];
						$this[$j] = $tmp;
					}
				}
				else {
					if ($this_colour > $next_colour) {
						// Switch them around
						
						$tmp = $this[$i];
						$this[$i] = $this[$j];
						$this[$j] = $tmp;
					}
				}
			}
		}
	}
	
	/**
	 * Calculate the total depth of cards in a pack
	 */
	public function get_depth() {
		foreach ($this as $card) {
			$depth += $card->get_depth();
		}
		
		return $depth;
	}
}