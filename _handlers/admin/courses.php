<?php
$root = dirname(__FILE__) . '/../..';
if (!function_exists('admin_required')) include "$root/_tools/routes/admin_required.php";
if (!function_exists('auth_required')) include "$root/_tools/routes/auth_required.php";
if (!function_exists('create_course')) include "$root/_tools/db/create_course.php";
if (!function_exists('list_courses')) include "$root/_tools/db/list_courses.php";
if (!function_exists('remap_all')) include "$root/_tools/remap_all.php";

$vars = array(
    "post_response" => "",
    "courses" => null,
);

function handler() {
    auth_required('/auth/login.php');
    admin_required('/profile.php');
    if ($_SERVER['REQUEST_METHOD'] === 'GET') get_handler();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') post_handler();
}

function get_handler() {
    set_courses();
}

function post_handler() {
    global $vars;
    $prefix = $_POST['prefix'];
    $number = (int) $_POST['number'];
    $semester = (int) $_POST['semester'];
    $year = (int) $_POST['year'];

    // Exit if the fields are null/empty
    if (empty($prefix) || empty($number) || empty($semester) || empty($year)) {
        $vars["post_response"] = "Error: Missing fields: "
          . ($prefix ? '': 'prefix ')
          . ($number ? '': 'number ')
          . ($semester ? '': 'semester ')
          . ($year ? '': 'year ');
          set_courses();
        return;
    }

    // Exit if the semester is invalid
    if (!in_array($semester, array(1, 2, 3, 4))) {
        $vars["post_response"] = "Error: Invalid semester: $semester";
        set_courses();
        return;
    }

    // Exit if the year is invalid
    if ($year < 1800 || $year > 2100) {
        $vars["post_response"] = "Error: Invalid year: $year";
        set_courses();
        return;
    }

    // Create a course in the database
    $prefix = strtoupper($prefix);
    create_course($prefix, $number, $semester, $year);
    $vars["post_response"] = "Created course $prefix $number";
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
        )
    );
}
?>