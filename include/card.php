<?php

class card {
	/**
	 * @var int Width of a card
	 */
	protected $w = null;
	
	/**
	 * @var int Height of a card
	 */
	protected $h = null;
	
	/**
	 * @var Depth of a card
	 */
	protected $d = null;
	
	/**
	 * @var string The background colour of a card
	 */
	protected $bg_colour = '#ffffff';
	
	/**
	 * @var int Max number of cards you can fit into its pack
	 */
	const pack_max = null;
	
	function __construct() {
		
	}


    /**
     * Set the width of a card
     *
     * @param $width
     */
    public function setWidth($width) {
        $this->w = $width;
    }

    /**
     * Return the width of a card
     *
     * @return int
     */
    public function getWidth() {
        return $this->w;
    }

    /**
     * Set the height of a card
     *
     * @param $height
     */
    public function setHeight($height) {
        $this->h = $height;
    }

    /**
     * Return the height of a card
     *
     * @return int
     */
    public function getHeight() {
        return $this->h;
    }

    /**
     * Set the depth of a card
     * @param $depth
     */
	public function setDepth($depth) {
	    $this->d = $depth;
    }
	
	/**
	 * Return the depth of a card
	 * 
	 * @return int
	 */
	public function getDepth() {
		return $this->d;
	}
	
	/**
	 * Set the background colour of a card
	 * 
	 * @param string $colour
	 */
	public function set_bg_colour($colour) {
		$this->bg_colour = $colour;
	}
	
	/**
	 * Get the background colour of a card
	 */
	public function get_bg_colour() {
		return $this->bg_colour;
	}
	
	public function render() {
		print '<div style="border: 1px solid #000000; padding: 2px; margin: 2px; width:' . $this->w . 'px; height: ' . $this->h . 'px; background-color: ' . $this->bg_colour . '">' . $this->text . ' : '.$this->bg_colour . '</div>';
	}
}