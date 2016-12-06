<?php
function log_append() {
	$logpath = "log.txt";
	$log = fopen($logpath, "a");
	date_default_timezone_set('America/Chicago');
	$dstr = date('Y-m-d H:i:s');
	$addr = $_SERVER['REMOTE_ADDR'];

	$contents = json_decode(file_get_contents("http://ipinfo.io/{$addr}/json"));
	$city = $contents->city;
	$region = $contents->region;

	$s = "[".$addr."] visited on ".$dstr." in ".$city.", ".$region."\n";
	fwrite($log, $s);
	fclose($log);
}
?>
