<?php
$root = dirname(__FILE__) . '/../..';
if (!function_exists('redirect')) include "$root/_tools/routes/redirect.php";
if (!function_exists('session_get')) include "$root/_tools/session/session_get.php";

function admin_required($path) {
    /**
     * Redirects to $patrh is the current user isn't an admin.
     */
    $user = session_get('user');
     if ($user == null || !$user['is_admin']) redirect($path);
}
?>