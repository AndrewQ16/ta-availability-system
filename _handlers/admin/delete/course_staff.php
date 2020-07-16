<?php
$root = dirname(__FILE__) . '/../../..';
if (!function_exists('admin_required')) include "$root/_tools/routes/admin_required.php";
if (!function_exists('auth_required')) include "$root/_tools/routes/auth_required.php";
if (!function_exists('list_courses')) include "$root/_tools/db/list_courses.php";
if (!function_exists('list_courses_and_staff')) include "$root/_tools/db/list_courses_and_staff.php";
if (!function_exists('get_course')) include "$root/_tools/db/get_course.php";
if (!function_exists('get_user_by_email')) include "$root/_tools/db/get_user_by_email.php";
if (!function_exists('get_course_staff')) include "$root/_tools/db/get_course_staff.php";
if (!function_exists('delete_course_staff')) include "$root/_tools/db/delete_course_staff.php";
if (!function_exists('remap_all')) include "$root/_tools/remap_all.php";

$vars = array(
    "post_response" => null,
    "course_staff" => null,
    "courses" => null,
);

function handler() {
    auth_required('/auth/login.php');
    admin_required('/profile.php');
    set_courses();
    set_course_staff();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') post_handler();
}

function post_handler() {
    global $vars;
    $course_id = $_POST['course_id'];
    $email = $_POST['email'];

    // Exit if the course_id or email are missing
    if (empty($course_id) || empty($email)) {
        $vars["post_response"] = "Error: Missing fields: "
          . ($course_id ? '': 'course id ')
          . ($email ? '': 'email ');
        return;
    }

    // Exit if the course does not exist
    $course = get_course($course_id);
    if (!$course) {
        $vars["post_response"] = "Error: course_id does not exist";
        return;
    }

    // Exit if the user with this email does not exist
    $user = get_user_by_email($email);
    if (!$user) {
        $vars["post_response"] = "Error: $email is not a user";
        return;
    }

    // Exit if the course_staff does not exist
    $course_staff = get_course_staff($course_id, $user['uid']);
    $course_name = $course['prefix'] . ' ' . $course['number'];
    if (!$course_staff) {
        $vars["post_response"] = "Error: $email is not assigned to $course_name";
        return;
    }

    // Delete the course from the database
    delete_course_staff($course_id, $user['uid']);
    $vars["post_response"] = "Removed $email from $course_name";
    set_course_staff();
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