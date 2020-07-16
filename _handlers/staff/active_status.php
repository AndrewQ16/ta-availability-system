<?php
$root = dirname(__FILE__) . '/../..';
if (!function_exists('auth_required')) include "$root/_tools/routes/auth_required.php";
if (!function_exists('staff_required')) include "$root/_tools/routes/staff_required.php";
if (!function_exists('session_get')) include "$root/_tools/session/session_get.php";
if (!function_exists('get_active_staff')) include "$root/_tools/db/get_active_staff.php";
if (!function_exists('create_staff_activity')) include "$root/_tools/db/create_staff_activity.php";
if (!function_exists('get_course_staff')) include "$root/_tools/db/get_course_staff.php";
if (!function_exists('list_courses_and_staff_by_uid')) include "$root/_tools/db/list_courses_and_staff_by_uid.php";
if (!function_exists('get_current_semester')) include "$root/_tools/get_current_semester.php";
if (!function_exists('remap_all')) include "$root/_tools/remap_all.php";
if (!function_exists('remap_one')) include "$root/_tools/remap_one.php";

$vars = array(
    "active_staff" => null,
    "courses" => null,
    "post_response" => null,
);

function handler() {
    auth_required('/auth/login.php');
    staff_required('/profile.php');
    set_active_staff();
    set_courses();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') post_handler();
}

function post_handler() {
    global $vars;
    $uid = session_get('user')['uid'];
    $is_active = (int) ($_POST['is_active'] ?? -1);
    $course_id = $_POST['course_id'];
    $location = $_POST['location'];
    $end_time = $_POST['end_time'];
    if(isset($_POST['is_location_link'])){
        $is_location_link = $_POST['is_location_link'];
    } else {
        $is_location_link = 0;
    }
    

    // Exit if required fields are missing
    if ($is_active === 0) {
        $course_id = 0;
        $location = '';
        $end_time = null;
    }
    elseif ($is_active === 1) {
        if (empty($course_id) || empty($location)) {
          $vars['post_response'] = 'Missing field: '
            . ($course_id ? '' : 'Course ID')
            . ($location ? '' : 'Location');
          return;
        }
    }
    else {
        $vars['post_response'] = 'Missing field: Working Status '
          . ($course_id ? '' : 'Course ID ')
          . ($location ? '' : 'Location');
        return;
    }

    // Exit if user not assigned to course (or course DNE)
    if ($is_active === 1 && !get_course_staff($course_id, $uid)) {
        $vars['post_response'] = 'Error: not assigned to course';
        return;
    }

    // Write to db
    create_staff_activity($course_id, $uid, $is_active, $location, $end_time, $is_location_link);
    $vars['post_response'] = 'Status updated';
    set_active_staff();
}

function set_active_staff() {
    global $vars;
    $uid = session_get('user')['uid'];
    $vars["active_staff"] = remap_one(
        get_active_staff($uid),
        array(
            'user_name' => 'Name',
            'user_email' => 'Email',
            'course_prefix' => 'Prefix',
            'course_number' => 'Number',
            'location' => 'Location',
            'end_time' => 'End Time',
            'is_location_link' => 'Is location a link',
        )
    );
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
    $uid = session_get('user')['uid'];
    $vars["courses"] = remap_all(
        list_courses_and_staff_by_uid($uid),
        array(
            'course_id' => 'Course ID',
            'course_prefix' => 'Prefix',
            'course_number' => 'Number',
            'course_semester' => 'Semester',
            'course_year' => 'Year',
        )
    );
	$vars["courses_unique"] = array_filter($vars["courses"], "check_semester_year");
}
?>