<?php
if (!function_exists('execute_query')) include "execute_query.php";

function create_staff_activity($course_id, $uid, $is_active, $location, $end_time, $is_location_link) {
    /**
     * Creates a record in the course_staff table.
     */
    $sql = "INSERT INTO
    staff_activity (course_id, uid, is_active, location, end_time, is_location_link)
    VALUES (?, ?, ?, ?, ?, ?)";
    return execute_query($sql, 'iiisii', $course_id, $uid, $is_active, $location, $end_time, $is_location_link);
}
?>