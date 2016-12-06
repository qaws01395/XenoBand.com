<?php
require_once 'includes/db_connect.php';
require_once 'includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <title>Protected Page</title>
        <!-- <link rel="stylesheet" href="styles/main.css" /> -->
    </head>
    <body>
        <div class="page-header">
            <?php if (login_check($mysqli) == true) : ?>
            <h1>Welcome <?php echo htmlentities($_SESSION['username']); ?>!
            <small>Just a notice page.</small></h1>
        </div>
        <div class="well-sm">
            Return to <a href="index.php">Home page</a>
        </div>
        <?php else : ?>
            <p>
            <div class="alert alert-warning">
                <strong>Warning!</strong> You are not authorized to access this page.
                <br>
                Please <a href="login.php">login</a>.
            </div>
            </p>
        <?php endif; ?>
    </body>
</html>