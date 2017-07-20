<?php
if (isset($_POST['email'])) {

    $email_to = "braicod92@gmail.com";

    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error . "<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }

    // validation expected data exists
    if (!isset($_POST['name']) ||
            !isset($_POST['mail']) ||
            !isset($_POST['subject']) ||
            !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }


    
    $name = $_POST['name']; // required
    $mail = $_POST['mail']; // required
    $subject = $_POST['subject']; // required
    $message = $_POST['message']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $mail)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'The First Name you entered does not appear to be valid.<br />';
    }

    if (!preg_match($string_exp, $subject)) {
        $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
    }

    if (strlen($error_message) > 0) {
        died($error_message);
    }

    $email_message = "Form details below.\n\n";

    function clean_string($string) {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($mail) . "\n";
    $email_message .= "Subject: " . clean_string($subject) . "\n";

// create email headers
    $headers = 'From: ' . $mail . "\r\n" .
            'Reply-To: ' . $mail . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $subject, $message, $headers);
    ?>

    <!-- include your own success html here -->

    Thank you for contacting us. We will be in touch with you very soon.

    <?php
}
?>