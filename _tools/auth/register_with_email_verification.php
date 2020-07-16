<?php
$root = dirname(__FILE__) . '/../..';
if (!function_exists('is_email_address')) include "$root/_tools/is_email_address.php";
if (!function_exists('is_authorized_to_register')) include "$root/_tools/auth/is_authorized_to_register.php";
if (!function_exists('is_registered')) include "$root/_tools/auth/is_registered.php";
if (!function_exists('is_awaiting_verification')) include "$root/_tools/auth/is_awaiting_verification.php";
if (!function_exists('create_email_verification')) include "$root/_tools/db/create_email_verification.php";
if (!function_exists('send_email_verification')) include "$root/_tools/auth/send_email_verification.php";

function register_with_email_verification($email) {
    /**
     * Tries to create an entry in the email verification table.
     * Returns true if successful and false otherwise.
     */
    $email = trim($email);
    $allowed = is_email_address($email)
        && is_authorized_to_register($email)
        && !is_registered($email);
    if (!$allowed) return false;

    if (is_awaiting_verification($email, 1)) return true;
    $verification_str = create_email_verification($email, 1);
    send_email_verification($email, $verification_str, 'register your account');
    return true;
}
?>