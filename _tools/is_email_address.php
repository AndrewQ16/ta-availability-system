<?php
function is_email_address($email) {
    /**
     * Returns true iff $email is well-formed.
     */
    return !!filter_var($email, FILTER_VALIDATE_EMAIL);
}
?>