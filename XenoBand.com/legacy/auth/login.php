<?php
define(NL, "<br>");

$servername = "mysql.cs.iastate.edu";
$username = "dbu309grp10";
$password = "2vQUtgtfxFk";
echo "whatever shows";
$conn = mysql_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysql_error());
}

if (!mysql_select_db('db309grp10')) {
    die('Could not select database: ' . mysql_error());
}

$user = $_POST['username'];
$pswd = $_POST['psd'];

$query="SELECT name,password FROM users WHERE name='". $user."' AND password='".$pswd."';";
echo $query.NL;
// Perform Query
$result = mysql_query($query);
echo "result ".$result.NL;

// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}
else
{
  // use fetch_array later
  //$_SESSION['id']=$id;
echo "no session start?"
//  $_SESSION['username']=$user;
//  $_SESSION['pswd']=$pswd
  echo "Hi, ".$user." now you can create your music!";  
?>
<?php
}

// Free the resources associated with the result set
// This is done automatically at the end of the script
mysql_free_result($result);

//$stmt->close();
$conn->close();
?>
