<?php
require_once '../includes/db_connect.php';
require_once '../includes/functions.php';
sec_session_start();

?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title id="title">Chat</title>
    <link rel="stylesheet" href="chat.css" type="text/css" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
    <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> -->
    <script type="text/javascript" src="chat.js"></script>
    <script type="text/javascript">
        <?php if (login_check($mysqli) == true) : ?>
        var name = <?php echo json_encode($_SESSION['username']); ?>;
        <?php endif; ?>

        // default name is 'Guest'
    	if (!name || name === ' ') {
    	   name = "Guest";	
    	}
    	
    	// strip tags
    	name = name.replace(/(<([^>]+)>)/ig,"");
    	
    	// display name on page
    	$("#name-area").html("You are: " + name );
        $("#title").html("Chat - " + name + "");
    	
    	// kick off chat
        var chat =  new Chat();
    	$(function() {
    	
    		 chat.getState(); 
    		 
    		 // watch textarea for key presses
             $("#sendie").keydown(function(event) {  
             
                 var key = event.which;  
           
                 //all keys including return.  
                 if (key >= 33) {
                   
                     var maxLength = $(this).attr("maxlength"); 
                     var length = this.value.length;
                     
                     // don't allow new content if length is maxed out
                     if (length >= maxLength) {  
                         event.preventDefault();  
                     }  
                  }  
              });

    		 // watch textarea for release of key press
    		 $('#sendie').keyup(function(e) {
    		 					 
    			  if (e.keyCode == 13) { 
    			  
                    var text = $(this).val();
    				var maxLength = $(this).attr("maxlength");  
                    var length = text.length; 
                     
                    // send 
                    if (length <= maxLength + 1) { 
                     
    			        chat.send(text, name);	
    			        $(this).val("");
    			        
                    } else {
                    
    					$(this).val(text.substring(0, maxLength));
    				}	

    			  }
             });
            
    	});

        function showOnlineList() {
          var xhttp;    
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
              document.getElementById("onlineList").innerHTML = xhttp.responseText;
            }
          };
          xhttp.open("GET", "getOnline.php", true);
          xhttp.send();
        }

        function clickChat(str) {
          var xhttp;    
          if (str == "") {
            document.getElementById("onlineList").innerHTML = "";
            return;
          }
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
              document.getElementById("onlineList").innerHTML = xhttp.responseText;
            }
          };
          xhttp.open("GET", "getOnline.asp?q="+str, true);
          xhttp.send();
        }
    </script>

</head>

<body onload="setInterval('chat.update()', 1000); ">
 <!-- setInterval('showOnlineList()', 1000);"> -->

    <div id="page-wrap">
    
        <h2>Chat Room</h2>
        
        <p id="name-area" style="height: 100px width=100px"></p>

        <script>
        $("#name-area").html("You are: " + name );
        </script>
        
        <div id="chat-wrap"><div id="chat-area"></div>
        <!-- <div id="onlineList"></div> -->
        </div>
        
        <div> 
        <form id="send-message-area">
            <p>Your message: </p>
            <textarea id="sendie" maxlength = '100' ></textarea>
        </form>
        </div>
    </div>
    <div>
            <div class="container">
            <ul class="pagination">
                <li><a href="../index.php">back home</a></li>
        <?php if (login_check($mysqli) == true) { //XXX login status change when refresh... ?>
                <li><a href="../includes/logout.php">logout</a></li>
        <?php }else{ ?>
                <li><a href="../login.php">log in</a></li>
                <li><a href="../register.php">sign up</a></li>
            </ul>
            </div>
        <?php } ?>
    </div>

</body>

</html>