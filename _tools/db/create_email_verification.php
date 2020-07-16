<?php
if (!function_exists('execute_query')) include "execute_query.php";

function create_email_verification($email, $reason) {
    $token = '';
    while (strlen($token) < 200) $token .= md5(rand());

    $sql = "INSERT INTO
    email_verification (email_verification_id, email, reason)
    VALUES (?, ?, ?)";
    execute_query($sql, 'ssi', $token, $email, $reason);
    return $token;
}
?>