<?php
$root = dirname(__FILE__) . '/../..';
if (!function_exists('unauth_required')) include "$root/_tools/routes/unauth_required.php";
if (!function_exists('reset_password')) include "$root/_tools/auth/reset_password.php";

$vars = array(
    "post_response" => "",
);

function handler() {
    unauth_required('/auth/login.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') post_handler();
}

function post_handler() {
    global $vars;
    $email = $_POST['email'];
    $vars['post_response'] = ($email && reset_password($email))
        ? 'Check your email for a password reset link.'
        : 'Invalid email';
}
?>