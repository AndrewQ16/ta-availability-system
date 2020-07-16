<?php
$root = dirname(__FILE__) . '/../..';
if (!function_exists('session_remove')) include "$root/_tools/session/session_remove.php";
if (!function_exists('redirect')) include "$root/_tools/routes/redirect.php";

function handler() {
    session_remove('user');
    redirect('/auth/login.php');
}
?>