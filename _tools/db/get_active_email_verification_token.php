<?php
if (!function_exists('fetch_all')) include "fetch_all.php";

function get_active_email_verification_token($id) {
    /**
     * Returns the row from email_verification table
     * with this id, if any.
     * Returns null if the id doesn't exist,
     * or the record was created more than 15m ago.
     */
    $fifteen_mins_ago = time() - (15 * 60);
    $sql = "SELECT email
    FROM email_verification
    WHERE email_verification_id = ?
    AND uts > FROM_UNIXTIME(?)
    ";
    $rows = fetch_all($sql, 'si', $id, $fifteen_mins_ago);
    return count($rows) === 0 ? null : $rows[0];
}
?>