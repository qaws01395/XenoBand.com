<?php
require_once 'db_connect.php';
require_once 'util.php';
require_once 'functions.php';
sec_session_start();
$error_msg = "";

function checkUser($user)
{
    global $mysqli, $error_msg;
    $prep_stmt = "SELECT id FROM users WHERE name = ? ";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows != 1) {
            // A user with this email address already exists
            $error_msg .= '<p class="error">Name of user does not exist.</p>';
                        $stmt->close();
        }
    } else {
        $error_msg .= '<p class="error">Database error in checkUser</p>';
                $stmt->close();
    }
}

function checkBandName($bname){
    global $mysqli, $error_msg;
    $prep_stmt = "SELECT id FROM bands WHERE band_name = ? ";
    $stmt = $mysqli->prepare($prep_stmt);

    if ($stmt) {
        $stmt->bind_param('s', $bname);
        $stmt->execute();
        $stmt->store_result();

            if ($stmt->num_rows == 1) {
                // A user with this username already exists
                $error_msg .= '<p class="error">'.$bname.' already exists.</p>';
                $stmt->close();
            }
        } else {            
            $error_msg .= '<p class="error">Database error in checkBandName</p>';
            $stmt->close();
    }
}

function checkUserEmail($name, $email){
    global $mysqli, $error_msg;
    $prep_stmt = "SELECT id FROM users WHERE name = ? AND email= ? ";
    $stmt = $mysqli->prepare($prep_stmt);

    if ($stmt) {
        $stmt->bind_param('ss', $name, $email);
        $stmt->execute();
        $stmt->store_result();

            if ($stmt->num_rows != 1) {
                // A user with this username already exists
                $error_msg .= '<p class="error">Member you entered'.$name.' has error with its name or email.</p>';
                $stmt->close();
            }
        } else {            
            $error_msg .= '<p class="error">Database error in checkUserEmail</p>';
            $stmt->close();
    }
}

 
if (isset($_POST['bname'], $_POST['manager'], $_POST['access'])) {

    // Sanitize and validate the data passed in
    $bandname = filter_input(INPUT_POST, 'bname', FILTER_SANITIZE_STRING);
    $manager = filter_input(INPUT_POST, 'manager', FILTER_SANITIZE_STRING);
    $access = filter_input(INPUT_POST, 'access', FILTER_SANITIZE_NUMBER_INT);

    //XXX user for loop
    for($i = 1; $i <= 3; $i++) {
        $mem = 'member' . $i;
        $$mem = $_POST[$mem];
        $email = 'email' . $i;
        $$email = $_POST[$email]; 

        if(isset($_POST[$$mem], $_POST[$$email])){
            $$mem = filter_input(INPUT_POST, 'member'.$i, FILTER_SANITIZE_STRING);
            $$email = filter_input(INPUT_POST, 'email'.$i, FILTER_SANITIZE_EMAIL);
            $$email = filter_var($$email, FILTER_VALIDATE_EMAIL);

            if (!filter_var($$email, FILTER_VALIDATE_EMAIL)) {
                // Not a valid email
                $error_msg .= '<p class="error">The email address of '.$$member.' you entered is not valid</p>';
            }
            checkUserEmail($$member, $$email);
        }
    }
    // if(isset($_POST['member1'], $_POST['email1'])){
    //     $member1 = filter_input(INPUT_POST, 'member1', FILTER_SANITIZE_STRING);
    //     $email1 = filter_input(INPUT_POST, 'email1', FILTER_SANITIZE_EMAIL);
    //     $email1 = filter_var($email1, FILTER_VALIDATE_EMAIL);

    //     if (!filter_var($email1, FILTER_VALIDATE_EMAIL)) {
    //         // Not a valid email
    //         $error_msg .= '<p class="error">The email address of '.$member1.' you entered is not valid</p>';
    //     }
    //     checkUserEmail($member1, $email1);
    // }
    // if(isset($_POST['member2'], $_POST['email2'])){
    //     $member2 = filter_input(INPUT_POST, 'member2', FILTER_SANITIZE_STRING);
    //     $email2 = filter_input(INPUT_POST, 'email2', FILTER_SANITIZE_EMAIL);
    //     $email2 = filter_var($email2, FILTER_VALIDATE_EMAIL);

    //     if (!filter_var($email2, FILTER_VALIDATE_EMAIL)) {
    //         // Not a valid email
    //         $error_msg .= '<p class="error">The email address of '.$member2.' you entered is not valid</p>';
    //     }
    //     checkUserEmail($member2, $email2);
    // }
    // if(isset($_POST['member3'], $_POST['email3'])){
    //     $member3 = filter_input(INPUT_POST, 'member3', FILTER_SANITIZE_STRING);
    //     $email3 = filter_input(INPUT_POST, 'email3', FILTER_SANITIZE_EMAIL);
    //     $email3 = filter_var($email3, FILTER_VALIDATE_EMAIL);

    //     if (!filter_var($email3, FILTER_VALIDATE_EMAIL)) {
    //         // Not a valid email
    //         $error_msg .= '<p class="error">The email of address of '.$member3.' you entered is not valid</p>';
    //     }
    //    checkUserEmail($member3, $email3);
    // }
 
    checkBandName($bandname);
    if($manager==$_SESSION['username'])
        checkUser($manager);
    else{
        echo $_SESSION['username'].'<br>';
        $error_msg = 'please use your name<br>';
    }
    
    if (empty($error_msg)) {
 

        // write a new bandinfo file, file format name:title:instrument
        $filename = $bandname . '.txt';
        $myfile = fopen($_SERVER['DOCUMENT_ROOT'].'/bandinfo/'.$filename, "w") or die("Unable to open file!");
        $txt = $manager."\tcaptain\t"."\n";
        fwrite($myfile, $txt);
        if ($member1) {
            $txt = $member1."\tmember\t"."\n";
            fwrite($myfile, $txt);
        }
        if ($member2) {
            $txt = $member2."\tmember\t"."\n";
            fwrite($myfile, $txt);
        }
        if ($member3) {
            $txt = $member3."\tmember\t"."\n";
            fwrite($myfile, $txt);
        }
        fclose($myfile);

        // Insert the new band into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO bands (band_name, access, file ) VALUES (?, ?, ?)")) {
            $insert_stmt->bind_param('sis', $bandname, $access, $filename);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                echo 'there are some errors, try again!<br>';
            }
        }
        // Insert the new ownership into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO manager (band_name, manager) VALUES (?, ?)")) {
            $insert_stmt->bind_param('ss', $bandname, $manager);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                echo 'there are some errors, try again!<br>';
            }
        }
        echo 'successfully create one';
        header("Location: bandinfo.php" );
    }
}
?>