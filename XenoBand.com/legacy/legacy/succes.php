<?php
$success = filter_input(INPUT_GET, 'suc', $filter = FILTER_SANITIZE_STRING);
 
if (! $success) {
    $success = 'Oops! An unknown error happened.';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Success</title>
        <!-- <link rel="stylesheet" href="styles/main.css" /> -->
    </head>
    <body>
        <h1>Message: </h1>
        <p class="success"><?php echo $success; ?></p>  
    </body>
</html>