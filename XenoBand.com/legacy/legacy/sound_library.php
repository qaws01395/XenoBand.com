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
  <title>XenoBand - Sound Library</title>
</head>

<body>
<div class="container">
  <div class="jumbotron">
    <div id="auth_div" class="btn-group" role="group" aria-label="..." style="float:right"> 
  <?php
       if (login_check($mysqli) == false) {
        echo "<a href=\"login.php\" class=\"btn btn-default\">Log in</a>
              <a href=\"register.php\" class=\"btn btn-default\">Register</a>";
       } else {
        echo "<a href=\"includes/logout.php\" class=\"btn btn-default\">Log out</a>
              <a class=\"btn btn-default\">".$_SESSION['username']."</a>";
       }
  ?>
    </div>
    <h1>Sound Library</h1>
<?php if (login_check($mysqli) == true) : ?>
    <p>Welcome! <?php echo $_SESSION['username'] ?> ,here are the sound library you have uploaded.</p> 
  </div>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#"><?php echo $_SESSION['username'] ?></a>
      </div>
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li data-toggle="collapse" data-target="#wavlib"><a href="#">Sound Library</a></li>
        <li data-toggle="collapse" data-target="#chatroom"><a href="#">ChatRoom</a></li>
        <li data-toggle="collapse" data-target="#upload"><a href="#">Upload</a></li>
      </ul>
    </div>
  </nav>

  <div class="row">
    <div class="col-sm-12">
      <h3 data-toggle="collapse" data-target="#chatroom">ChatRoom</h3>
      <div id="chatroom" class="collapse">
        <p>Try online chatting and produce music with your friends!</p>
        <p><a href="chat/index.php">Chat Room!</a></p>
      </div>
    </div>
    <div class="col-sm-12">
      <h3 data-toggle="collapse" data-target="#upload">Upload</h3>        
      <div id="upload" class="collapse">
        <p>Create your own instruments!</p>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            Select sound file to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload file" name="submit">
        </form>
      </div>
    </div>
    <div class="col-sm-12">
      <h3 data-toggle="collapse" data-target="#wavlib">Sound Library</h3>        
      <div id="wavlib" class="collapse">
        <p>Your Library: </p>
        <!-- list wav files and user can download them -->
        <?php
        if ($stmt = $mysqli->prepare("SELECT id, username, file FROM sound_files WHERE username = ?")) {
          $stmt->bind_param('s', $_SESSION['username']);  
          $stmt->execute();    // Execute the prepared query.
          $stmt->store_result();

          // get variables from result.
          $stmt->bind_result($stored_id, $stored_username, $stored_file);
          ?>
          <?php
          while($stmt->fetch()){
              echo $stored_username . " file: <a href=\"slib/". $stored_file. "\">".$stored_file."</a> ";
              ?>
              <form action="deletefile.php" method="post" class="form-group">
                <input type="hidden" name="deletefile" value="<?php echo $stored_file ?>" />
                <input type="submit" value="delete" /> <br>
              </form>
              <?php
          } 
        } else {
          echo "You haven't uploaded sound file.<br>";
        }
        ?>
      </div>
    </div>
  </div>
<?php else:  
  if ($stmt = $mysqli->prepare("SELECT file FROM sound_files ")) {
    $stmt->execute();    // Execute the prepared query.
    $stmt->store_result();

    // get variables from result.
    $stmt->bind_result($stored_file);
    ?>
    <?php
    while($stmt->fetch()){
        echo " file: <a href=\"slib/". $stored_file. "\">".$stored_file."</a> ";
    } 
  }else{
    echo 'Ooops something wrong';
  }
  endif; ?>  
</div>


</p>
</body>

</html>
