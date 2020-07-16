<?php
if (!function_exists('execute_query')) include "execute_query.php";

function update_auth_user($email, $password) {
    /**
     * Updates a record in the auth_users table.
     */
    $salt = md5(rand());
    $sql = "UPDATE auth_user
    SET
      hashword = MD5(CONCAT(?, '$salt'))
      , salt = '$salt'
    WHERE email = ?
    ";
    execute_query($sql, 'ss', $password, $email);
}
?>