<?php
$root = dirname(__FILE__) . '/../..';
if (!function_exists('register_with_email_verification')) include "$root/_tools/auth/register_with_email_verification.php";
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
    $vars['post_response'] = ($email && register_with_email_verification($email))
        ? "<p>Check your email to continue registration.</p>"
        : "<p style='color:#FF69B4;'>An error occurred.  Are you a valid TA?</p>";
}
?>