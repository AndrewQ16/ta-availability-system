<?php
  $root = dirname(__FILE__) . '/..';
  include "$root/_handlers/admin/professors.php";
  include "$root/_tools/ui/echo_table.php";
  handler();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Professors</title>
</head>
<body>
  <a href="../profile.php">My Profile</a><br>
  <a href="courses.php">Edit Courses</a><br>
  <a href="course_staff.php">Edit Course Staff</a><br>
  <a href="teaching_assistants.php">Edit Teaching Assistants</a><br>
  <a href="delete/courses.php">Delete Courses</a><br>
  <a href="delete/course_staff.php">Delete Course Staff</a><br>
  <a href="delete/users.php">Delete Users</a><br>
  <h1>Add Professor</h1>
  <form method="POST">
    <input type="text" placeholder="Email" name="email">
    <input type="text" placeholder="Name" name="name">
    <input type="submit">
  </form>
  <?php echo $vars['post_response']; ?>
  <h1>Professors</h1>
  <?php echo_table($vars['professors']); ?>
</body>
</html>