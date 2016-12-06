<?php
    require_once 'includes/db_connect.php';
    require_once 'includes/functions.php';
	
	require_once 'ppl/log.php';
	log_append();
	   
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
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script>
    $(document).ready(
      indexPager("intro")
    );

    function highlight(clicked_id){
      $('li').removeClass('active').addClass('null');
      $('#'+clicked_id).removeClass('null').addClass('active');

      // Scroll
      var div = $('#'+clicked_id).offset();
      $('html, body').animate({
          scrollTop: div.left,
          scrollLeft: div.top
      }, 1000);
    }

    function indexPager(page) {
          var xhttp;    
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
              document.getElementById("switch-page").innerHTML = xhttp.responseText;
            }
          };
          xhttp.open("GET", page+".html", true);
          xhttp.send();
        }

    function indexPager2php(page) {
          var xhttp;    
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
              document.getElementById("switch-page").innerHTML = xhttp.responseText;
            }
          };
          xhttp.open("GET", page+".php", true);
          xhttp.send();
        }

  </script>
  <title>XenoBand</title>
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
    <div>
      <a href="createband.php" class="btn btn-default">Make a Band!</a>
    </div>
    <h1>XenoBand</h1>
    <p>Amazing music processing X social entertaining software you are looking for.</p> 
  </div>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">XenoBand</a>
      </div>
      <ul class="nav navbar-nav">
        <li onclick="highlight(this.id); indexPager('intro');" id="home" class="active" ><a href="#">Home</a></li>
        <li onclick="highlight(this.id); indexPager(this.id);" id="intro" ><a href="#">Introduction</a></li>
        <li onclick="highlight(this.id); indexPager(this.id);" id="tutorial" ><a href="#">Tutorial</a></li>
        <li onclick="highlight(this.id); indexPager(this.id);" id="announcement" ><a href="#">Announcement</a></li>
        <li onclick="highlight(this.id); indexPager(this.id);" id="team" ><a href="#">Our Team</a></li>
        <li onclick="highlight(this.id); indexPager(this.id);" id="download" ><a href="#">Download</a></li>
        <li onclick="highlight(this.id); indexPager(this.id);" id="chatroom" ><a href="#">Chat Room</a></li>
        <li onclick="highlight(this.id); indexPager(this.id);" id="sound_lib" ><a href="#">Sound Library</a></li>
      <?php if(login_check($mysqli) == true) : ?>
        <li onclick="highlight(this.id); indexPager(this.id);" id="upload" ><a href="#">Upload</a></li>
        <li onclick="highlight(this.id)" id="band"><a href="bandinfo.php">Band</a></li>
      <?php endif; ?>
        <li onclick="highlight(this.id); indexPager2php(this.id);" id="reply"><a href="#">Message Board</a></li>
      </ul>
    </div>
  </nav>

  <div class="row">
  <div class="col-sm-12" id="switch-page"></div>
  <div class="col-sm-12" id="msg"></div>
  </div>

</div>


</p>
</body>

</html>
