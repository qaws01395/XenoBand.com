<?php
require_once 'includes/db_connect.php';
require_once 'includes/functions.php';
sec_session_start();

$target_dir = "slib/";
// check for the strange filename
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = pathinfo($target_file, PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    echo "the file you chose ".$_POST["submit"]."<br>";
    $uploadOk = 1;
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

 // Check file size
if ($_FILES["fileToUpload"]["size"] < 10 ) { // 10 b
    echo "Sorry, your file is too small.";
    $uploadOk = 0;
}
else if ($_FILES["fileToUpload"]["size"] > 100000000 ) { // 1 Mb
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($fileType != "wav" && $fileType != "mid" ) {
    echo "Sorry, only WAV and MIDI files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	$now = time();
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    	//record INSERT INTO database 
    	if ($insert_stmt = $mysqli->prepare("INSERT INTO sound_files (username, file, mod_time) VALUES (?, ?, ?)")) {
            $insert_stmt->bind_param('ssd', $_SESSION['username'], $_FILES["fileToUpload"]["name"], $now);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ./error.php?err=Upload failure: INSERT');
            }else{
            	// header('Location: ./succes.php?suc='.$_SESSION['username'].', you have uploaded '.$_FILES["fileToUpload"]["name"] );
                header('Location: sound_library.php' );
            }
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>
