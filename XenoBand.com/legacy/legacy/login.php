<?php
    require_once 'includes/db_connect.php';
    require_once 'includes/functions.php';
     
    sec_session_start();
     
    if (login_check($mysqli) == true) {
        $logged = 'in';
    } else {
        $logged = 'out';
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Log In</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
    </head>
    <body>
        <?php
        if (isset($_GET['error'])) {
            echo '<h3 class="error">Error Logging In!</h3>';
            echo "<h4>".$_GET['error']."<br></h4>";
        }
        ?> 

    <div class="container" style="height:300px;width:300px">
        <form class="form-signin" action="/includes/process_login.php" method="post" name="login_form">   
            <h2 class="form-signin-heading">Sign in</h2>
             <label for="inputName" class="sr-only">Username:</label>
             <input class="form-control" placeholder="Username" type="text" name="username" required/>
             <label for="inputPassword" class="sr-only">Password</label>
             <input class="form-control" placeholder="Password" type="password" name="p" id="password" required/>
            <input class="btn btn-lg btn-primary btn-block" type="button" value="Login" 
                   onclick="formhash(this.form, this.form.password);" /> 
        </form>
    </div>

<?php
        if ($logged == 'in') {
                        echo '<div class="alert alert-info">
                                <strong>Info!</strong>
                                Currently logged as' . htmlentities($_SESSION['username'])
                                .'</div>';

            echo '<p>Do you want to change user? <a href="/includes/logout.php">Log out</a>.</p>';
        } else {
                        echo '<div class="alert alert-info">
                                <strong>Info!</strong> Currently logged ' . $logged . '<br>
                                If you don\'t have an account, please <a href=\'register.php\'>register</a>
                                </div>';
                        echo "<p></p>";
                }
?>      

    </body>
</html>