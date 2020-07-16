<?php
if (!function_exists('execute_query')) include "execute_query.php";
if (!function_exists('get_user')) include "get_user.php";

function cascade_delete_user($uid) {
    /**
     * Deletes the user and any associated items.
     */
    $user = get_user($uid);
    if (!$user) return;
    $sql1 = "DELETE FROM user WHERE uid = ?";
    $sql2 = "DELETE FROM auth_user WHERE uid = ?";
    $sql3 = "DELETE FROM course_staff WHERE uid = ?";
    $sql4 = "DELETE FROM staff_activity WHERE uid = ?";
    $sql5 = "DELETE FROM email_verification WHERE email = ?";
    execute_query($sql1, 'i', $uid);
    execute_query($sql2, 'i', $uid);
    execute_query($sql3, 'i', $uid);
    execute_query($sql4, 'i', $uid);
    execute_query($sql5, 's', $user['email']);
}
?>