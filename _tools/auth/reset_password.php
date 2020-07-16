<?php
$root = dirname(__FILE__) . '/../..';
if (!function_exists('is_registered')) include "$root/_tools/auth/is_registered.php";
if (!function_exists('is_awaiting_verification')) include "$root/_tools/auth/is_awaiting_verification.php";
if (!function_exists('create_email_verification')) include "$root/_tools/db/create_email_verification.php";
if (!function_exists('send_email_verification')) include "$root/_tools/auth/send_email_verification.php";

function reset_password($email) {
    /**
     * Attempts to reset the user's password via email verification.
     * Returns true if eligible to reset and false otherwise.
     */

    // Exit if the email is not an auth_user
    $email = trim($email);
    if (!is_registered($email)) return false;

    // Exit if the user was recently sent an email
    if (is_awaiting_verification($email, 2)) return true;

    // Create row in email_verification and send email
    $verification_str = create_email_verification($email, 2);
    send_email_verification($email, $verification_str, 'reset your password');
    return true;
}
?>