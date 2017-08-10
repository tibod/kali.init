<?php

set_time_limit(60000);
	
function xorIt($string, $key, $type = 0) {

		$x = bin2hex($string ^ $key);
		return hex2bin($x);
		
        $sLength = strlen($string);
        $xLength = strlen($key);
        for($i = 0; $i < $sLength; $i++) {
                for($j = 0; $j < $xLength; $j++) {
                        if ($type == 1) {
                                //decrypt
                                $string[$i] = $key[$j]^$string[$i];
                                 
                        } else {
                                //crypt
                                $string[$i] = $string[$i]^$key[$j];
                        }
                }
        }
        return $string;
}

$s1 = array(
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

$s2 = array();
foreach ($s1 as $item){
	$s2[] = base64_decode($item);
}

$t = $s2[6];

function allOk($pos, $key){
	global $s2;
	
	foreach ($s2 as $item){
		$r = xorIt($item, $key);
		$o = ord(substr($r, $pos, 1));
		//if (checkChars($o) === false) 
		//	return false;
		if ($o < 32 or $o > 126) 
			return false;
	}
	
	return true;
}

for ($x = 1; $x<= 255; $x++){
	$k = chr($x);//.chr($y).chr($z).chr($a);
	if (allOk(0, $k) === false) continue;
	
	for ($y = 1; $y<= 255; $y++){
		$k = chr($x).chr($y);//.chr($z).chr($a);
		if (allOk(1, $k) === false) continue;
		
		for ($z = 1; $z<= 255; $z++){
			$k = chr($x).chr($y).chr($z);//.chr($a);
			if (allOk(2, $k) === false) continue;
			
			for ($a = 1; $a<= 255; $a++){
				$k = chr($x).chr($y).chr($z).chr($a);
				if (allOk(3, $k) === false) continue;
				
				for ($b = 1; $b<= 255; $b++){
					$k = chr($x).chr($y).chr($z).chr($a).chr($b);
					if (allOk(4, $k) === false) continue;
					
					for ($c = 1; $c<= 255; $c++){
						$k = chr($x).chr($y).chr($z).chr($a).chr($b).chr($c);
						if (allOk(5, $k) === false) continue;

						for ($d = 1; $d<= 255; $d++){
							$k = chr($x).chr($y).chr($z).chr($a).chr($b).chr($c).chr($d);
							if (allOk(6, $k) === false) continue;

							for ($e = 1; $e<= 255; $e++){
								$k = chr($x).chr($y).chr($z).chr($a).chr($b).chr($c).chr($d).chr($e);
								if (allOk(7, $k) === false) continue;

								for ($f = 1; $f<= 255; $f++){
									$k = chr($x).chr($y).chr($z).chr($a).chr($b).chr($c).chr($d).chr($e).chr($f);
									$k = $k.$k.$k.$k.$k.$k.$k.$k.$k.$k.$k.$k.$k.$k.$k;
									if (allOk(8, $k) === false) continue;

									//echo $x.'-'.$y.'-'.$z.'-'.$a.'-'.$b.'-'.$c.'-'.$d.'-'.$e.'-'.$f."\n";
									foreach ($s2 as $item){
										echo xorIt($item, $k)."\n";
									}
								}
							}
						}
					}
				}
			}
		}
	}
}

function checkChars($charCode){
	$chars = array(32, 44, 46, 48, 49, 50, 51,52,53,54,55,56,57,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,95,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,125);
	if (!in_array($charCode, $chars)){
		return false;
	}
}
//32-126

exit;

foreach ($d1 as $key => $item){
	/*
	for ($x = 0; $x < strlen($item); $x++){
		//echo 'key: '.$key.', move: '.$x.'<br />';
		$xor = xorIt(substr($item, $x, 1000), $k);
		
		if (preg_match('#.*[ A-Za-z]{3}.*#', $xor)){
			echo $xor.'<br />';
		}
		//echo '<br />';
	}
	*/
	
	
	//echo xorIt($item, $k).'<br />';
	
}

?>
