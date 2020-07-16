<?php
$root = dirname(__FILE__) . '/../../..';
if (!function_exists('admin_required')) include "$root/_tools/routes/admin_required.php";
if (!function_exists('auth_required')) include "$root/_tools/routes/auth_required.php";
if (!function_exists('list_users_and_verification')) include "$root/_tools/db/list_users_and_verification.php";
if (!function_exists('remap_all')) include "$root/_tools/remap_all.php";
if (!function_exists('get_user_by_email')) include "$root/_tools/db/get_user_by_email.php";
if (!function_exists('cascade_delete_user')) include "$root/_tools/db/cascade_delete_user.php";

$vars = array(
    "post_response" => null,
    "users" => null,
);

function handler() {
    auth_required('/auth/login.php');
    admin_required('/profile.php');
    set_users();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') post_handler();
}

function post_handler() {
    global $vars;
    $email = $_POST['email'];

    // Exit if email is missing
    if (empty($email)) {
        $vars["post_response"] = "Error: Missing email";
        return;
    }

    // Exit if the user with this email does not exist
    $user = get_user_by_email($email);
    if (!$user) {
        $vars["post_response"] = "Error: $email is not a user";
        return;
    }

    // Delete the user from the database
    cascade_delete_user($user['uid']);
    $vars["post_response"] = "Deleted $email";
    set_users();
}

function set_users() {
    global $vars;
    $vars["users"] = remap_all(
        list_users_and_verification(),
        array(
            'email' => 'Email',
            'name' => 'Name',
            'role' => 'Role',
            'is_admin' => 'Is Admin?',
            'is_verified' => 'Verified?',
        ),
    );
}
?>