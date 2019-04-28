<?php
// Check for empty fields
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../phpmailer/vendor/autoload.php';
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
	
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 1;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.sendgrid.net';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'apikey';                 // SMTP username
    $mail->Password = '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';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('info@rrraymundo.ddns.net',$name);
    $mail->addAddress('ryanrafaelraymundo@gmail.com');     // Add a recipient    
  
    $body =' You have received a new message from your website contact form <br> Here are the details: <br> Name: '.$name.' <br> Email:  '.$email_address.' <br> Phone:  '. $phone.' <br> Message:  '.$message.' ' ;
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Message';
    $mail->Body    = $body;


    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
return true;			
?>
