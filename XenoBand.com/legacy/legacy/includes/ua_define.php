<?php
$ua = $_SERVER["HTTP_USER_AGENT"]; 
 
 
/* ==== Detect the OS ==== */ 
 
// ---- Mobile ---- 
 
// Android 
$android = strpos($ua, 'Android') ? true : false; 
 
// BlackBerry 
$blackberry = strpos($ua, 'BlackBerry') ? true : false; 
 
// iPhone 
$iphone = strpos($ua, 'iPhone') ? true : false; 
 
// Palm 
$palm = strpos($ua, 'Palm') ? true : false; 
 
// ---- Desktop ---- 
 
// Linux 
$linux = strpos($ua, 'Linux') ? true : false; 
 
// Macintosh 
$mac = strpos($ua, 'Macintosh') ? true : false; 
 
// Windows 
$win = strpos($ua, 'Windows') ? true : false; 
 
/* ============================ */ 
 
 
/* ==== Detect the UA ==== */ 
 
// Chrome 
$chrome = strpos($ua, 'Chrome') ? true : false; // Google Chrome 
 
// Firefox 
$firefox = strpos($ua, 'Firefox') ? true : false; // All Firefox 
$firefox_2 = strpos($ua, 'Firefox/2.0') ? true : false; // Firefox 2 
$firefox_3 = strpos($ua, 'Firefox/3.0') ? true : false; // Firefox 3 
$firefox_3_6 = strpos($ua, 'Firefox/3.6') ? true : false; // Firefox 3.6 
 
// Internet Exlporer 
$msie = strpos($ua, 'MSIE') ? true : false; // All Internet Explorer 
$msie_7 = strpos($ua, 'MSIE 7.0') ? true : false; // Internet Explorer 7 
$msie_8 = strpos($ua, 'MSIE 8.0') ? true : false; // Internet Explorer 8 
 
// Opera 
$opera = preg_match("/bOperab/i", $ua); // All Opera 
 
 
// Safari 
$safari = strpos($ua, 'Safari') ? true : false; // All Safari 
$safari_2 = strpos($ua, 'Safari/419') ? true : false; // Safari 2 
$safari_3 = strpos($ua, 'Safari/525') ? true : false; // Safari 3 
$safari_3_1 = strpos($ua, 'Safari/528') ? true : false; // Safari 3.1 
$safari_4 = strpos($ua, 'Safari/531') ? true : false; // Safari 4 
 
/* ============================ */ 
 
 ?>
