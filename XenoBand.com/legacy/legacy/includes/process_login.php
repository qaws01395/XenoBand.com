<?php
require_once 'db_connect.php';
require_once 'functions.php';
require_once 'util.php';

sec_session_start(); // Our custom secure way of starting a PHP session.

if (isset($_POST['username'], $_POST['p'])) {
    $username = $_POST['username'];
    $password = $_POST['p']; // The hashed password.
 
    if (login($username, $password, $mysqli) == true) {
        //Login success 
        
        header('Location: ../index.php');
    } else {
        // Login failed 
        $err = $_SESSION['err'];
        $_SESSION['err'] = NULL;
        header('Location: ../login.php?error='.$err);
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}