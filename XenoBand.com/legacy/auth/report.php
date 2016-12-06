<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Register Page</title>
</head>
<body>
  <h2>User register</h2>

<?php

// Create connection
$conn = new mysqli($SERVER, $USER, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO users (username, password, ip_address) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $password, $ip_address);
 
  $name = $_POST['firstname'] . ' ' . $_POST['lastname'];
  $username = $_POST['username'];
  $psd = $_POST['psd'];
  $email = $_POST['email'];

  echo $name;
  echo 'Thanks for registering.<br />';

?>

</body>
</html>
