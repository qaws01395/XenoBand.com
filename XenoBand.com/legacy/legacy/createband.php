<?php
require_once 'includes/createband.inc.php';
require_once 'includes/db_connect.php';
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

        <title>Create Band!</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
    </head>
    <body>
    <?php if (login_check($mysqli) == true) : ?>

        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>

        <div class="container" style="height:300px;width:300px">
         <form class="form-group" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
              method="post" 
              name="createband_form">
            <h1 class="form-createband-heading">Create your own band!</h1>
            <label for="inputBName" class="sr-only">Band Name</label>
            <input class="form-control" id='bname' name='bname' placeholder="Name your own awesome band!" type='text' required/>
            <label for="inputManager" class="sr-only">Name: </label>
            <input class="form-control" id="manager" name="manager" placeholder="Your name" type="text" required/>
            
            <label for="inputMember1" class="sr-only">Member: </label>
            <input class="form-control" id="member1" name="member1" placeholder="Invite your buddy!" type="text" />
            <label for="inputEmail1" class="sr-only">Email: </label>
            <input class="form-control" id="email1" name="email1" placeholder="Email Address" type="text" />

			<label for="inputMember2" class="sr-only">Member: </label>
            <input class="form-control" id="member2" name="member2" placeholder="Invite your buddy!" type="text" />
            <label for="inputEmail" class="sr-only">Email: </label>
            <input class="form-control" id="email2" name="email2" placeholder="Email Address" type="text" />

            <label for="inputMember3" class="sr-only">Member: </label>
            <input class="form-control" id="member3" name="member3" placeholder="Invite your buddy!" type="text" />
            <label for="inputEmail" class="sr-only">Email: </label>
            <input class="form-control" id="email3" name="email3" placeholder="Email Address" type="text" />
            
			<div class="radio" data-toggle="tooltip" title="Seen to everyone">
			  <label><input type="radio" name="access" id="public" value="2" >public</label>
			</div>
			<div class="radio" data-toggle="tooltip" title="The manager in the band can see the band hold by its members">
			  <label><input type="radio" name="access" id="protected" value="1">protected</label>
			</div>
			<div class="radio" data-toggle="tooltip" title="only member can see the band" >
			  <label><input type="radio" name="access" id="private" value="0" checked>private</label>
			</div>
 
            <input class="btn btn-lg btn-primary btn-block" type="button" value="Band up!" 
                   onclick="this.form.submit();" 
                                   /> 
        </form>
        </div>
        <p>Return to the <a href="index.php">home</a>.</p>

    <?php else : 
    	header('Location: ./error.php?err=Not login');
    	endif;	
    ?>
    </body>
</html>