<?php
function destroy_session() {
        if (session_id() == "") {
            session_start();
        }
        if ( isset( $_COOKIE[session_name()] ) ) {
            setcookie( session_name(), "", time()-3600, "/" );
        }
        $_SESSION = array();
        session_destroy();
    }
    function verify_session() {
        if (session_id() == "") {
            session_start();
        }
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            if ($_SERVER['HTTP_USER_AGENT'] != $_SESSION['user_agent'] || $_SERVER['REMOTE_ADDR'] != $_SESSION['remote_ip']) {
                destroy_session();
                die("Bad session.");
            }
            if ($_SESSION['last_request'] < time() - 300 || $_SESSION['start_time'] < time() - 1800) {
                destroy_session();
                die("Old session.");
            }
            $_SESSION['last_request'] = time();
            session_regenerate_id(true);
        }
    }
    function check_authenticated() {
        verify_session();
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
            return false;
        }
        return true;
    }
    function require_authenticated() {
        verify_session();
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
            die("Not logged in.");
        }
    }
?>
