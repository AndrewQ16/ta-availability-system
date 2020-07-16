<?php
  $root = dirname(__FILE__) . '/..';
  include "$root/_handlers/auth/logout.php";
  handler();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Logout</title>
</head>
<body>
  <h1>Logging out...</h1>
</body>
</html>