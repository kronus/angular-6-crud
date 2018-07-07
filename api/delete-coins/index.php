<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
$path = ltrim($_SERVER['REQUEST_URI'], '/');    // Trim leading slash(es)
$elements = explode('/', $path);                // Split path on slashes

global $id;

if(!empty($elements[3]))
{
	$id = $elements[3];
}

include_once('../config.inc');

 //open connection to mysql db
$connection = mysqli_connect($server,$user,$pwd,$db) or die("Error " . mysqli_error($connection));

//fetch table rows from mysql db
$sql = "DELETE from coins WHERE id=" . $id;

// echo $sql;
// die();

if ($connection->query($sql) === TRUE) {
  //  echo "Record deleted successfully";
} else {
  //  echo "Error updating record: " . $connection->error;
}

$connection->close();
?>
