<?php
require_once 'includes/util.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>You can test anything</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        <!-- <link rel="stylesheet" href="styles/main.css" /> -->
    </head>
    <body>
    You can test anything here.
<?php
echo NL."pswd of user: ".'<script type="text/javascript">'."hex_sha512('user');".'</script>'.NL;
echo "email: 123@aos.com".NL;
echo "pswd of cdc: ".hex_sha512(cdc).NL;
echo "email: 123@abc.com".NL;
?>
    </body>