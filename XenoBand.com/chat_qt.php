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

if ($message!="")
	array_push($messages, new message($name, $time, $message));

write("chat.txt", $messages);

$count = count($messages);

$max = 50;

for ($i=$count-$max; $i<$count; $i++) {
	// cast $o to $m
	$o = $messages[$i];
	$m = new message($o->name, $o->time, $o->message);
	
	if ($o->message=="")
		continue;

	echo $m->getraw()."\n";
}

?>
