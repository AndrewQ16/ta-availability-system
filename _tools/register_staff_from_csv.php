<?php
if (!function_exists('create_user')) include "db/create_user.php";
if (!function_exists('create_course_staff')) include "db/create_course_staff.php";
if (!function_exists('get_user_by_email')) include "db/get_user_by_email.php";

function register_staff_from_csv($filename, $course_id) {
	if($filename == null) {
		return;
	}
	$myfile = fopen($filename, "r");
	while(!feof($myfile)) {
		$line = fgets($myfile);
		$linearr = explode(",",$line);
		try {
			$firstname = $linearr[0];
			$lastname = $linearr[1];
			$email = strval(trim($linearr[2]));
			if(strlen($email) == 0) {
				continue;
			}
			create_user($email, $firstname . " " . $lastname, 0, 1, 2);
			$user  = get_user_by_email($email);
			if($user == null) {
				continue;
			}
			create_course_staff($course_id, $user["uid"]);
		}
		catch(Exception $e) {
			continue;
		}
	}
}

?>
