<?php
  $root = dirname(__FILE__) . '/..';
  include "$root/_handlers/auth/signup.php";
  handler();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Signup</title>
</head>
<body>
  <a href="login.php">Login</a><br>
  <a href="reset_password.php">Forgot Password?</a><br>
  <h1>Signup</h1>
  <form method="POST">
    <input type="text" placeholder="Email" name="email">
    <input type="submit">
  </form>
  <?php  
    echo $vars['post_response'];
  ?>
</body>
</html>