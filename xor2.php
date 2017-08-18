<?php

function xorIt($string, $key) {
	return $string ^ $key;
		
}

$encrypted_sencences_b64 = array(
	'...'
);

$encrypted_sencences = array();
foreach ($encrypted_sencences_b64 as $encrypted_sencence_b64){
	$encrypted_sencences[] = base64_decode($encrypted_sencence_b64);
}
/*
80?
141,152
118?
*/	
$key = chr(49).chr(152).chr(103).chr(69).chr(152).chr(121).chr(99).chr(130).chr(21);
$key = str_repeat($key, 50);

foreach ($encrypted_sencences as $item){
	echo xorIt($item, $key);
	echo "\n";
}

?>
