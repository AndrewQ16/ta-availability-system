<?php
$root = dirname(__FILE__) . '/../../..';
if (!function_exists('admin_required')) include "$root/_tools/routes/admin_required.php";
if (!function_exists('auth_required')) include "$root/_tools/routes/auth_required.php";
if (!function_exists('cascade_delete_course')) include "$root/_tools/db/cascade_delete_course.php";
if (!function_exists('list_courses')) include "$root/_tools/db/list_courses.php";
if (!function_exists('get_course')) include "$root/_tools/db/get_course.php";
if (!function_exists('remap_all')) include "$root/_tools/remap_all.php";

$vars = array(
    "post_response" => "",
    "courses" => null,
);

function handler() {
    auth_required('/auth/login.php');
    admin_required('/profile.php');
    set_courses();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') post_handler();
}

function post_handler() {
    global $vars;
    $course_id = $_POST['course_id'];

    // Exit if the course_id is missing
    if ($course_id == null) {
        $vars["post_response"] = "Error: Missing course_id";
        return;
    }

    // Exit if the course does not exist
    $course = get_course($course_id);
    if (!$course) {
        $vars["post_response"] = "Error: course_id does not exist";
        return;
    }

    // Delete the course from the database
    cascade_delete_course($course_id);
    $vars["post_response"] = "Deleted course $course_id";
    set_courses();
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
        ),
    );
}
?>