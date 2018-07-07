<?php
$path = ltrim($_SERVER['REQUEST_URI'], '/');    // Trim leading slash(es)
$elements = explode('/', $path);                // Split path on slashes

global $name, $price;

if(!empty($elements[3]))
{
	$name = $elements[3];
}

if(!empty($elements[4]))
{
	$price = $elements[4];
}

global $server;
$server = "localhost";
global $user;
$user = "root";
global $pwd;
// $pwd = "gohome"; // production
 $pwd = "gohomE1k"; // local
global $db;
$db = "kronus";

 //open connection to mysql db
$connection = mysqli_connect($server,$user,$pwd,$db) or die("Error " . mysqli_error($connection));

//fetch table rows from mysql db
$sql = "INSERT into coins (name, price) VALUES('" . $name . "','" . $price . "')";

// echo $sql;
// die();

if ($connection->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $connection->error;
}

$connection->close();
?>
