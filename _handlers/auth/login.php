<?php
$root = dirname(__FILE__) . '/../..';
if (!function_exists('login_with_email_and_password')) include "$root/_tools/auth/login_with_email_and_password.php";
if (!function_exists('unauth_required')) include "$root/_tools/routes/unauth_required.php";

$vars = array(
    "post_response" => "",
);

function handler() {
    unauth_required('/profile.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') post_handler();
}

function post_handler() {
    global $vars;
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email && $password && login_with_email_and_password($email, $password)) redirect('/profile.php');
    $vars['post_response'] = "<p style='color:#FF69B4;'>Invalid credentials</p>";
}
?>