<?php
require_once 'db_connect.php';
require_once 'functions.php';
sec_session_start();
 
$dateTime = date("Y-m-d H:i:s", strtotime("-5 hours"));// Iowa time XXX hope to change the time according to region
$mysqli->query("UPDATE users SET online=0, offline_time='".$dateTime."' 
                        WHERE name='".$_SESSION['username']."'");

// Unset all session values 
$_SESSION = array();

// Destroy session 
session_destroy();
header('Location: ../index.php');

?>
