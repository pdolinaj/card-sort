<?php

set_include_path(dirname(__FILE__) . '/../include' . PATH_SEPARATOR .get_include_path());

require_once('color.php');
require_once('pack.php');
require_once('minicard.php');
require_once('businesscard.php');

$minicard_pack = new pack();
$businesscard_pack = new pack();

// Create the maximum number of blank cards in a pack

for ($i = 0; $i < minicard::pack_max; $i++) {
	$minicard = new minicard();
	$minicard->set_bg_colour(color::mk_rnd_greyscale());
	$minicard->text = 'Pack ' . $i;
	$minicard_pack[$i] = $minicard;
}

for ($i = 0; $i < businesscard::pack_max; $i++) {
	$businesscard = new businesscard();
	$businesscard->set_bg_colour(color::mk_rnd_greyscale());
	$businesscard->text = 'Pack ' . $i;
	$businesscard_pack[$i] = $businesscard;
}

// Now we want to sort the pack so that the background colours are in order.
// Luckily, there's a method in the pack object to do this!

$minicard_pack->bgSort(false);
$businesscard_pack->bgSort(true);

// Now print them all out in pretty html

print 'Minicards: contains ' . count($minicard_pack) . ' width a depth of ' . $minicard_pack->getDepth();
foreach ($minicard_pack as $minicard) {
	$minicard->render();
}

print 'Businesscards: contains ' . count($businesscard_pack) . ' width a depth of ' . $businesscard_pack->getDepth();
foreach ($businesscard_pack as $minicard) {
	$minicard->render();
}


