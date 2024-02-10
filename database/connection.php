<?php 

$host="localhost";
$name="root";
$password="";
$database="life_pharma";

$connection = new mysqli($host, $name, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

?>
