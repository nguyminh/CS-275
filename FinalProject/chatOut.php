<?php
/*
chatOut.php
Echo out username and chat message for ajax call to post 
*/

include "info.php";
$db = new mysqli('oniddb.cws.oregonstate.edu', 'nguyminh-db', $myPassword, 'nguyminh-db');

$out = "";
$results = $db->query("(SELECT * FROM chat ORDER BY chat_id DESC LIMIT 20) ORDER BY chat_id ASC");

while($row = $results->fetch_array()){
  $chat = $row['chat'];
  $username = $row['user_name'];
  $stamp = $row['stamp'];
  
  $out="<p><span id='uname'>" . $username . ":</span> " . $chat . '</p>';
  echo "$out";

}
?>