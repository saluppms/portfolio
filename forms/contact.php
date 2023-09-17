<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set the receiving email address
    $receiving_email_address = 'salmanfaris.ct.official@gmail.com';

    // Sanitize and validate user inputs
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    if (!$name || !$email || !$subject || !$message || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid input data. Please check your form and try again.');
    }

    // Set email parameters
    $to = $receiving_email_address;
    $from = $email;
    $headers = "From: $name <$from>\r\n";
    $headers .= "Reply-To: $from\r\n";
    $headers .= "Content-type: text/html\r\n";

    // Create the email message
    $email_message = <<<EOL
    <html>
    <body>
    <h2>New Contact Form Submission</h2>
    <p>Name: $name</p>
    <p>Email: $email</p>
    <p>Subject: $subject</p>
    <p>Message: $message</p>
    </body>
    </html>
    EOL;

    // Send the email
    if (mail($to, $subject, $email_message, $headers)) {
        // Email sent successfully
        echo 'OK';
    } else {
        // Email sending failed
        echo 'Error: Unable to send the email.';
    }
}
?>