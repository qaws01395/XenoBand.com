<?php
$servername = "mysql.cs.iastate.edu";
$username = "dbu309grp10";
$password = "2vQUtgtfxFk";

echo $servername;

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//echo $conn;
//echo "$conn->connect_error" ;
//echo "mysqli_connect_error()";

echo "Connected successfully";

$conn->close();

?>
