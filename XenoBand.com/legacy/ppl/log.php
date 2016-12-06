<?php
function log_append() {
$logpath = "log.txt";
$log = fopen($logpath, "a");
date_default_timezone_set('America/Chicago');
$dstr = date('Y-m-d h:i:s A');
$addr = $_SERVER['REMOTE_ADDR'];
$s = "[".$addr."] visited on ".$dstr."\n";
fwrite($log, $s);
fclose($log);
}
?>
