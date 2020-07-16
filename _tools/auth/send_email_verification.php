<?php
function send_email_verification($recipient, $verification_str, $action_text) {
    ini_set("display_errors", 1);
    error_reporting(E_ALL);
    $from = "Barack Obama <obama@whitehouse.gov>";
    $subject = "Continue to $action_text";
    $message = "To $action_text, please click the link below:\n"
        . "https://www-student.cse.buffalo.edu/CSE442-542/2020-Summer/cse-442e/auth/verify_email.php?id=$verification_str";
    $headers = "From:" . $from;
    mail($recipient, $subject, $message, $headers);
}
?>