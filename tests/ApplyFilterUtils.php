<?php

function apply_filter($key, $filter) {
	global $vars;
	$filtered = array_filter($vars["$key"], $filter);
	$vars["$key"] = $filtered;
}

function course_id_filter_123($course) {
	return $course["Course ID"] == 123;
}
function course_code_filter_CSE($course) {
	return $course["Course Code"] === "CSE";
}
function course_number_filter_323($course) {
	return $course["Course Number"] == 323;
}

?>