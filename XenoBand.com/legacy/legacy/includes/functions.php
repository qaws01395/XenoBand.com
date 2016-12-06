<?php
/**
* These functions will do all the processing of the login script.
*/
require_once 'psl-config.php';
require_once 'util.php';

function sec_session_start() {
// debug_info(TRUE);
    $session_name = 'sec_session_id';   // Set a custom session name
    
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
    session_regenerate_id(true);    // regenerated the session, delete the old one. 
}

function login($username, $password, $mysqli) {
    // Using prepared statements means that SQL injection is not possible. 
    if ($stmt = $mysqli->prepare("SELECT id, name, password 
        FROM users
       WHERE name = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $username);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();

        // get variables from result.
        $stmt->bind_result($stored_id, $stored_username, $stored_password);
        $stmt->fetch();
 
        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts 
 
            if (checkbrute($stored_id, $mysqli) == true) {
                // Account is locked 
                // Send an email to user saying their account is locked
                $_SESSION['err'] = "brute force attack detected.";
                // block ip
                return false;
            } else {
                // Check if the password in the database matches
                // the password the user submitted. We are using
                // the password_verify function to avoid timing attacks.
                if($password === $stored_password){
                // if (password_verify($password, $password)) {
                    
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $stored_id = preg_replace("/[^0-9]+/", "", $stored_id);
                    $_SESSION['user_id'] = $stored_id;
                    // XSS protection as we might print this value
                    $stored_username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $stored_username);
                    $_SESSION['username'] = $stored_username;
                    $_SESSION['login_string'] = hash('sha512',
                              $stored_password . $user_browser);
                    // Login successful.
                    // success login doesn't count for brute force
                    $mysqli->query("DELETE FROM login_attempts ORDER bY time DESC LIMIT 1");//XXX probably update it a success attempt is better
                    $mysqli->query("UPDATE users SET online=1, offline_time='0000-00-00 00:00:00' 
                        WHERE name='".$stored_username."'");
                    return true;
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $_SESSION['err'] = 'Password not correct.';
                    $now = time();
                   $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                   VALUES ('$stored_id', '$now')");
                    return false;
                }
            }
        } else {
            // No user exists.
            $_SESSION['err'] = "Username doesn't exist.";
            return false;
        }
    }
}

function checkbrute($stored_id, $mysqli) {
    // Get timestamp of current time 
    $now = time();
 
    // All login attempts are counted from the past 2 hours. 
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($stmt = $mysqli->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $stored_id);
 
        // Execute the prepared query. 
        $stmt->execute();
        $stmt->store_result();
 
        // If there have been more than 5 failed logins 
        if ($stmt->num_rows >= 5) {
            return true;
        } else {
            // echo "Error username or password. You have failed for ".($stmt->num_rows+1)."/5 times." ;
            return false;
        }
    }
}
function hash_helper()
{
    if(!function_exists('hash_equals'))
    {
        function hash_equals($str1, $str2)
        {
            if(strlen($str1) != strlen($str2))
            {
                return false;
            }
            else
            {
                $res = $str1 ^ $str2; // XOR
                $ret = 0;
                for($i = strlen($res) - 1; $i >= 0; $i--)
                {
                    $ret |= ord($res[$i]);// ord takes string and returns ascii value
                }
                return !$ret;
            }
        }
    }
}

function login_check($mysqli) {
    // Check if all session variables are set 
    if (isset($_SESSION['user_id'], 
                        $_SESSION['username'], 
                        $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
 
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT password 
                                      FROM users 
                                      WHERE id = ? LIMIT 1")) {
            // Bind "$user_id" to parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
                hash_helper();
                if (hash_equals($login_check, $login_string) ){
                    // Logged In!!!! 
                    return true;
                } else {
                    // Not logged in 
                    return false;
                }
            } else {
                // Not logged in 
                return false;
            }
        } else {
            // Not logged in 
            return false;
        }
    } else {
        // Not logged in 
        return false;
    }
}

function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}

?>