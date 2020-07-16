<?php
if (!function_exists('fetch_all')) include "fetch_all.php";

function get_auth_user($email, $password) {
    /**
     * Fetches the auth_user associated with
     * these credentials.  Returns null if
     * the credentials are invalid.
     */

    // Fetch the user associated with this email (if any)
    $sql = "SELECT *
    FROM auth_user
    WHERE email = ?
    AND hashword = MD5(CONCAT(?, salt))
    ";
    $rows = fetch_all($sql, 'ss', $email, $password);
    if (count($rows) === 0) return null;
    return $rows[0];
}
?>