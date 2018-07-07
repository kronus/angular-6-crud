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
// echo 'my id: ' . $id; die();

include_once('../config.inc');

 //open connection to mysql db
$connection = mysqli_connect($server,$user,$pwd,$db) or die("Error " . mysqli_error($connection));

//fetch table rows from mysql db
$sql = "select * from coins where id=" . $id;
$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

// create an array
$mArr = array();

//fetch tha data from the database
while ($row = mysqli_fetch_assoc($result)) {
   $mArr[] = $row;
}

//convert to json
echo json_encode($mArr);

//close the connection
mysqli_close($connection);
?>
