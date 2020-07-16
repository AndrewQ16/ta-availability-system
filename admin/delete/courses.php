<?php
  $root = dirname(__FILE__) . '/../..';
  include "$root/_handlers/admin/delete/courses.php";
  include "$root/_tools/ui/echo_table.php";
  handler();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Delete Courses</title>
</head>
<body>
  <a href="../../profile.php">My Profile</a><br>
  <a href="../courses.php">Edit Courses</a><br>
  <a href="../course_staff.php">Edit Course Staff</a><br>
  <a href="../professors.php">Edit Professors</a><br>
  <a href="../teaching_assistants.php">Edit Teaching Assistants</a><br>
  <a href="course_staff.php">Delete Course Staff</a><br>
  <a href="users.php">Delete Users</a><br>
  <h1>Delete Course</h1>
  <form method="POST">
    <label for="course_id">Course ID</label>
    <input type="number" name="course_id">
    <input type="submit">
  </form>
  <?php echo $vars['post_response']; ?>
  <h1>Courses</h1>
  <?php echo_table($vars['courses']); ?>
</body>
</html>