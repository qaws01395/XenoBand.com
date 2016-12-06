<?php
require_once 'includes/db_connect.php';

if (isset($_POST['deletefile'])) {
    if ($stmt = $mysqli->prepare("DELETE FROM sound_files WHERE file = ?")) {
		$stmt->bind_param('s', $_POST['deletefile']);  
		unlink($_SERVER['DOCUMENT_ROOT'].'/slib/'.$_POST['deletefile']);
		
		// if (!unlink($_SERVER['DOCUMENT_ROOT'].'/slib/'.$_POST['deletefile']))
		// {
		// 	echo ("Error deleting $file");
		// }
		// else
		// {
		// 	echo ("Deleted $file");
		// }
		
		if($stmt->execute()){
			header('Location: sound_library.php');
		}
		
	} else {
		echo "You haven't deleted sound file.<br>";
	}	
}
?>