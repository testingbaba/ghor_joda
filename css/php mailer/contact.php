<?php


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
//require 'vendor/autoload.php';
require('PHPMailer/Exception.php');
require('PHPMailer/SMTP.php');
require('PHPMailer/PHPMailer.php');




extract($_REQUEST);
$name=$_POST["name"];

$email=$_POST["email"];

$message=$_POST["message"];

$guest=$_POST["guest"];

$events=$_POST["events"];



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
        !isset($_POST['email']) ||
        !isset($_POST['message']) 
        
     ) {
    died('We are sorry, but there appears to be a problem with the form you submitted.');
}





$error_message = "This is error massege";
$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

if (!preg_match($email_exp, $email)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
}

$string_exp = "/^[A-Za-z .'-]+$/";

if (!preg_match($string_exp, $name)) {
    $error_message .= 'The  Name you entered does not appear to be valid.<br />';
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'info@kingbommtech.in';                     //SMTP username
    $mail->Password   = 'Mantu9051@';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;
    //Server settings
    //$mail->SMTPDebug = 'DEBUGSERVER=1';                      //Enable verbose debug output
    // $mail->isSMTP();                                            //Send using SMTP
    // $mail->Host       = 'smtp.sendgrid.net';                     //Set the SMTP server to send through
    // $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    // $mail->Username   = 'nikhilkumarnikhilkumar0114@gmail.com';                     //SMTP username
    // $mail->Password   = 'RAMESHWAR1234@';                               //SMTP password
    // $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    // $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('info@kingbommtech.in', 'Nikhil Kumar');
    $mail->addAddress('nikhilrameshwar0114@gmail.com');     //Add a recipient
  //  $mail->addAddress('ellen@example.com');               //Name is optional
  //  $mail->addReplyTo('info@example.com', 'Information');
      $mail->addCC('luckyrameshwar0114@gmail.com');
 //   $mail->addBCC('bcc@example.com');

    //Attachments
  //  $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
 //   $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Contact Us';
    $mail->Body    = "Name: $name <br>Email: $email<br>Message: $message";
 //   $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo "<script type='text/javascript'>alert('Thank You For Submitting Your Query! We Will Get Back To You Soon');</script>";

    echo "<script>window.location='index.html'</script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>