<?php
require_once 'db_connect.php';
// require_once 'psl-config.php';
require_once 'util.php';

$error_msg = "";

 
if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {

    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }
 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
 
    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
 
   // check existing email  
    $prep_stmt = "SELECT id FROM users WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            $error_msg .= '<p class="error">A user with this email address already exists.</p>';
                        $stmt->close();
        }
    } else {
        $error_msg .= '<p class="error">Database error Line 46</p>';
                $stmt->close();
    }
 
    // check existing username
    $prep_stmt = "SELECT id FROM users WHERE name = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
 
                if ($stmt->num_rows == 1) {
                        // A user with this username already exists
                        $error_msg .= '<p class="error">A user with this username already exists</p>';
                        $stmt->close();
                }
        } else {            
                $error_msg .= '<p class="error">Database error line 55</p>';
                $stmt->close();
        }
 
    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.
    if (empty($error_msg)) {
        // Create hashed password using the password_hash function.
        // This function salts it with a random salt and can be verified with
        // the password_verify function.
        // $password = password_hash($password, PASSWORD_BCRYPT);

        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO users (name, password, email, online, offline_time) VALUES (?, ?, ?, ?, ?)")) {
            $online = 0;
            $time = "0000-00-00 00:00:00";
            $insert_stmt->bind_param('sssis', $username, $password, $email, $online, $time);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                echo "There's an error <br>";
            }
        }
        header('Location: ../index.php');
    }
}
?>