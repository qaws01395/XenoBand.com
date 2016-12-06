<?php
echo "Starting Server\n";
$socket = @socket_create_listen("33363");
while (true) {
	echo "Waiting for connection...\n";
	$client = socket_accept($socket);
	echo "Client connected.\n";
	
	if ($client==null)
		continue;
	
	sleep(1);
	
	$msg = "Welcome to PPL\n";	
	socket_write($client, $msg, strlen($msg));

	$msg = "[server] Hello\n".chr(0);
	$length = strlen($msg);
	socket_write($client, $msg, $length);
	
	usleep(5);

	$sec = 1;
	while (true) {
		$msg = "running ".$sec." sec\n"; $sec++;
		
		$input = socket_read($client, 1024);
		echo "input: ".$input."\n";
		$msg = $msg."[You] ".$input;
		
		$test = socket_write($client, $msg, strlen($msg));
		sleep(1);
		if ($test === false) {
			echo "socket probably closed\n";
			exit;
		}
	}
}
?>

