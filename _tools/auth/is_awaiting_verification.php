<?php
$root = dirname(__FILE__) . '/../..';
if (!function_exists('fetch_all')) include "$root/_tools/db/fetch_all.php";

function is_awaiting_verification($email, $reason) {
    /**
     * Returns true iff $email has an entry in the
     * email_verification table created within the expiry timeframe.
     */
    $fifteen_mins_ago = time() - (15 * 60);
    $sql = "SELECT *
    FROM email_verification
    WHERE email = ?
    AND uts > FROM_UNIXTIME(?)
    AND reason = ?";
    $rows = fetch_all($sql, 'sii', $email, $fifteen_mins_ago, $reason);
    return count($rows) > 0;
}
?>