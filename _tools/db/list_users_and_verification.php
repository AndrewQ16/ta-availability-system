<?php
if (!function_exists('fetch_all')) include "fetch_all.php";

function list_users_and_verification($role = null) {
    /**
     * Lists all users and their verification status.
     * Optionally filters by role, if not falsy.
     */
    $where_role = $role ? "WHERE role = ?" : '';
    $sql = "SELECT
      u.*
      , NOT ISNULL(au.email) as is_verified
    FROM user u
    LEFT JOIN auth_user au
    ON u.uid = au.uid
    $where_role
    ";
    return $role ? fetch_all($sql, 'i', $role) : fetch_all($sql);
}
?>