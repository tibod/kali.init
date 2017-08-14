<?php

function xorIt($string, $key) {
	return $string ^ $key;
}

$e1 = '....................';
$e2 = base64_decode($e1);

$l = strlen($e2);
for ($x = 0; $x<=255; $x++){
	$k = str_repeat(chr($x), $l);
	
	echo 'x = '.$x."\n".xorIt($e2, $k)."\n";
}

?>
