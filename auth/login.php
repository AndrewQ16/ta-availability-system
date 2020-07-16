<?php
  $root = dirname(__FILE__) . '/..';
  include "$root/_handlers/auth/login.php";
  handler();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <h1>Login</h1>
  <form method="POST">
    <input type="text" placeholder="Email" name="email">
    <input type="password" placeholder="Password" name="password">
    <input type="submit">
  </form>
  <?php
    echo $vars['post_response'];
  ?>
  <a href="signup.php">Signup</a><br>
  <a href="reset_password.php">Forgot Password?</a><br>
</body>
</html>