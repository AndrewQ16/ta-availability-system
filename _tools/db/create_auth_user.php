<?php
if (!function_exists('get_user_by_email')) include "get_user_by_email.php";
if (!function_exists('execute_query')) include "execute_query.php";

function create_auth_user($email, $password) {
    /**
     * Creates a record in the auth_user table.
     */
    // Get the user
    $user = get_user_by_email($email);
    if ($user == null) {
        print('Error creating auth_user: user does not exist');
        return;
    }

    // Create the auth_user
    $salt = md5(rand());
    $sql = "INSERT INTO
    auth_user (uid, email, hashword, salt, hashalgo)
    VALUES (?, ?, MD5(CONCAT(?, '$salt')), '$salt', 'MD5')
    ";
    $result = execute_query($sql, 'iss', $user['uid'], $email, $password);
}
?>