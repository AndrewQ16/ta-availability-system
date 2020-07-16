<?php
if (!function_exists('fetch_all')) include "fetch_all.php";

function get_user($uid) {
    /**
     * Fetches the user associated with this uid.
     * Returns null if no user exists.
     */
    $sql = "SELECT * FROM user WHERE uid = ?";
    $rows = fetch_all($sql, 's', $uid);
    return count($rows) ? $rows[0] : null;
}
?>