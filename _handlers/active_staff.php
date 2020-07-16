<?php
$root = dirname(__FILE__) . '/..';
if (!function_exists('list_active_staff')) include "$root/_tools/db/list_active_staff.php";
if (!function_exists('list_courses_by_semester_and_year')) include "$root/_tools/db/list_courses_by_semester_and_year.php";
if (!function_exists('get_current_semester')) include "$root/_tools/get_current_semester.php";
if (!function_exists('remap_all')) include "$root/_tools/remap_all.php";
if (!function_exists('session_get')) include "$root/_tools/session/session_get.php";

$vars = array(
    "current_user" => session_get('user'),
    'is_admin' => session_get('user') && session_get('user')['is_admin'],
    'is_staff' => session_get('user') && session_get('user')['is_staff'],
    "active_staff" => null,
    "courses" => null,
);

/*
SEMESTER DATE VARIABLES 
Semester -> (Start Month, Start Day, End Month, End Day);
*/
function handler() {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') get_handler();
}

function get_handler() {
    set_active_staff();
	set_courses();
	if(isset($_GET["course_id"])) {
		apply_filter("active_staff_long", "filter_by_course");
	}
}
function apply_filter($key, $filter) {
	global $vars;
	$filtered = array_filter($vars["$key"], $filter);
	$vars["$key"] = $filtered;
}
function filter_by_course($course) {
	return intval($_GET["course_id"]) == intval($course["course_id"]);
}
function set_active_staff() {
    global $vars;
    $vars["active_staff"] = remap_all(
        list_active_staff(),
        array(
            'user_name' => 'Name',
            'course_prefix' => 'Prefix',
            'course_number' => 'Number',
            'location' => 'Location',
            'end_time' => 'End Time',
            'course_id' => 'Course ID',
        )
    );
	$vars["active_staff_long"] = list_active_staff();
}
function set_courses() {
    global $vars;
	$curr_semester = get_current_semester();
    $vars["courses"] = remap_all(
        list_courses_by_semester_and_year($curr_semester,date("Y")),
        array(
            'course_id' => 'Course ID',
            'prefix' => 'Prefix',
            'number' => 'Number',
            'semester' => 'Semester',
            'year' => 'Year',
        )
    );
}
?>