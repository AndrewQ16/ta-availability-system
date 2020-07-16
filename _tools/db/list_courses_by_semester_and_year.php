<?php
if (!function_exists('fetch_all')) include "fetch_all.php";

function list_courses_by_semester_and_year($semester, $year) {
	$query = "SELECT * FROM course WHERE semester = ? and year = ?";
    return fetch_all($query, "ii", $semester, $year);
}
?>