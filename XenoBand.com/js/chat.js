var interval;

$(function() {

	function send() {
		var name = $("#name").val();
		if (name.length==0) {
			alert("Name must be entered.");
			return;
		}

		var message = $("#message").val();
		if (message.length==0)
			return;

		pullchat(name, message);	

		$("#message").val("");

		set_pull_interval();
	}

	var prevdata;
	function pullchat(name, message) {
		$.post("chat.php",
				{
					"name": name,
					"message": message
				},
				function(data) {
					if (prevdata!=data) {
						$("#chatbox").html(data);
						// scroll to bottom
						var element = document.getElementById("chatbox");
						element.scrollTop = element.scrollHeight;
						prevdata = data;
					}
				});
	}

	function set_pull_interval() {
		// clear old interval
		clearInterval(localStorage.getItem("interval"));
		// set a new interval
		interval = setInterval(function() {
			pullchat("", "");
		}, 1000);
		localStorage.setItem("interval", interval);
	}

	$("#clear").click(function() {
		// brute force clear
		for (var i = 1; i <= 99999; i++)
			clearInterval(i);

		$("#chatbox").html("<b style='color:red'>Disconnected</b>");
	});

	$("#history").click(function() {
		window.open("/chat_history.php");
	});

	$("#send").click(send);

	$("#message").on("keypress", function(e) {
		if (e.which==13) {
			send();
		}
	});

	pullchat("", "");
	set_pull_interval();

}); // end of ready

