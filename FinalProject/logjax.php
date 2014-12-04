<?php
/*
logjax.php
Echo's out correct/incorrect account name via ajax for login page
*/

include "info.php";
$db = new mysqli('oniddb.cws.oregonstate.edu', 'nguyminh-db', $myPassword, 'nguyminh-db');
session_start();

if((isset($_POST['username'])) && isset($_POST['password'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  if(!empty($username)){
    if(!empty($password)){
  $names = $db->query("SELECT * FROM user WHERE user_name = '$username'");
  $result = $db->query("SELECT * FROM user WHERE password = '$password' AND user_name = '$username'");
  if($names->num_rows > 0){
    if($result->num_rows){
	       $_SESSION['name'] = $username;
           echo "WELCOME $username!<br/>";
		   echo "click <a href='chatter.php'>here</a> to proceed to chatter!";
	} else {
       echo "Incorrect password!<br/>";
	   echo "Please check your password carefully";
    }	   
  } else {
      echo "User name '$username' does not exist<br/>";
	  echo "Please check your user name again";
   }
  } else {
    echo "Please enter in a password!";
   }
  } else {
    echo "Please enter in a user name!";
  }  
}
?>