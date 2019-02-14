<?php

class color {

    /**
     * Make a greyscale colour
     * TODO: we could make sure that the HEX color generated will be always 6 CHARS
     * (see the getColorFullHexValue() method inside pack.php)
     *
     * @return string
     */
    public static function mk_rnd_greyscale(): string {
        $col = rand(0, 256);
        $hex = dechex($col);
        return '#' . $hex.$hex.$hex;
    }

}