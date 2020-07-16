<?php
$root = dirname(__FILE__) . '/..';
if (!function_exists('list_courses')) include "$root/_tools/db/list_courses.php";
if (!function_exists('list_course_staff_by_role')) include "$root/_tools/db/list_course_staff_by_role.php";
if (!function_exists('get_course')) include "$root/_tools/db/get_course.php";
if (!function_exists('remap_all')) include "$root/_tools/remap_all.php";
if (!function_exists('session_get')) include "$root/_tools/session/session_get.php";

$vars = array(
    "current_user" => session_get('user'),
    'is_admin' => session_get('user') && session_get('user')['is_admin'],
    "courses" => null,
    "course" => null,
    "professors" => null,
    "tas" => null,
    "does_not_exist" => null,
);

function handler() {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') get_handler();
}

function get_handler() {
    global $vars;
    $course_id = $_GET['course_id'];

    // If there is no course_id, list all courses
    if (!$course_id) {
        set_courses();
        return;
    }
    // Otherwise, we'll show a specific course.
    // Exit early if the course does not exist
    $course = get_course($course_id);
    if (!$course) {
        $vars['does_not_exist'] = true;
        return;
    }

    // Set the course, professor(s), and teaching assistant(s)
    $vars["course"] = $course;
    set_professors();
    set_tas();
}

function set_courses() {
    global $vars;
    $vars["courses"] = remap_all(
        list_courses(),
        array(
            'course_id' => 'Course ID',
            'prefix' => 'Prefix',
            'number' => 'Number',
            'semester' => 'Semester',
            'year' => 'Year',
        )
    );
}

function set_professors() {
    global $vars;
    $vars["professors"] = remap_all(
        list_course_staff_by_role($course_id, 1),
        array(
            'email' => 'Email',
            'name' => 'Name',
        )
    );
}

function set_tas() {
    global $vars;
    $vars["tas"] = remap_all(
        list_course_staff_by_role($course_id, 2),
        array(
            'email' => 'Email',
            'name' => 'Name',
        )
    );
}
?>