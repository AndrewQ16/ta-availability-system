<?php
$root = dirname(__FILE__) . '/../..';
if (!function_exists('redirect')) include "$root/_tools/routes/redirect.php";
if (!function_exists('session_get')) include "$root/_tools/session/session_get.php";

function staff_required($path) {
    /**
     * Redirects to $path is the current user isn't an staff member.
     */
    $user = session_get('user');
     if ($user == null || !$user['is_staff']) redirect($path);
}
?>