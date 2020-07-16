<?php
function session_get($key) {
    /**
     * Returns the session variable,
     * or null if the variable does not exist.
     */
    session_start();
    return $_SESSION["taas_" . $key];
}
?>