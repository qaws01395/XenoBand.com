<?php

use_append();

function use_append() {
	$usepath = "use.txt";
	$use = fopen($usepath, "a");
	date_default_timezone_set('America/Chicago');
	$dstr = date('Y-m-d H:i:s');
	$addr = $_SERVER['REMOTE_ADDR'];

	$contents = json_decode(file_get_contents("http://ipinfo.io/{$addr}/json"));
	$city = $contents->city;
	$region = $contents->region;

	$key = $_POST["key"]; // currently unused
	$value = $_POST["value"];
	
	$s = "[".$addr."] ".$value." on ".$dstr." in ".$city.", ".$region."\n";
	fwrite($use, $s);
	fclose($use);
}
?>
