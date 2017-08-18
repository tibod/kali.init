<?php

function xorIt($string, $key) {
	return $string ^ $key;
}

$encrypted_sencences_b64 = array(
	'...',
);

$encrypted_sencences = array();
foreach ($encrypted_sencences_b64 as $encrypted_sencence_b64){
	$encrypted_sencences[] = base64_decode($encrypted_sencence_b64);
}

$sId = 6;
$cNum = 6;
$cExpected = ' ';
$currentKey = 118;

$char_old = xorIt(substr($encrypted_sencences[$sId], $cNum, 1), chr($currentKey));
$char_new = xorIt(substr($encrypted_sencences[$sId], $cNum, 1), $cExpected);

echo 'old: '.ord($char_old).'-'.$char_old."\n";
echo 'new: '.ord($char_new).'-'.$char_new."\n";

exit;

?>
