## CARD SORT
### MOO.COM - Tech Test - 2019

#### Code fixes / improvements

1. The code had a bug when sorting colors with HEX value size of 3, e.g. "#FFF" which had to be converted into full 6 char "#FFFFFF" in order to be properly ordered.
2. Changed the sorting method inside pack.php -> bgSort() to not doing 100 x 100 array loops which should improve performance
3. Added some get / set methods for the "card" objects (business card, minicard) to allow more flexibility.
4. Separated color generating to a new class.

#### Suggestions

To give this even more flexibility, we could move all the properties of business card and minicard object into config files:

``
protected $w = 84;
protected $h = 55;
protected $d = 0.2;
const pack_max = 50;
const pack_depth = 10; 
``


(c) 2019 Peter Dolinaj