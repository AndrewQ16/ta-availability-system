<?php
  $root = dirname(__FILE__) . '/..';
  include "$root/_handlers/admin/course_staff.php";
  include "$root/_tools/ui/echo_table.php";
  include "$root/_tools/ui/echo_dropdown_options.php";
  handler();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Staff</title>
</head>
<body>
  <a href="../profile.php">My Profile</a><br>
  <a href="courses.php">Edit Courses</a><br>
  <a href="professors.php">Edit Professors</a><br>
  <a href="teaching_assistants.php">Edit Teaching Assistants</a><br>
  <a href="delete/courses.php">Delete Courses</a><br>
  <a href="delete/course_staff.php">Delete Course Staff</a><br>
  <a href="delete/users.php">Delete Users</a><br>
  <h1>Add Course Staff</h1>
  <form method="POST">
    <label for="course_id">Course ID</label>
    <input type="number" name="course_id">
    <label for="email">Email</label>
    <input type="text" name="email">
    <input type="submit">
  </form>

  <h1>Add Course Staff From CSV</h1>
	<form method = "POST" enctype="multipart/form-data">
		Select a course:
		<select id="course_id" name="course_id">
			<?php 
			echo_dropdown_options($vars['courses_unique'], "Course ID", "Prefix", "Number");
			?>
		</select>
	Choose CSV file: <input type="file" name="file" id="file"/> <br/>
	<input type="submit" name = "FileUpload" value="Upload"/>
	</form>

  <?php echo $vars['post_response']; ?>
  <h1>Course Staff</h1>
  <?php echo_table($vars['course_staff']); ?>
  <h1>Courses</h1>
  <?php echo_table($vars['courses']); ?>
</body>
</html>