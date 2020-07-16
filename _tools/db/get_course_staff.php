<?php
if (!function_exists('fetch_all')) include "fetch_all.php";

function get_course_staff($course_id, $uid) {
    /**
     * Fetches the course associated with this course_id.
     * Returns null if no course exists.
     */
    $sql = "SELECT * FROM course_staff WHERE course_id = ? AND uid = ?";
    $rows = fetch_all($sql, 'ii', $course_id, $uid);
    return count($rows) ? $rows[0] : null;
}
?>