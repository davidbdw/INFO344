<?php

$number = $REQUEST_['n'];

for ($i = 2; $i <= ($number - 1); $i++) {
	if ($i % 2 == 0) {
		print $i.', ';
	}
	if ($number % 2 == 0) {
		print $number;
	}
	
}


?>