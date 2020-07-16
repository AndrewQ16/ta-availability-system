<?php
  include "_handlers/active_staff.php";
  include "_tools/ui/echo_active_tas.php";
  include "_tools/ui/echo_dropdown_options.php";
  handler();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Active Staff</title>
</head>
<body>
  <?php if ($vars['is_admin']) echo '<a href="admin/courses.php">Admin Panel</a><br>'; ?>
  <?php if ($vars['current_user']) echo '<a href="profile.php">My Profile</a><br>'; ?>
  <?php if ($vars['is_staff']) echo '<a href="staff/active_status.php">Set Active Status</a><br>'; ?>
  <a href="courses.php">Courses</a><br>
  <h1>Active Staff</h1>
<form method="get">
	<label for="courses">Filter by Course:</label>
	<select id="course_id" name="course_id">
		<?php
			echo_dropdown_options($vars['courses'], "Course ID", "Prefix", "Number");
		?>
	</select>
	<input type="submit" name = "filter_course">
</form>
  <?php echo_active_tas($vars['active_staff_long'], "."); ?>
</body>
</html>