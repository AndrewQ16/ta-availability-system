<?php
if (!function_exists('fetch_all')) include "fetch_all.php";

function get_course($course_id) {
    /**
     * Fetches the course associated with this course_id.
     * Returns null if no course exists.
     */
    $sql = "SELECT * FROM course WHERE course_id = ?";
    $rows = fetch_all($sql, 'i', $course_id);
    return count($rows) ? $rows[0] : null;
}
?>