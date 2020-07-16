<?php
$root = dirname(__FILE__) . '/..';
if (!function_exists('redirect')) include "$root/_tools/routes/redirect.php";
if (!function_exists('auth_required')) include "$root/_tools/routes/auth_required.php";
if (!function_exists('session_get')) include "$root/_tools/session/session_get.php";

function handler() {
    auth_required('/auth/login.php');
    if ($_SERVER['REQUEST_METHOD'] === 'GET') redirect('/profile.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') post_handler();
}

function post_handler() {
    $category = $_POST['category'];
    $redirect = $_POST['redirect'] ?? '/profile.php';

    // Upload an image then redirect to the appropriate page
    $code = upload_image($category);
    $sep = strpos($redirect, '?') === false ? '?' : '&';
    redirect("{$redirect}{$sep}_upres={$code}");
}

function upload_image($category) {
    /**
     * Uploads an image to a specific folder, dependning on category.
     * Returns 0 if no error occurs and the following numbers,
     * depending on the specific error:
     *   1: Invalid POST data (missing/invalid category, missing upload_file)
     *   2: Uploaded file is not an image
     */
    // Get the upload path.  Exit if not valid.
    $upload_path = get_upload_path($category);
    if (!$upload_path) return 1;

    // Exit if no file was uploaded.
    $tmp_name = $_FILES["uploaded_file"]["tmp_name"];
    if (!$tmp_name) return 1;

    // Exit if file is not an image.
    if (!exif_imagetype($tmp_name)) return 2;

    // Upload the image to the specified path
    move_uploaded_file($tmp_name, $upload_path);
    return 0;
}

function get_upload_path($category) {
    /**
     * Returns the upload path of this image category,
     * or null if none exists.
     */
    $uid = session_get('user')['uid'];
    if ($category === 'avatar') return "../images/avatars/uid_$uid";
    return null;
}

handler();
?>