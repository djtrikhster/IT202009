<?php
try{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require('conf.php');
    $connection = "mysql:host=$host;dbname=$database;charset=utf8mb4";

    $db = new PDO($connection, $username, $password)
}
catch(Exception $e)
{
    echo $e-> getMessage();
}
?>
