<?php
header('Content-Type: text/plain');

$myArr = array();
$type = array(
       'Type' => ''
       );
$params = array();

if($_SERVER['REQUEST_METHOD'] === 'GET'){
   $myArr['Type'] = 'GET';
  }
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
   $myArr['Type'] = 'POST';
  }

if ($myArr['Type'] === 'GET'){
    foreach($_GET as $key => $value){
       $params[$key] = $value;
    } 
else if {
   foreach($_POST as $key => $value){
       $params[$key] = $value;
   }
else if (empty($_GET){
        if(empty($_POST){
           $params[] = null;
        }
}
$myArr['parameters'] = $params;
echo JSON_encode($myArr);
?>
