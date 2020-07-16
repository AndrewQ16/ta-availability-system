<?php
$root = dirname(__FILE__) . '/../..';
if (!function_exists('fetch_all')) include "$root/_tools/db/fetch_all.php";

function is_registered($email) {
    /**
     * Returns true iff $email is registered.
     */
    $sql = "SELECT * FROM auth_user WHERE email = ?";
    $rows = fetch_all($sql, 's', $email);
    return count($rows) > 0;
}
?>