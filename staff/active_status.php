<?php
  $root = dirname(__FILE__) . '/..';
  include "$root/_handlers/staff/active_status.php";
  include "$root/_tools/ui/echo_table.php";
  include "$root/_tools/ui/echo_user_status.php";
  include "$root/_tools/ui/echo_dropdown_options.php";
  handler();
?>
<html>
<head>
	<title>Office Hour Status</title>
</head>
<body>
  <a href="../profile.php">My Profile</a><br>
  <a href="../active_staff.php">Active Staff</a><br>
  <a href="../courses.php">Courses</a><br>
  <h1>Current Status</h1>
  <?php
  $actv = $vars['active_staff'];
  if ($actv) {
    echo_user_status(array($actv));
  }
  else {
    echo "<p>Not working</p>";
  }
  ?>
  <h1>Set Status</h1>
  <form method='POST'>
	<?php if($actv) {
	  goto already_working;
	}
	?>
	<input type="radio" id="is_active_1" name="is_active" value="1">
    <label for="is_active_1">Working</label><br>
	<?php 
	if(!$actv) {
		goto not_working;
	}
	already_working: 
	?>
	<input type="radio" id="is_active_0" name="is_active" value="0">
    <label for="is_active_0">Not Working</label><br>
	<?php 
	if($actv) {
		goto end_form;
	}
	not_working:
	?>
    <label for='course_id'>Course ID</label>
    <select id="course_id" name="course_id">
		<?php
			echo_dropdown_options($vars['courses_unique'], "Course ID", "Prefix", "Number");
		?>
	</select>
	<br>
    <label for='location'>Location</label>
    <input type='text' name='location' id='location'>
    <input type='checkbox' id='is_location_link' name='is_location_link' value='1'>
    <label for='is_location_link'>Is this location a link?</label><br>
	<?php end_form: ?>
    <input type='submit'>
  </form>
  <?php echo "<p>".$vars['post_response']."</p>"; ?>

  <h1>Your Courses</h1>
  <?php echo_table($vars['courses']); ?>
</body>
</html>