<?php
require_once 'includes/db_connect.php';
require_once 'includes/functions.php';
sec_session_start();
 
if(!isset($_POST['band'])){  
	//choose band
	$prep_stmt = "SELECT band_name FROM manager WHERE manager = ? "; 
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        echo $_SESSION['username'];
        $stmt->bind_param('s', $_SESSION['username']);
        $stmt->execute();
        $stmt->store_result();
 
        // get variables from result.
        $stmt->bind_result($bandlist);
        echo '<form class="form-group" action="'.$_SERVER['PHP_SELF'].'" method="post" name="bandlist_form" style="width: 500px;">';
        while($stmt->fetch()){
          
            echo '<div class="radio" >';
            echo '<label><input type="radio" name="band" id="public" value="'.$bandlist.'">'.$bandlist.'</label>';
            echo '</div>';
        } 
        echo '<input type="submit" value="View">';
        echo '</form>';
        $stmt->close();
    } else {
        $error_msg .= '<p class="error">Database error in checkUser</p>';
        $stmt->close();
    }
}
else{
    $bandname = $_POST['band'];
    $file_handle = fopen( $_SERVER['DOCUMENT_ROOT'].'/bandinfo/'.$bandname.".txt", "r");
    echo '<div class="row" style="width: 500px;">';
    echo '<form action="deletemember.php" method="post" class="form-group">';
    while (!feof($file_handle)) {
        list($field1, $field2, $field3) = fscanf($file_handle, "%s\t%s\t%s\n");
        if(isset($field1)){
            echo '<div class="col-sm-12" >';
            echo   '<h3>'.$field2.'</h3>';
            echo    '<div>';
            echo        $field1.'       '.$field3;
            echo    '</div>';
            echo    '<div data-toggle="tooltip" title="If you delete yourself, the whole band will be deleted.">
                     <input type="hidden" name="delete_member" value="'.$field1.'" /></div>
                     <input type="hidden" name="delete_title" value="'.$field2.'" />
                     <input type="hidden" name="delete_instrument" value="'.$field3.'" />
                     <input type="hidden" name="band" value="'.$bandname.'" />
                     <input type="submit" value="delete" /> <br>';
            echo '</div>';
        }
    }
    echo '</form>';
    echo '</div>';
    fclose($file_handle);
}
?>
