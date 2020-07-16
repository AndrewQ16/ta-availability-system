<?php
if (!function_exists('fetch_all')) include "fetch_all.php";

function list_active_staff() {
    /**
     * Lists currently active course_staff, as well as the
     * corresponding user and course records.
     */
    $sql = "SELECT
      sa.course_id as course_id
      , sa.is_active as is_active
      , sa.location as location
      , sa.end_time as end_time
      , sa.is_location_link as is_location_link
      , c.prefix as course_prefix
      , c.number as course_number
      , u.email as user_email
      , u.name as user_name
      , u.role as user_role
      , u.is_admin as user_is_admin
      , u.is_staff as user_is_staff
	  , u.uid as user_id
    FROM (
      SELECT uid, MAX(id) as id
      FROM staff_activity
      GROUP BY uid
    ) tmp
    LEFT JOIN staff_activity sa ON tmp.id = sa.id
    LEFT JOIN user u on tmp.uid = u.uid
    LEFT JOIN course c on sa.course_id = c.course_id
    WHERE sa.is_active = true
    AND IFNULL(sa.end_time, 9999999999) > 5
    ";
    return fetch_all($sql);
}
?>