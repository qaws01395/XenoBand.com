<?php
$to = "yuxiangz@iastate.edu";
$subject = "[XenoBand] Comment";

$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];

$header = "From:".$name."(".$email.")";

$retval = mail($to, $subject, $message, $header);

if ($retval) {
    echo "Message sent successfully...";
} else {
    echo "Message could not be sent...";
}

?>
