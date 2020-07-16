<?php
function redirect($path) {
    /**
     * Redirects to the following absolute path.
     */
    $host = strpos($_SERVER['HTTP_HOST'], 'buffalo.edu') === false
        ? "http://{$_SERVER['HTTP_HOST']}"
        : 'https://www-student.cse.buffalo.edu/CSE442-542/2020-Summer/cse-442e';
    header("Location: {$host}{$path}");
    exit();
}
?>