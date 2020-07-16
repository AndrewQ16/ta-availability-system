<?php
if (!function_exists('fetch_all')) include "fetch_all.php";

function list_courses() {
    /**
     * Lists all courses.
     */
    return fetch_all("SELECT * FROM course");
}
?>