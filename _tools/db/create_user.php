<?php
if (!function_exists('execute_query')) include "execute_query.php";

function create_user($email, $name, $is_admin, $is_staff, $role) {
    /**
     * Creates a record in the user table.
     */
    $sql = "INSERT INTO
    user (email, name, is_admin, is_staff, role)
    VALUES (?, ?, ?, ?, ?)";
    $result = execute_query($sql, 'ssiii', $email, $name, $is_admin, $is_staff, $role);
}
?>