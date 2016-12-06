<?php
require_once 'includes/db_connect.php';
require_once 'includes/functions.php';
sec_session_start();
?>

<html>
<body>
<h3>Leave us a comment!</h3>

	<form action="msgboard.php" method="post">
		<p>Your name: </p><input type="text" name="name">
		<br><p>Leave a message: </p><input type="text" name="reply">

		<input type="submit" name="submit_reply"> 
	</form>



</body>
</html>