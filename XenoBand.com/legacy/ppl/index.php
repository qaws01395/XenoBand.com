<html>

<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>

<script>
// load home page
$(function() {load("home.html")})

function load(page) {
	console.log("load " + page);

	$("#content").load(page);
}
</script>

<link rel="stylesheet" href="styles.css">

</head>

<body>

<heading>
<h1>XenoBand</h1>
<h2>Music Software</h2>
</heading>

<!-- navigation bar -->
<ul>
<li><a href="javascript:load('home.html')">
Home
</a></li>
<li><a href="javascript:load('download.html')">
Download
</a></li>
<li><a href="javascript:load('tutorial.html')">
Tutorial
</a></li>
<li><a href="javascript:load('chat.html')">
Chat Room
</a></li>
<li style="float: right"><a href="javascript:load('about.html')">
About Us
</a></li>
</ul>

<!-- page content -->
<div id="content"></div>

<?php
include "log.php";
log_append();
?>

</body>
</html>

