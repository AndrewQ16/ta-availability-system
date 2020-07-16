<?php
if (!function_exists('execute_query')) include "execute_query.php";

function create_course($prefix, $number, $semester, $year) {
    /**
     * Creates a record in the course table.
     */
    $sql = "INSERT INTO
    course (prefix, number, semester, year)
    VALUES (UPPER(?), ?, ?, ?)";
    return execute_query($sql, 'siii', $prefix, $number, $semester, $year);
}
?>