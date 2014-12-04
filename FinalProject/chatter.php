<?php
/*
chatter.php
Main site page. Holds the html and php. ajax calls to chat goes here
*/


session_start();

if(isset($_SESSION['name'])){

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Chatter</title>
    <script src="jscript.js" type="text/javascript"></script>
    <link rel="stylesheet" href="styling.css">
  </head>
  <body>
    <h1 align="center">Welcome to Chatter!</h1>
    <div class="logged"><?php echo "You are logged in as <strong>" .$_SESSION['name']. "</strong>.<br/>";
      echo " <a href='logout.php'>Log out</a>";?>
    </div>
    <div id="viewCount"></div>
    <br/><br/>
    <h2 align="center">Chat away below!</h2>
    <div id="view"></div>
    <br/>
    <fieldset>
	  <label for="chat">Say something: </label><input type="text" size="50" id="chat" onkeydown="if (event.keyCode == 13) document.getElementById('button').click()">
	  <input type="button" id="button" onclick="sendchat(); erase();" value="send" />
	</fieldset>
	<div id="stat"></div>
	<div id="develop" align="center">
	  Developed by Minh Nguyen
	</div>
<script type="text/javascript">showChat(); counter();</script>
  </body>
</html>

<?php
} else {
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Failure!</title>
<link rel="stylesheet" href="styling.css">
</head>
<body>
<div id="status"><?php echo "You must be logged in to use chatter. Please login <a href='login.php'>here</a>";?>
</div>
</body>
<?php } ?>