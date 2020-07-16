<?php
function session_put($key, $value) {
    /**
     * Sets the session variable.
     */
    session_start();
    $_SESSION["taas_" . $key] = $value;
}
?>