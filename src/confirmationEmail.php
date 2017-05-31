<?php

function sendConfirmationEmail($email, $name, $shipAddress, $shipCity, $shipProvince, $shipPostal){
    //SMTP needs accurate times, and the PHP time zone MUST be set
    //This should be done in your php.ini, but this is how to do it if you don't have access to that
    date_default_timezone_set('America/Vancouver');
    require_once 'vendor/autoload.php';

    //Create a new PHPMailer instance
    $mail = new PHPMailer;

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 2;

    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';

    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';

    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 465;

    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'ssl';

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "ics199grp1@gmail.com";

    //Password to use for SMTP authentication
    $mail->Password = "ics199grp1!";

    //Set who the message is to be sent from
    $mail->setFrom('noreply@theexoticfruitcompany.com', 'The Exotic Fruit Company');

    //Set an alternative reply-to address
    //$mail->addReplyTo('replyto@example.com', 'First Last');

    //Set who the message is to be sent to
    $mail->addAddress($email, $name);

    //Set the subject line
    $mail->Subject = 'Your Order Summary from The Exotic Fruit Company';

    //$name = 'Jane Doe';
    //$address = '123 ave';
    //$shipCity = 'Victoria';
    //$province = 'BC';
    //$postalCode = 'V8Y 2K1';
    //$productName = 'Durian';
    //$productPrice = '$2.00';
    //$subtotal = '$2.00';
    //$grandTotal = '$12.00';


    $message = str_replace(array('%name%', '%address%', '%city%', '%province%', '%postalCode%', '%productName%', '%productPrice%', '%subtotal%', '%grandTotal%'),
        array($name, $shipAddress, $shipCity, $shipProvince, $shipPostal), file_get_contents('view/emailConfirm.html'));

    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
    //$mail->Body = 'Your email is ' . $email;
    $mail->msgHTML($message);

    //Replace the plain text body with one created manually
    //$mail->AltBody = 'This is a plain-text message body';

    //Attach an image file
    //$mail->addAttachment('images/phpmailer_mini.png');

    //send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
    }
}