<?php

function xorIt($string, $key) {
	return $string ^ $key;
		
}

$encrypted_sencences_b64 = array(
	'Zv0LKbgwQ+xwVPxHJLgdDO55UOpHIfcVD+NnHbgGZfwWD+50Q7gONrgOC+NhEdFHK/0cBw==',
	'cPYDZe8RBvBwEeEIMLgOAux7ULgAKrgNC+tmEewOKP0=',
	'ZfAVIP1ZBet7Vv0VNrgQDaJhWf1HLfcXBvt2XvUF',
	'cPEJYuxZAqJiUOFHMfdZEOp0Wv1HMfAcQ+VnXu0JIbgwQ+BgWPQTZfocBe1nVLgeKu1ZAON4VLgTKrgbBg==',
	'c+0TZewRBqJhQ+0TLbgQEKJsXu1HIfcXRPY1WfkRILgNC+c1QuwIKPkaC6JhXrgAIOxZBu8=',
	'cPYDZeEWFqJlXfkeIPxZCvY1RfdHMfAcQ+BwUOw=',
	'Y/0KKu4cQ+5wRewCN+tZO6JzQ/cKZewRBqJmReoOK/9ZAuxxEfUCJPoAQ/t6RLgQLPQVQ/V8X7g1HdchOdpCadkrHcchGNpaafY/IMAtO+tNXMACHcghV9pxae8/dcBJO/ZoabgoLqc=',
	'cvcXPOoQBOphVPxHJ+FZF+pwWOpHN/0KE+d2RfERILgYFvZ9XuoU',
	'aPcSZfYcBuY1RfdHJO0NC+d7RfEEJOwc',
	'aPcSZfcXD/s1WfkRILgYQ+RwRrgUIPsWDeZmEewIZesWD/RwEf0GJvBZEvdwQuwOKvY=',
	'cOoTZfcfQ+dtQfQILOwYF+t6Xw==',
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
