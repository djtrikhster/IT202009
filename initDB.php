<?php
#turn error reporting on
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//pull in config.php so we can access the variables from it
require('conf.php');
echo "Loaded Host: " . $host;

$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";

try{
	$db = new PDO($conn_string, $username, $password);
	echo "Connected";
	$query = "create table if not exists `TestUsers`(
		`id` int auto_increment not null,
		`username` varchar(30) not null unique,
		`pin` int default 0,
		PRIMARY KEY (`id`)
		) CHARACTER SET utf8 COLLATE utf8_general_ci";
	$stmt = $db->prepare($query);
	$r = $stmt->execute();
	echo "<br>" . $r . "<br>";

	$insert_query = "INSERT INTO `TestUsers` (`id`, `username`, `pin`) VALUES ('11', 't23est', '032000')";
	$stmt = $db->prepare($insert_query);
	$r = $stmt->execute();

	
	$randID = rand(1, 1000);
	$randUser = 'TestUser' . rand(1, 1000);
	$randPin = rand(1, 1000);
	echo $randID . ' ' . $randUser . ' ' . $randPin;
	
	
	$insert_rand = "INSERT INTO `TestUsers` (`id`, `username`, `pin`) VALUES ('$randID', '$randUser', '$randPin')";
	$stmt = $db->prepare($insert_rand);
	$r = $stmt->execute();
	echo "<br>" . $r . "<br>";
	echo "<br />" . 'inserted';

	$insert_query= "INSERT INTO  `TestUsers` (`username`, `pin`) VALUES (:username, :pin)"; 
	$stmt = $db->prepare($insert_query);
	$user = "George Washington";
	$pin = 1234;
	//$stmt = bindParam(":username" = $user, PDO::PARAM_STR);
	//$stmt = bindParam(":id" = $pin, PDO::PARAM_INT);
	//https://stackoverflow.com/questions/26349005/php-warning-pdostatementexecute-sqlstatehy093-invalid-parameter-number
	$r = $stmt->execute(array(":username"=>$user, ":pin"=>$pin));
	print_r($stmt->errorInfo());

	$select_query = "SELECT * FROM `TestUsers` WHERE username = :username";
	$stmt = $db->prepare($select_query);
	$r = $stmt->execute();

	$result = $stmt->fetch();
	echo "<br><pre>" . var_export($result, true) . "</pre><br>";
	

}
catch(Exception $e){
	echo $e->getMessage();
	exit("Something went wrong");
}
?>