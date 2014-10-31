<?php
header('Content-Type: text/html');
echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Multtable</title>
</head>
<body>';
session_start();
 if(isset($_GET['action']) && $_GET['action'] == 'end'){
    $_SESSION = array();
    session_destroy();
    $filPath = explode('/', $_SERVER['PHP_SELF'], -1);
    $filePath = implode('/', $filePath);
    $redirect = "http:://" . $_SERVER['HTTP_HOST'] . $filePath;
    header("Location: {$redirect}/Logout.html", true);
    die();
}

  if(session_status() == PHP_SESSION_ACTIVE){
    if(isset($_GET['min-multiplicand'])){
      $_SESSION['min-multiplicand'] = $_GET['min-multiplicand'];
  } else {
   echo "<p>Missing parameter min-multiplicand. \n";
  }
     if(isset($_GET['max-multiplicand'])){
      $_SESSION['max-multiplicand'] = $_GET['max-multiplicand'];
  } else {
   echo "<p>Missing parameter max-multiplicand. \n";
  }
    if(isset($_GET['min-multiplier'])){
      $_SESSION['min-multiplier'] = $_GET['min-multiplier'];
  } else {
   echo "<p>Missing parameter min-multiplier. \n";
  }
    if(isset($_GET['max-multiplier'])){
      $_SESSION['max-multiplier'] = $_GET['max-multiplier'];
  } else {
   echo "<p>Missing parameter max-multiplier. \n";
  }
 }

foreach($_SESSION as $test => $case){
   $temp = $_SESSION[$test];
   if ($temp[0] == '-') {
     if(!(ctype_digit(substr($temp, 1)))){
       echo "<p>The $test is not an integer. \n";
     }
   } else {
     if(!(ctype_digit($temp))){
       echo "<p>The $test is not an integer. \n";
     }
   }
}


function int_validate(){
  foreach($_SESSION as $test => $case){
   $temp = $_SESSION[$test];
   if ($temp[0] == '-') {
     if(!(ctype_digit(substr($temp, 1)))){
       return false;
     }
   } else {
     if(!(ctype_digit($temp))){
       return false;
     }
   }
  }
 return true;
} 


  if($_SESSION['min-multiplicand'] > $_SESSION['max-multiplicand']){
    echo "<p>The min-multiplicand is larger than the max-multiplicand.\n";
    
  }
  if($_SESSION['min-multiplier'] > $_SESSION['max-multiplier']){
    echo "<p>The min-multiplier is larger than the max-multiplier.\n";
   
  }
 
function check_greater(){
  if ($_SESSION['min-multiplicand'] > $_SESSION['max-multiplicand'] ||  $_SESSION['min-multiplier'] > $_SESSION['max-multiplier']){
  return false;
  } else {
return true;
  }
} 


if(check_greater() == true && int_validate() == true){
echo "<p>All conditions met";   
echo "<br>min-multilplicand = ". $_SESSION['min-multiplicand'];
echo "<br>max-multilplicand = ". $_SESSION['max-multiplicand'];
echo "<br>min-multilplier = ". $_SESSION['min-multiplier'];
echo "<br>max-multilplier = ". $_SESSION['max-multiplier'];


$height = ($_SESSION['max-multiplicand'] - $_SESSION['min-multiplicand']) + 2;
$width = ($_SESSION['max-multiplier'] - $_SESSION['min-multiplier']) + 2;

echo "<br>height = $height";
echo "<br>width = $width";

echo '<table border="1">
      <tr><td>&nbsp;</td>';
   for($i = $_SESSION['min-multiplier']; $i <= $_SESSION['max-multiplier']; $i++){
   echo "<td> $i </td>";
   }

   echo "</tr>";

   for($i = $_SESSION['min-multiplicand']; $i <= $_SESSION['max-multiplicand']; $i++){
     echo "<tr><td>$i</td>";
      for($j = $_SESSION['min-multiplier']; $j <= $_SESSION['max-multiplier']; $j++){
        $number = $i * $j;
        echo "<td> $number </td>";
      }
     echo "</tr>";
   }
echo "</table>";
}
?>
