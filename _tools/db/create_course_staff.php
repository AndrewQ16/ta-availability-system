<?php
if (!function_exists('execute_query')) include "execute_query.php";

function create_course_staff($course_id, $uid) {
    /**
     * Creates a record in the course_staff table.
     */
    $sql = "INSERT INTO
    course_staff (course_id, uid)
    VALUES (?, ?)";
    return execute_query($sql, 'ii', $course_id, $uid);
}
?>