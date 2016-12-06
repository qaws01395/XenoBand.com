<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="js/home.js"></script>
<script>
// load home page
$(function() {
    load("home.html");
});

function load(page) {
    console.log("load " + page);

    $("#content").load(page);
}
</script>
  <title>XenoBand</title>
 </head>
 <body>
  <div class="container">
   <nav class="navbar navbar-default">
    <div class="container-fluid">
     <div class="navbar-header">
      <a class="navbar-brand" href="index.php">
       XenoBand
      </a>
     </div>
     <ul class="nav navbar-nav">
      <li onclick="highlight(this.id); load('download.html');" id="download" >
       <a href="#">
        <span class="glyphicon glyphicon-download"></span>
        Download
       </a></li>
       <li onclick="highlight(this.id); load('tutorial.html')" id="tutorial">
        <a href="#">
         <span class="glyphicon glyphicon-education"></span>
         Tutorial
        </a>
       </li>
       <li onclick="highlight(this.id); 
        load('comment.html');" id="chat">
        <a href="#">
         <span class="glyphicon glyphicon-comment"></span>
         Comment
        </a>
       </li>
       <li onclick="highlight(this.id); 
        load('contact.html');" id="contact" >
        <a href="#">
         <span class="glyphicon glyphicon-envelope"></span>
Contact Us
        </a>
       </li>
     </ul>
     <ul class="nav navbar-nav navbar-right">
      <li>
<a href="#">
<span class="glyphicon glyphicon-user"></span> Sign Up
</a>
</li>
      <li>
<a href="#">
<span class="glyphicon glyphicon-log-in"></span> Login
</a>
</li>
     </ul>    
    </div>
   </nav>
   <div class="row">
    <div class="col-sm-12" id="content"></div>
    <div class="col-sm-12" id="msg"></div>
   </div>
  </div>
  </p>
 </body>
</html>

<?php

require_once 'log.php';
log_append();

?>
