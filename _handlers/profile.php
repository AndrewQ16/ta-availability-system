<?php
$root = dirname(__FILE__) . '/..';
if (!function_exists('redirect')) include "$root/_tools/routes/redirect.php";
if (!function_exists('session_get')) include "$root/_tools/session/session_get.php";
if (!function_exists('get_user')) include "$root/_tools/db/get_user.php";

$vars = array(
    'is_admin' => session_get('user') && session_get('user')['is_admin'],
    'is_self' => null,
    "user" => null,
);

function handler() {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') get_handler();
}

function get_handler() {
    // Redirect if no user specified
    $uid = $_GET['uid'];
    $current_user = session_get('user');
    if (!$uid) {
        $path = $current_user ? "/profile.php?uid={$current_user['uid']}" : '/auth/login.php';
        redirect($path);
        return;
    }

    // Fetch the user data
    global $vars;
    $user = get_user($uid);
    $vars['user'] = $user;
    $vars['is_self'] = ($user['uid'] == $current_user['uid']);
}
?>