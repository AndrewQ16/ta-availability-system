<?php
  include "_handlers/profile.php";
  include "_tools/ui/echo_user_avatar.php";
  handler();
?>
<html>
<head>
	<title>Profile</title>
</head>
<body>
  <?php if ($vars['is_admin']) echo '<a href="admin/courses.php">Admin Panel</a><br>'; ?>
  <?php if ($vars['is_self']) echo '<a href="edit_profile.php">Edit Profile</a><br>'; ?>
  <a href="active_staff.php">Active Staff</a><br>
  <a href="courses.php">Courses</a><br>
  <h1>Profile</h1>
  <?php
    $user = $vars['user'];
    if ($user) {
      echo_user_avatar('.', $user['uid']);
      echo "<p>{$user['name']}</p>";
      echo "<p>{$user['email']}</p>";
    } else {
      echo "<p>No user found</p>";
    } ?>
</body>
</html>