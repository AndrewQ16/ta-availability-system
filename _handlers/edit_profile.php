<?php
$root = dirname(__FILE__) . '/..';
if (!function_exists('auth_required')) include "$root/_tools/routes/auth_required.php";
if (!function_exists('session_get')) include "$root/_tools/session/session_get.php";
if (!function_exists('session_put')) include "$root/_tools/session/session_put.php";
if (!function_exists('update_user_name')) include "$root/_tools/db/update_user_name.php";

$vars = array(
    "current_user" => session_get('user'),
    "post_response" => null,
);

function handler() {
    auth_required('/auth/login.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') post_handler();
}

function post_handler() {
    global $vars;
    $vars['post_response'] = 'Missing field: name';

    // Exit if name is not set
    $name = $_POST['name'];
    if (empty($name)) return;

    // Update the user's name
    $user = session_get('user');
    update_user_name($user['uid'], $name);

    // Update the session
    $user['name'] = $name;
    session_put('user', $user);
    $vars['current_user'] = $user;
    $vars['post_response'] = 'Profile updated';
}
?>