<?php

// XXX unused
// session_start();

include "io.php";
include "message.php";
include "time.php";

$time = gettime();
$name = $_POST["name"];
$message = $_POST["message"];

$messages = read("chat.txt");
if ($messages==null)
	$messages=[];

$count = count($messages);

for ($i=0; $i<$count; $i++) {
	// cast $o to $m
	$o = $messages[$i];
	$m = new message($o->name, $o->time, $o->message);
	
	if ($o->message=="")
		continue;

	echo $m->gethtml()."<br>";
}

?>
