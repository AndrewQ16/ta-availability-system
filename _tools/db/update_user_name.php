<?php
if (!function_exists('execute_query')) include "execute_query.php";

function update_user_name($uid, $name) {
    /**
     * Updates the name of a user.
     */
    $sql = "UPDATE user
    SET name = ?
    WHERE uid = ?";
    $result = execute_query($sql, 'si', $name, $uid);
}
?>