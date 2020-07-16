<?php
$root = dirname(__FILE__) . '/../..';
if (!function_exists('redirect')) include "$root/_tools/routes/redirect.php";
if (!function_exists('session_get')) include "$root/_tools/session/session_get.php";

function unauth_required($path) {
    /**
     * Checks to see if the user is logged in.
     * If so, redirects them to $path.
     */
    if (session_get('user') != null) redirect($path);
}
?>