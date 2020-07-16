<?php
  include "_handlers/courses.php";
  include "_tools/ui/echo_table.php";
  handler();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Courses</title>
</head>
<body>
  <?php if ($vars['is_admin']) echo '<a href="admin/courses.php">Admin Panel</a><br>'; ?>
  <?php if ($vars['current_user']) echo '<a href="profile.php">My Profile</a><br>'; ?>
  <a href="active_staff.php">Active Staff</a><br>
  <?php
    // List courses, if course_id not in url
    if ($vars['courses']) {
      echo '<h1>Courses</h1>';
      echo_table($vars['courses']);
    }
    // Show course info, if course_id exists
    if ($vars['course']) {
      echo '<h1>Course Info</h1>';
      echo_table(array($vars['course']));
      echo '<h1>Professors</h1>';
      echo_table($vars['professors']);
      echo '<h1>Teaching Assistants</h1>';
      echo_table($vars['tas']);
    }
    // Show error message, if course_id DNE
    if ($vars['does_not_exist']) {
      echo '<p>Error: Course does not exist</p>';
    }
  ?>
</body>
</html>