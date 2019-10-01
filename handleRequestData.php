<?php
	echo "<pre>" . var_export($_GET, true) . "</pre>";

	if(isset($_GET['name'])){
		echo "<br>Hello, " . $_GET['name'] . "<br>";
	}

	//$number = 0;
	//$number2 = 0;

	if(isset($_GET['number'])){
		$number = (int)$_GET['number'];
		echo "<br>" . $number . " should be a number...";
		echo "<br>but it might not be<br>";
	}
	if(isset($_GET['number2'])){
		$number2 = (int)$_GET['number2'];
		}
	//if (!((is_numeric($number)||(is_numeric($number2))))){
	//}
	echo "<br> if invalid inputs, value of invalid charachters set to zero '3b' = 3 <br>";
	
	echo "<br> number 1: " . $number . " number2: " . $number2 . "<br>"; 
	echo"<br> Addition:" . ($number + $number2) . "<br>";
	echo "<br> Concatonation: " . $number . $number2 . "<br>";
	//TODO
	//handle addition of 2 or more parameters with proper number parsing
	//concatenate 2 or more parameter values and echo them
	//try passing multiple same-named parameters with different values
	//try passing a parameter value with special characters


	//web.njit.edu/~ucid/IT202/handleRequestData.php?parameter1=a&p2=b
?>
