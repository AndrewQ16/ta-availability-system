<?php
$root = dirname(__FILE__) . '/../..';
if (!function_exists('admin_required')) include "$root/_tools/routes/admin_required.php";
if (!function_exists('auth_required')) include "$root/_tools/routes/auth_required.php";
if (!function_exists('get_course')) include "$root/_tools/db/get_course.php";
if (!function_exists('get_user_by_email')) include "$root/_tools/db/get_user_by_email.php";
if (!function_exists('list_courses_and_staff')) include "$root/_tools/db/list_courses_and_staff.php";
if (!function_exists('list_courses')) include "$root/_tools/db/list_courses.php";
if (!function_exists('create_course_staff')) include "$root/_tools/db/create_course_staff.php";
if (!function_exists('remap_all')) include "$root/_tools/remap_all.php";
if (!function_exists('register_staff_from_csv')) include "$root/_tools/register_staff_from_csv.php";
if (!function_exists('get_current_semester')) include "$root/_tools/get_current_semester.php";

$vars = array(
    "post_response" => null,
    "course_staff" => null,
    "courses" => null,
);

function handler() {
    auth_required('/auth/login.php');
    admin_required('/profile.php');
    set_courses();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') get_handler();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') post_handler();
}

function get_handler() {
    set_course_staff();
}

function post_handler() {
    global $vars;
	
	
	
    $course_id = $_POST['course_id'];
	
	if(isset($_POST["FileUpload"])) {
		register_staff_from_csv($_FILES["file"]["tmp_name"], $course_id);
		goto set_data;
	}
	
	
    $email = $_POST['email'];

    // Exit if the course_id or email are missing
    if (empty($course_id) || empty($email)) {
        $vars["post_response"] = "Error: Missing fields: "
        . ($course_id ? '': 'course id ')
        . ($email ? '': 'email ');
          set_course_staff();
        return;
    }

    // Exit if the course_id is invalid
    $course = get_course($course_id);
    if (!$course) {
        $vars["post_response"] = "Error: Invalid course_id: $course_id";
        set_course_staff();
        return;
    }

    // Exit if the user with this email does not exist
    $user = get_user_by_email($email);
    if (!$user) {
        $vars["post_response"] = "Error: $email is not a user";
        set_course_staff();
        return;
    }

    // Create a course_staff in the database
    create_course_staff($course_id, $user['uid']);
    $course_name = $course['prefix'] . ' ' . $course['number'];
    $vars["post_response"] = "Added $email to $course_name";
	set_data:
    set_course_staff();
}
function check_semester_year($course) {
	global $vars;
	return ($course["Semester"] == $vars["curr_semester"]) &&
			($course["Year"] == date("Y"));
}
function set_courses() {
    global $vars;
	$semester = get_current_semester();
	$vars["curr_semester"] = $semester;
    $vars["courses"] = remap_all(
        list_courses(),
        array(
            'course_id' => 'Course ID',
            'prefix' => 'Prefix',
            'number' => 'Number',
            'semester' => 'Semester',
            'year' => 'Year',
        ),
    );
	$vars["courses_unique"] = array_filter($vars["courses"], "check_semester_year");
}

function set_course_staff() {
    global $vars;
    $vars["course_staff"] = remap_all(
        list_courses_and_staff(),
        array(
            'course_id' => 'Course ID',
            'user_email' => 'Email',
            'course_prefix' => 'Prefix',
            'course_number' => 'Number',
            'course_semester' => 'Semester',
            'course_year' => 'Year',
            'user_role' => 'Role',
        ),
    );
}
?>