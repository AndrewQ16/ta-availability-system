<?php
  $root = dirname(__FILE__) . '/..';
  include "$root/_handlers/auth/change_password.php";
  handler();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Change Password</title>
</head>
<body>
<a href="../profile.php">My Profile</a><br>
<h1>Change Password</h1>
  <form method="POST">
    <input type="password" placeholder="Old Password" name="old_password">
    <input type="password" placeholder="New Password" name="new_password1">
    <input type="password" placeholder="Confirm New Password" name="new_password2">
    <input type="submit">
  </form>
  <?php
    echo $vars['post_response'];
  ?>
</body>
</html>