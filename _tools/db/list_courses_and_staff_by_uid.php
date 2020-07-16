<?php
if (!function_exists('fetch_all')) include "fetch_all.php";

function list_courses_and_staff_by_uid($uid) {
    /**
     * Lists all course_staff, as well as the
     * corresponding user and course records.
     */
    $sql = "SELECT
      cs.course_id as course_id
      , cs.uid as uid
      , c.prefix as course_prefix
      , c.number as course_number
      , c.semester as course_semester
      , c.year as course_year
      , u.email as user_email
      , u.name as user_name
      , u.role as user_role
      , u.is_admin as user_is_admin
      , u.is_staff as user_is_staff
    FROM course_staff cs
    LEFT JOIN course c ON c.course_id = cs.course_id
    LEFT JOIN user u ON u.uid = cs.uid
    WHERE cs.uid = ?
    ";
    return fetch_all($sql, 'i', $uid);
}
?>