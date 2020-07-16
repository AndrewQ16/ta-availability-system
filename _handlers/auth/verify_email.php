<?php
$root = dirname(__FILE__) . '/../..';
if (!function_exists('create_auth_user')) include "$root/_tools/db/create_auth_user.php";
if (!function_exists('update_auth_user')) include "$root/_tools/db/update_auth_user.php";
if (!function_exists('get_active_email_verification_token')) include "$root/_tools/db/get_active_email_verification_token.php";
if (!function_exists('redirect')) include "$root/_tools/routes/redirect.php";
if (!function_exists('unauth_required')) include "$root/_tools/routes/unauth_required.php";

$vars = array(
    "response" => "Invalid verification token.  Please register (or re-register).",
);

function handler() {
    unauth_required('/profile.php');
    if ($_SERVER['REQUEST_METHOD'] === 'GET') get_handler();
}

function get_handler() {
    // Exit if there's no token
    if (empty($_GET['id'])) return;

    // Get the email_verification token from the URL
    $id = $_GET['id'];
    preg_replace("/[^A-Za-z0-9 ]/", '', $id);

    // See if any tokens made in the last 15 minutes match this one
    $row = get_active_email_verification_token($id, 1);
    if ($row === null) return;

    // Create and update auth_user for this account
    $email = $row['email'];
    create_auth_user($email, $email);
    update_auth_user($email, $email);

    global $vars;
    $vars['response'] = 'Account verified!  You can now log in.  Your temporary password is your email address.';
}
?>