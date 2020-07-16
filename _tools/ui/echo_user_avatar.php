<?php
function echo_user_avatar($root, $uid, $max_width="300px", $max_height="300px") {
    /**
     * Echoes a user avatar, based on $uid.
     * $root is the relative path to the repository
     * root directory, relative to the file calling
     * this function
     * ($root is something like '.', '..', '../..', etc)
     */
    $src = "$root/images/avatars/uid_$uid";
    if (!file_exists($src)) $src = "$root/images/avatars/default";
    echo "<img src='$src' style='display:block;max-width:$max_width;max-height:$max_height;width:auto;height:auto;'/>";
}
?>