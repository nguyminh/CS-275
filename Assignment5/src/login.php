<?php
header("Content-Type: text/html");

session_start();
if(isset($_GET['action']) && $_GET['action'] == 'logout'){
   $_SESSION = array();
   session_destroy();
}
echo "<!DOCTYPE html>
     <html>
       <head>
          <meta charset='utf=8'/>
          <title>Login</title>
       </head>
      <body>
      <form action='content.php' method='post'>
      Enter User name: <input type='text' name='username'>
      <input type='submit' value='login' />
      </form>
      </body>
      </html>";

?>
