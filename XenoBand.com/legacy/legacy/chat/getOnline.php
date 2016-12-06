<?php
require_once '../includes/db_connect.php';
require_once '../includes/functions.php';
sec_session_start();

$prep_stmt = "SELECT name, online, offline_time FROM users "; 
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->execute();
        $stmt->store_result();
 
        // get variables from result.
        $stmt->bind_result($namelist, $online, $offtime);
        while($stmt->fetch()){
        	if($online==1){
        		$list = sprintf("%s\tis online", $namelist);
        	}else{
        		$list = sprintf("%s\tis off from %s", $namelist, $offtime);
        	}
        	echo $list."<br>";
        } 
        $stmt->close();
    }
?>