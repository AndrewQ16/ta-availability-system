<?php
  $root = dirname(__FILE__) . '/..';
  include "$root/_handlers/auth/verify_email.php";
  handler();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Verify Email</title>
</head>
<body>
  <a href="signup.php">Signup</a><br>
  <a href="login.php">Login</a><br>
  <a href="reset_password.php">Forgot Password?</a><br>
  <?php  
    echo $vars['response'];
  ?> 
</body>
</html>