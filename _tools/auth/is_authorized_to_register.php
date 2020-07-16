<?php
$root = dirname(__FILE__) . '/../..';
if (!function_exists('fetch_all')) include "$root/_tools/db/fetch_all.php";

function is_authorized_to_register($email) {
    /**
     * Returns true iff $email is in the user table.
     */
    $sql = "SELECT *
    FROM user
    WHERE email = ?
    ";
    $rows = fetch_all($sql, 's', $email);
    return count($rows) > 0;
}
?>