<?php

set_time_limit(60000);

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

$key_length = 9;
$encrypted_chars = array();
foreach ($encrypted_sencences as $encrypted_sencence){
	for ($x = 0; $x< strlen($encrypted_sencence); $x++){
		$mod = $x % $key_length;

		if (!@is_array($encrypted_chars[$mod])) $encrypted_chars[$mod] = array();

		$encrypted_chars[$mod][] = substr($encrypted_sencence, $x, 1);
	}
}

$possible_key_characters = array();
foreach ($encrypted_chars as $encrypted_chars_index => $encrypted_char){
	$encrypted_chars_string = implode($encrypted_char);
	//$encrypted_chars_string = substr($encrypted_chars_string, 0, 40);
	
	$possible_key_characters[$encrypted_chars_index] = array();
	//bruteforce_chars
	for ($x = 1; $x <= 255; $x++){
		$key_char = chr($x);
		$key = str_repeat($key_char, strlen($encrypted_chars_string));
		
		$result = xorIt($encrypted_chars_string, $key);
		
		
		
		//check if only proper chars
		if (preg_match('/^[ A-Za-z0-9.,_-\{\}\?\']*$/', $result) == 0){
			//echo $x." - false\n";
			continue;
		}
		
		echo $x.' - '.$result." - ok\n";
		
		$possible_key_characters[$encrypted_chars_index][] = $x;
	}
}

var_dump($possible_key_characters);

?>
