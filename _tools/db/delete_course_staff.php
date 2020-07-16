<?php
if (!function_exists('execute_query')) include "execute_query.php";

function delete_course_staff($course_id, $uid) {
    /**
     * Deletes a course_staff record.
     */
    $sql = "DELETE FROM course_staff WHERE course_id = ? AND uid = ?";
    execute_query($sql, 'ii', $course_id, $uid);
}
?>