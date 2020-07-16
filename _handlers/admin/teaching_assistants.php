<?php
$root = dirname(__FILE__) . '/../..';
if (!function_exists('admin_required')) include "$root/_tools/routes/admin_required.php";
if (!function_exists('auth_required')) include "$root/_tools/routes/auth_required.php";
if (!function_exists('create_user')) include "$root/_tools/db/create_user.php";
if (!function_exists('get_user_by_email')) include "$root/_tools/db/get_user_by_email.php";
if (!function_exists('is_email_address')) include "$root/_tools/is_email_address.php";
if (!function_exists('list_users_and_verification')) include "$root/_tools/db/list_users_and_verification.php";
if (!function_exists('remap_all')) include "$root/_tools/remap_all.php";

$vars = array(
    "post_response" => "",
    "tas" => null,
);

function handler() {
    auth_required('/auth/login.php');
    admin_required('/profile.php');
    if ($_SERVER['REQUEST_METHOD'] === 'GET') get_handler();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') post_handler();
}

function get_handler() {
    set_tas();
}

function post_handler() {
    global $vars;
    $email = $_POST['email'];
    $name = $_POST['name'];

    // Exit if the fields are null/empty
    if (empty($email) || empty($name)) {
        $vars["post_response"] = "Error: Missing fields: "
          . ($email ? '': 'email ')
          . ($name ? '': 'name ');
          set_tas();
        return;
    }

    // Exit if the email is invalid
    if (!is_email_address($email)) {
        $vars["post_response"] = "Error: Not an email address: $email";
        set_tas();
        return;
    }

    // Exit if the user is already registered
    $user = get_user_by_email($email);
    if ($user) {
        $role = $user['role'] == 1 ? 'Professor' : 'Teaching Assistant';
        $vars["post_response"] = "$email is already a $role";
        set_tas();
        return;
    }

    // Create a professor user in the database
    create_user($email, $name, 0, 1, 2);
    $vars["post_response"] = "$email is now a Teaching Assistant";
    set_tas();
}

function set_tas() {
    global $vars;
    $vars["tas"] = remap_all(
        list_users_and_verification(2),
        array(
            'email' => 'Email',
            'name' => 'Name',
            'is_verified' => 'Verified?',
        ),
    );
}
?>