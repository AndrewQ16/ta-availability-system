<?php
$root = dirname(__FILE__) .  '/../..';
if (!function_exists('get_auth_user')) include "$root/_tools/db/get_auth_user.php";
if (!function_exists('get_user_by_email')) include "$root/_tools/db/get_user_by_email.php";
if (!function_exists('session_put')) include "$root/_tools/session/session_put.php";

function login_with_email_and_password($email, $password) {
    /**
     * Attempts to login with the following credentials.
     * Returns true if successful, false otherwise.
     * 
     * If successful, sets a session variable '',
     * which represents the profile data of the
     * currently logged-in user.
     */

    // Fetch the user associated with this email and password (if any)
    $auth_user = get_auth_user($email, $password);
    if ($auth_user === null) return false;

    // Set the current user in the session
    $user = get_user_by_email($email);
    session_put('user', $user);
    return true;
}
?>