<?php

function read($filename) {
	$contents = file_get_contents($filename);
	return json_decode($contents);
}

function write($filename, $input) {
	if (count($input)<=0) {
		return;
	}
	$contents = json_encode($input);
	file_put_contents($filename, $contents);
}

?>

