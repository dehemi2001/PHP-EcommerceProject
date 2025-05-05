<?php

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if(isset($_POST['password-reset-btn'])){

$user_email = $_POST['email'];

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM users WHERE user_email=?");

$stmt->bind_param('s', $user_email);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0){

    $new_password = bin2hex(random_bytes(4)); // Generate a random password

    $stmt = $conn->prepare("SELECT * FROM admins LIMIT 1");
    $stmt->execute();
    $admins = $stmt->get_result();
    $admin = $admins->fetch_assoc();

    $admin_email = $admin['admin_email'];
    $app_password = $admin['app_password'];

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */

require '../vendor/autoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
//Use `$mail->Host = gethostbyname('smtp.gmail.com');`
//if your network does not support SMTP over IPv6,
//though this may cause issues with TLS

//Set the SMTP port number:
// - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
// - 587 for SMTP+STARTTLS
$mail->Port = 465;

//Set the encryption mechanism to use:
// - SMTPS (implicit TLS on port 465) or
// - STARTTLS (explicit TLS on port 587)
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = $admin_email;

//Password to use for SMTP authentication
$mail->Password = $app_password;

//Set who the message is to be sent from
//Note that with gmail you can only use your account address (same as `Username`)
//or predefined aliases that you have configured within your account.
//Do not use user-submitted addresses in here
$mail->setFrom($admin_email, 'Solid Computers');

//Set an alternative reply-to address
//This is a good place to put user-submitted addresses
// $mail->addReplyTo($admin_email, 'Solid Computers');

//Set who the message is to be sent to
$mail->addAddress($user_email);

//Set the subject line
$mail->Subject = 'New Password';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML("
    <html>
    <head>
    <style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
    }
    .email-container {
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    .email-header {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .email-body {
        margin-bottom: 20px;
    }
    .email-footer {
        font-size: 12px;
        color: #555;
    }
    </style>
    </head>
    <body>
    <div class='email-container'>
    <div class='email-header'>Password Reset</div>
    <div class='email-body'>
        Dear User,<br><br>
        Your password has been reset successfully. Please use the following password to log in:<br><br>
        <strong>New Password:</strong> $new_password<br><br>
        We recommend changing your password after logging in.<br><br>
        Best regards,<br>
        Solid Computers
    </div>
    <div class='email-footer'>
        This is an automated message. Please do not reply to this email.
    </div>
    </div>
    </body>
    </html>
");

//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
    $stmt->bind_param('ss', md5($new_password), $user_email);
    $stmt->execute();
    header('location: ../forgot_password.php?success=New password has been sent to your email');
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}

//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}

}else{
    header('location: ../forgot_password.php?error=Email not found');
}

}