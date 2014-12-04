<?php
include "info.php";

$db = new mysqli('oniddb.cws.oregonstate.edu', 'nguyminh-db', $myPassword, 'nguyminh-db');

if(isset($_POST['newname']) && isset($_POST['newpass']) && isset($_POST['newpass2'])){
  if(!empty($_POST['newname']) && !empty($_POST['newpass']) && !empty($_POST['newpass2'])){	
    $username = $_POST['newname'];
	$password = $_POST['newpass'];
	$password2 = $_POST['newpass2'];
	if(ctype_alnum($username)){
	 if((strlen($username) > 3) && (strlen($username) < 21)){
      if(ctype_alnum($password)){	 
      if($password == $password2){
         if((strlen($password) > 2)){
		   $insert = $db->prepare("INSERT INTO user (user_name, password) VALUES (?, ?)");
           $insert->bind_param('ss', $username, $password);
           if ($insert->execute()){
             $insert->bind_result($username, $password);
             $insert->close();
			 echo "<script type='text/javascript'>alert('Account Created! Please log in');</script>";
            } else {
			 $insert->bind_result($username, $password);
			 $insert->close();
			 $count = 1;
             while($count != 0){
               $query = "SELECT COUNT(*) FROM user WHERE user_name = '$username'";
               if($stmt = $db->prepare($query)){
                 $stmt->execute();
                 $stmt->close();
                 $stmt->bind_result($count);
                 $stmt->fetch();
               } else {
                     die("query error");
               }
               if($count != 0){
                 $message = "user name $username is taken";
                 echo "<script type='text/javascript'>alert('$message');</script>";
                 break;			   
			   }
			}
		  }
         } else {
		    echo "<script type='text/javascript'>alert('Password must be at least 3 characters long!');</script>";
		   }
      } else {
          echo "<script type='text/javascript'>alert('Passwords do not match, try again');</script>";
        }
     } else {
          echo "<script type='text/javascript'>alert('Password contains illegal characters!');</script>";
      }	 
	} else {
	echo "<script type='text/javascript'>alert('User name must be between 4 and 20 characters');</script>";
	}
   } else {
     echo "<script type='text/javascript'>alert('User name contains illegal characters!');</script>";
   }   
  } else {
     echo "<script type='text/javascript'>alert('all fields required!');</script>";
  }
}




?>