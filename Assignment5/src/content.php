<?php
   error_reporting(E_ALL);
   ini_set('display_errors', 'On');

session_start();

if($_SERVER['REQUEST_METHOD'] != 'POST'){
   $filepath = explode('/', $_SERVER['PHP_SELF'], -1);
   $filepath = implode('/', $filepath);
   $redirect = "http://" . $_SERVER['HTTP_HOST'] . $filepath;
   header("Location: {$redirect}/login.php");
}

if(session_status() == PHP_SESSION_ACTIVE){
  if(isset($_POST['username'])){
    $_SESSION['name'] = $_POST['username'];
  }
  if(!isset($_SESSION['visits'])){
    $_SESSION['visits'] = 0;
  }
    $_SESSION['visits']++;

  if(empty($_SESSION['name'])){
    echo "A username must be entered. Click <a href='login.php?action=logout'>here</a> to login screen.";
  } else {
  echo "Hello $_SESSION[name], You have visited this page " . ($_SESSION['visits'] - 1) . " times before. 
       Click <a href='login.php?action=logout'>here</a> to log out.";
   }
}
?> 
