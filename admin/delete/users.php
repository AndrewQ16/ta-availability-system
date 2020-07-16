<?php
  $root = dirname(__FILE__) . '/../..';
  include "$root/_handlers/admin/delete/users.php";
  include "$root/_tools/ui/echo_table.php";
  handler();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Delete Users</title>
</head>
<body>
  <a href="../../profile.php">My Profile</a><br>
  <a href="../courses.php">Edit Courses</a><br>
  <a href="../course_staff.php">Edit Course Staff</a><br>
  <a href="../professors.php">Edit Professors</a><br>
  <a href="../teaching_assistants.php">Edit Teaching Assistants</a><br>
  <a href="courses.php">Delete Courses</a><br>
  <a href="course_staff.php">Delete Course Staff</a><br>
  <h1>Delete User</h1>
  <form method="POST">
    <label for="email">Email</label>
    <input type="text" name="email">
    <input type="submit">
  </form>
  <?php echo $vars['post_response']; ?>
  <h1>Courses</h1>
  <?php echo_table($vars['users']); ?>
</body>
</html>