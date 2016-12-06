<?php
function gettime() {
	date_default_timezone_set("America/Chicago");
	return date("m-d h:i A");
}

// echo gettime()."\n";

?>
