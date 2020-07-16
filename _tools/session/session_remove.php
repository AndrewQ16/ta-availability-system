<?php
function session_remove($key) {
    /**
     * Removes the session variable.
     */
    session_start();
    unset($_SESSION["taas_" . $key]);
}
?>