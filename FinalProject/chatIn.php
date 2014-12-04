<?php
session_start();
include "info.php";
$db = new mysqli('oniddb.cws.oregonstate.edu', 'nguyminh-db', $myPassword, 'nguyminh-db');


$usname = $_SESSION['name'];

if(isset($_POST['chat'])){
  $chat = ($_POST['chat']);
   if(empty($chat)){
     echo "Cannot send empty text!";
     exit();
   } else {
       $insert = $db->prepare("INSERT INTO chat (chat, user_name) VALUES (?, ?)");
       $insert->bind_param('ss', $chat, $usname);
	   $insert->execute();
	   $insert->close();
	   exit();
	}
}




?>