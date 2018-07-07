<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
$path = ltrim($_SERVER['REQUEST_URI'], '/');    // Trim leading slash(es)
$elements = explode('/', $path);                // Split path on slashes

global $id, $name, $price;

if(!empty($elements[3]))
{
	$id = $elements[3];
}

if(!empty($elements[4]))
{
	$name = $elements[4];
}

if(!empty($elements[5]))
{
	$price = $elements[5];
}

include_once('../config.inc');

 //open connection to mysql db
$connection = mysqli_connect($server,$user,$pwd,$db) or die("Error " . mysqli_error($connection));

//fetch table rows from mysql db
$sql = "UPDATE coins SET name='" . $name . "', price='" . $price . "' WHERE id=" . $id;

if ($connection->query($sql) === TRUE) {
   // echo "Record updated successfully";
} else {
   // echo "Error updating record: " . $connection->error;
}

$connection->close();
?>
