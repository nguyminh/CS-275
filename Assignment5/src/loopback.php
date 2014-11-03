<?php
header('Content-Type: text/plain');

$params = array();
$type = $_SERVER['REQUEST_METHOD'];

if(empty($_GET) && empty($_POST)){
    $params[] = null;
   } else {
    foreach ($_POST as $key => $value){
    $params[$key] = $value;
    }
    foreach($_POST as $key => $value){
    $params[$key] = $value;
  } 
}  
$myArr = array('Type' => $type, 'parameters' => $params);
echo JSON_encode($myArr);
?>
