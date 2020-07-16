<?php
  $root = dirname(__FILE__) . '/..';
  include "$root/_handlers/auth/reset_password.php";
  handler();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Reset Password</title>
</head>
<body>
<h1>Reset Password</h1>
  <form method="POST">
    <input type="email" placeholder="Email" name="email">
    <input type="submit">
  </form>
  <?php
    echo $vars['post_response'];
  ?>
  <a href="signup.php">Signup</a><br>
  <a href="login.php">Login</a><br>
</body>
</html>