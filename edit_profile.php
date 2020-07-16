<?php
  include "_handlers/edit_profile.php";
  include "_tools/ui/echo_user_avatar.php";
  handler();
?>
<html>
<head>
	<title>Edit Profile</title>
</head>
<body>
  <a href="profile.php">My Profile</a><br>
  <a href="active_staff.php">Active Staff</a><br>
  <a href="courses.php">Courses</a><br>
  <a href="auth/logout.php">Logout</a><br>
  <a href="auth/change_password.php">Change Password</a><br>
  <h1>Edit Profile</h1>
  <?php
  $user = $vars['current_user'];
  echo_user_avatar('.', $user['uid']);
  echo "
  <form method='POST'>
    <label for='email'>Email</label>
    <input type='text' value='{$user['email']}' name='email' id='email' disabled='disabled'>
    <br/>
    <label for='name'>Name</label>
    <input type='text' value='{$user['name']}' name='name' id='name'>
    <input type='submit'>
  </form>
  ";
  echo $vars['post_response'];
  ?>
  <form action="upload/image.php" method="POST" enctype="multipart/form-data">
    <label for="uploaded_file">Select image to upload:</label>
    <input type="file" name="uploaded_file" id="uploaded_file">
    <input hidden type="text" name="category" value="avatar">
    <input hidden type="text" name="redirect" value="/edit_profile.php">
    <input type="submit" value="Upload Image" name="submit">
  </form>
  <?php if ($_GET['_upres'] === '0') echo '<p>Profile picture updated</p>'; ?>
  <?php if ($_GET['_upres'] === '1') echo '<p>Error: No file selected</p>'; ?>
  <?php if ($_GET['_upres'] === '2') echo '<p>Error: Not an image</p>'; ?>
</body>
</html>