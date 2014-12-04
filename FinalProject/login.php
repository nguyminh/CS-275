<?php
/*
log.php
Login and sign up page. 
*/


include "signup.php";
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Chatter login</title>
    <script src="jscript.js"></script>
    <link rel="stylesheet" href="styling.css">
  </head>
  <body>
    <h1 align="center">Chatter log-in Page</h1>
    <br/>
    <fieldset><legend>Log in</legend>
      <label for="username">Username:</label><input type="text"  name="username" id="username"/><br/>
      <label for="password">Password: </label><input type="password"  name="password" id="password"/><br/>
      <input type="submit" name="login" value="Log in" onclick="login()">
    </fieldset>
    <div id="status" align="center"></div>
    <br/><br/><br/><br/><br/>
    <div id="reg" align="center">
      Don't have an account? Register for an account below!
    </div>
    <div id="signin">
    <form action="" method="POST">
      <fieldset><legend>Sign up</legend>
        <label for="newname">User Name: </label>
        <input type="text" name="newname" id="newname">(Must be 4 to 20 characters)<br/><br/>
		<label for="newpass">Password: </label>
		<input type="password" name="newpass" id="newpass">(Must be at least 3 characters)<br/><br/>
		<label for ="newpass2">Verify password: </label>
		<input type="password" name="newpass2" id="newpass2"><br/>
		<input type="submit" name="submit" value="Register">
	  </fieldset>
	</form>
	</div>

	<div id="develop" align="center">
	  Developed by Minh Nguyen
	</div>


  </body>
</html>