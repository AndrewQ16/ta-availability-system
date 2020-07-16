<?php
if (!function_exists('execute_query')) include "execute_query.php";

function cascade_delete_course($course_id) {
    /**
     * Deletes the course and any associated items.
     */
    $sql1 = "DELETE FROM course WHERE course_id = ?";
    $sql2 = "DELETE FROM course_staff WHERE course_id = ?";
    execute_query($sql1, 'i', $course_id);
    execute_query($sql2, 'i', $course_id);
}
?>