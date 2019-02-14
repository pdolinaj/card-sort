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
	 * @param bool $asc True for ascending, false for not
	 */
	public function bgSort($asc = true) {

		// Rearrange the contents of the pack based on the bg colour

        //THIS SHOULD BE FASTER instead of doing 100 x 100 array loop

        //make a copy of the array
        $array = iterator_to_array($this);

        //sort ASC / DESC
        if($asc === true) {
            usort($array, array($this, 'sortColorAsc'));
        } else {
            usort($array, array($this, 'sortColorDesc'));
        }

        //replace array in iterator
        foreach($this as $key => $row) {
            $this[$key] = $array[$key];
        }

//		for ($i = 0; $i < count($this); $i++) {
//			for ($j = 0; $j < count($this); $j++) {
//				$this_colour = hexdec(preg_replace('/#/', '', $this[$i]->get_bg_colour()));
//				$next_colour = hexdec(preg_replace('/#/', '', $this[$j]->get_bg_colour()));
//
//				if ($asc) {
//					if ($this_colour < $next_colour) {
//						// Switch them around
//
//						$tmp = $this[$i];
//						$this[$i] = $this[$j];
//						$this[$j] = $tmp;
//					}
//				}
//				else {
//					if ($this_colour > $next_colour) {
//						// Switch them around
//
//						$tmp = $this[$i];
//						$this[$i] = $this[$j];
//						$this[$j] = $tmp;
//					}
//				}
//			}
//		}
	}

	//Take advantage of USORT function and spaceship operator <=> (PHP7) for simplicity
    private function sortColorAsc($a, $b): int
    {
        return hexdec($this->getColorFullHexValue(preg_replace('/#/', '', $a->get_bg_colour()))) <=> hexdec($this->getColorFullHexValue(preg_replace('/#/', '', $b->get_bg_colour())));
    }

    private function sortColorDesc($a, $b): int
    {
        return hexdec($this->getColorFullHexValue(preg_replace('/#/', '', $b->get_bg_colour()))) <=> hexdec($this->getColorFullHexValue(preg_replace('/#/', '', $a->get_bg_colour())));
    }

    /**
     * FIX for 3 char color length e.g. #FFF, #444, et.c
     * Return as 6 CHAR, e.g. #FFFFFF, #444444 so it can be correctly ordered because hexdec('fff') != hexdec('ffffff')
     *
     * @param string $color
     * @return string
     */
    private function getColorFullHexValue(string $color): string
    {
        if(strlen($color) == 3) {
            $color = sprintf('%s%s%s%s%s%s', $color[0], $color[0], $color[1], $color[1], $color[2], $color[2]);
        }
        return $color;
    }
	
	/**
	 * Calculate the total depth of cards in a pack
	 */
	public function getDepth() {
        $depth = 0;
		foreach ($this as $card) {
			$depth += $card->getDepth();
		}
		return $depth;
	}
}