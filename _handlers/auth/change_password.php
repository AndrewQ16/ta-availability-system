<?php
$root = dirname(__FILE__) . '/../..';
if (!function_exists('auth_required')) include "$root/_tools/routes/auth_required.php";
if (!function_exists('update_auth_user')) include "$root/_tools/db/update_auth_user.php";
if (!function_exists('get_auth_user')) include "$root/_tools/db/get_auth_user.php";
if (!function_exists('session_get')) include "$root/_tools/session/session_get.php";

$vars = array(
    "post_response" => "",
);

function handler() {
    auth_required('/auth/login.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') post_handler();
}

function post_handler() {
    global $vars;
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password1'];
    $confirm_password = $_POST['new_password2'];

    // Exit early if the passwords are missing
    $vars['post_response'] = 'Passwords missing';
    if (!$old_password || !$new_password || !$confirm_password) return;

    // Extract form and user data
    $email = session_get('user')['email'];

    // Check if the new passwords match
    $vars['post_response'] = "New passwords don't match";
    if ($new_password !== $confirm_password) return;

    // Check if the current password is valid
    $vars['post_response'] = 'Invalid old password';
    $auth_user = get_auth_user($email, $old_password);
    if ($auth_user === null) return;

    // Set the new password
    update_auth_user($email, $new_password);
    $vars['post_response'] = 'Password changed';
}
?>