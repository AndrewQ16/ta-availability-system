<?php
if (!function_exists('fetch_all')) include "fetch_all.php";

function get_user_by_email($email) {
    /**
     * Fetches the user associated with this email.
     * Returns null if no user exists.
     */
    $sql = "SELECT * FROM user WHERE email = ?";
    $rows = fetch_all($sql, 's', $email);
    return count($rows) ? $rows[0] : null;
}
?>