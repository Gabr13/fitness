<?php
require_once '../config.php';
?>
<html>
<head>
  <title>Inicio - FitnesSocial</title>
</head>
<body>

 <div id="vid-box"></div>

<form name="loginForm" id="login" action="#" onsubmit="return login(this);">
    <input type="text" name="username" id="username" placeholder="Pick a username!" />
    <input type="submit" name="login_submit" value="Log In">
</form>

<form name="callForm" id="call" action="#" onsubmit="return makeCall(this);">
	<input type="text" name="number" placeholder="Enter user to dial!" />
	<input type="submit" value="Call"/>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.pubnub.com/pubnub-3.7.14.min.js"></script>
<script src="https://cdn.pubnub.com/webrtc/webrtc.js"></script>
<script>
var video_out = document.getElementById("vid-box");

function login(form) {
	var phone = window.phone = PHONE({
	    number        : form.username.value || "Anonymous", // listen on username line else Anonymous
	    publish_key   : 'your_pub_key',
	    subscribe_key : 'your_sub_key',
	});	
	phone.ready(function(){ form.username.style.background="#55ff5b"; });
	phone.receive(function(session){
	    session.connected(function(session) { video_out.appendChild(session.video); });
	    session.ended(function(session) { video_out.innerHTML=''; });
	});
	return false; 	// So the form does not submit.
}

function makeCall(form){
	if (!window.phone) alert("Login First!");
	else phone.dial(form.number.value);
	return false;
}
</script>
</body>
</html>