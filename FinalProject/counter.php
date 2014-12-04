<?php
/*
counter.php
Echo's out number of user account for record keeping
*/

include "info.php";
$db = new mysqli('oniddb.cws.oregonstate.edu', 'nguyminh-db', $myPassword, 'nguyminh-db');

$results = $db->query("SELECT COUNT(*) FROM user");

$row = $results->fetch_row();
echo $row[0] . " user accounts created on Chatter";

?>