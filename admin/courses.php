<?php
  $root = dirname(__FILE__) . '/..';
  include "$root/_handlers/admin/courses.php";
  include "$root/_tools/ui/echo_table.php";
  handler();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Courses</title>
</head>
<body>
  <a href="../profile.php">My Profile</a><br>
  <a href="course_staff.php">Edit Course Staff</a><br>
  <a href="professors.php">Edit Professors</a><br>
  <a href="teaching_assistants.php">Edit Teaching Assistants</a><br>
  <a href="delete/courses.php">Delete Courses</a><br>
  <a href="delete/course_staff.php">Delete Course Staff</a><br>
  <a href="delete/users.php">Delete Users</a><br>
  <h1>Add Course</h1>
  <form method="POST">
    <label for="prefix">Prefix</label>
    <input type="text" value="CSE" name="prefix">
    <label for="number">Course Number</label>
    <input type="number" name="number">
    <label for="semester">Semester</label>
    <select id="semester" name="semester">
      <option value="1">Spring</option>
      <option value="2">Summer</option>
      <option value="3">Fall</option>
      <option value="4">Winter</option>
    </select>
    <label for="year">year</label>
    <input type="number" placeholder='YYYY' name="year">
    <input type="submit">
  </form>
  <?php echo $vars['post_response']; ?>
  <h1>Courses</h1>
  <?php echo_table($vars['courses']); ?>
</body>
</html>