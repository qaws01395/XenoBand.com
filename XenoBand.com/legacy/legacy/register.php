<?php
require_once 'includes/register.inc.php';
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <title>Registration Form</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        <!-- <link rel="stylesheet" href="styles/main.css" /> -->
    </head>
    <body>
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>
        <!-- <ul>
            <li>Usernames may contain only digits, upper and lowercase letters and underscores</li>
            <li>Emails must have a valid email format</li>
            <li>Passwords must be at least 6 characters long</li>
            <li>Passwords must contain
                <ul>
                    <li>At least one uppercase letter (A..Z)</li>
                    <li>At least one lowercase letter (a..z)</li>
                    <li>At least one number (0..9)</li>
                </ul>
            </li>
            <li>Your password and confirmation must match exactly</li>
        </ul> -->
        <div class="container" style="height:300px;width:300px">
        <form class="form-register" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
              method="post" 
              name="registration_form">
            <h2 class="form-register-heading">Register with us</h2>
            <label for="inputName" class="sr-only">Username</label>
            <input class="form-control" id='username' name='username' placeholder="Username" type='text' required/>
            <label for="inputEmail" class="sr-only">Email:</label>
            <input class="form-control" id="email" name="email" placeholder="Email Address" type="text" required/>
            <label for="inputPassword" class="sr-only">Password</label>
            <input class="form-control" id="password" name="password" placeholder="Password" type="password" required/>
            <label for="inputconfrim" class="sr-only">Confirm password:</label>
            <input class="form-control" id="confirmpwd" name="confirmpwd" placeholder="Confirm password" type="password" required/><br>
            <input class="btn btn-lg btn-primary btn-block" type="button" value="Register" 
                   onclick="return regformhash(this.form,
                                   this.form.username,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirmpwd);" /> 
        </form>
        </div>
        <p>Return to the <a href="index.php">login page</a>.</p>
    </body>
</html>