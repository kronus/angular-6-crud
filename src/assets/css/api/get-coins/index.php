<?php
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
$sql = "select * from coins";
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
