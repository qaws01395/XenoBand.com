<?php
require_once 'includes/db_connect.php';
require_once 'includes/functions.php';
sec_session_start();
?>

<html>
    <head>
		<title>message board</title>

	</head>
	
	<body>
		<center>
<?php
				if( !empty($_POST['reply'])&&isset($_POST['submit_reply']) ){
					$name = $_POST['name'];
					$reply = $_POST['reply'];
					echo 'reply : '.$reply.'<br/>';
					$dateTime = date("Y-m-d H:i:s", strtotime("-5 hours"));// Iowa time XXX 

					if ($insert_stmt = $mysqli->prepare("INSERT INTO msgboard (	username, content, time) VALUES (?, ?, ?)")) {
			            $online = 0;
			            $insert_stmt->bind_param('sss', $name, $reply, $dateTime);
			            // Execute the prepared query.
			            if (! $insert_stmt->execute()) {
			                echo "There's an error <br>";
			            }
			        }
				}

				// print current message
				$prep_stmt = "SELECT username, content, time FROM msgboard "; 
				$stmt = $mysqli->prepare($prep_stmt);

			    if ($stmt) {
			        $stmt->execute();
			        $stmt->store_result();
			 
			        // get variables from result.
			        $stmt->bind_result($msg_name, $msg, $msg_time);
			        echo "<div style=\"width: 500px;\">";
			        while($stmt->fetch()){
						echo $msg_name.": ".'<br />';
						echo $msg.'<br />';
						echo $msg_time.'<hr />';
			        } 
			        echo "</div>";
			        $stmt->close();
			    }
				
				echo '<br />'.date(DATE_RFC822) . '<br />';
?>
			<!--
			<button onclick="todelete()">§R°£­è­èªº¯d¨¥</button>
			-->
		<a href="index.php">Home</a>
		</center>

		<?php/*
				if( del=true){
				$dbc = mysqli_connect('localhost', 'root', '', 'test') or die('Error connecting to MYSQL server.');
				$query = "DELETE FROM message_board WHERE message = $reply;"
				$result = mysqli_query($dbc, $query);
				del=false;
				
				
				mysqli_close($dbc);
				
				echo 'delete message.'
				
				}*/
		?>
	</body>
</html>