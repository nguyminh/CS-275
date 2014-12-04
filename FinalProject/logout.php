<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
<title>Logout Success!</title>
<link rel="stylesheet" href="styling.css">
</head>
<body>
<div id="status" align="center"><?php echo "You've logged out successfuly <br/>"; 
                       echo  "<a href='login.php'>Click here</a> to log back in";?>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div id="develop" align="center"><?php echo "This site created by Minh Nguyen";?>
</div>