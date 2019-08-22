<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'php_mailer/src/Exception.php';
require 'php_mailer/src/PHPMailer.php';
require 'php_mailer/src/SMTP.php';

include "conn.php";

if(isset($_POST['contact'])) {
    
 $email = $_POST['email'];
 $subject = $_POST['subject'];
 $message = $_POST['message'];

 $errors = [];
 if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
 $errors[] = "Email is not in good format!";
 }
 $reSubject = "/^[A-z]{5,100}$/";
 if(!preg_match($reSubject, $subject)) {
 $errors[] = "Subject is not in good format!";
 }
 if(!preg_match($reSubject, $message)) {
 $errors[] = "Message is not in good format!";
}
if(count($errors) > 0){
    http_response_code(422);
    }
    else{
$mail = new PHPMailer(true);
try {
//Server settings
// $mail->SMTPDebug = 2; // Enable verbose debug output
$mail->isSMTP(); // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = 'ictphp1@gmail.com';// SMTP username
 $mail->Password = 'sitephp1'; // SMTP password
 $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
 $mail->Port = 587; // TCP port to connect to
 //Recipients
 $mail->setFrom($email, $subject);
 $mail->addAddress("ictphp1@gmail.com", "test"); 

 //Content
 $mail->isHTML(true); // Set email format to HTML
 $mail->Subject = 'New message from ' . $email;
 $mail->Body = $message;
 $mail->send();
 echo 'Message has been sent';
 http_response_code(200);
 } catch (Exception $e) {
 echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
 http_response_code(500);
 }
 }
}
?>