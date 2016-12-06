<?php
require_once 'includes/db_connect.php';
require_once 'includes/functions.php';
sec_session_start();

if (isset($_POST['delete_member'], $_POST['delete_title'], $_POST['delete_instrument'], $_POST['band'])) {
    $filename = $_POST['band'] . '.txt';
    $filename = $_SERVER['DOCUMENT_ROOT'].'/bandinfo/'.$filename;

    $file_handle = fopen( $filename, "r");
    $line = '';
    while (!feof($file_handle)) {
        list($field1, $field2, $field3) = fscanf($file_handle, "%s\t%s\t%s\n");
	    if($field1==$_POST['delete_member'] && $_POST['delete_member']==$_SESSION['username']){
            $mysqli->query("DELETE FROM bands WHERE band_name=\"$_POST['band']\" ");
        }
        else if($field1==$_POST['delete_member'] && $field2==$_POST['delete_title'] && $field3==$_POST['delete_instrument']){
	    	$line = sprintf("%s\t%s\t%s\n", $field1, $field2, $field3);
	    	echo ("delete $file1 <br>");
	    	echo ("delete the line $line <br>");
	    }

    }
    fclose($file_handle);

    $contents = file_get_contents($filename);
	$contents = str_replace($line, '', $contents);
	file_put_contents($filename, $contents);
    header("Location: bandinfo.php");
}
?>