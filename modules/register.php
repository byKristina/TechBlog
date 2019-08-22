<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php_mailer/src/Exception.php';
require 'php_mailer/src/PHPMailer.php';
require 'php_mailer/src/SMTP.php';


include "conn.php";

header("Content-type: application/json");
$code = 404;
$data = null;

if(isset($_POST['btnRegister'])) {
    $firstName = $_POST['tbFirstName'];
    $lastName = $_POST['tbLastName'];
    $username = $_POST['tbUsername'];
    $password = md5($_POST['tbPasswordR']);
    $email = $_POST['tbEmailR'];

    $errors = [];

    $reName = "/^[A-Z][a-z]{3,17}$/";
    $rePassword = "/^[A-z0-9]{3,20}$/";
    $reUsername = "/^[a-z0-9\_\!]{3,17}$/";

    if(!$firstName) {
        array_push($errors, "You must insert first name.");
    } elseif(!preg_match($reName, $firstName)) {
        array_push($errors, "First name is not ok.");
    }

    if(!$lastName) {
        array_push($errors, "You must insert last name.");
    } elseif(!preg_match($reName, $lastName)) {
        array_push($errors, "Last name is not ok.");
    }

    if(!$username) {
        array_push($errors, "You must insert username.");
    } elseif(!preg_match($reUsername, $username)) {
        array_push($errors, "Username is not ok.");
    }

    if(!$_POST['tbPasswordR']) {
            array_push($errors, "You must insert password.");
    } elseif(!preg_match($rePassword, $_POST['tbPasswordR'])) {
        array_push($errors, "Password is not ok.");
    }
    if(!$email) {
        array_push($errors, "You must insert email.");
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not ok.");
    }

    if(count($errors)) {
        $code = 422;
        $data = $errors;
    } else {
        $upit = "INSERT INTO user (firstName, lastName, username, email, password ,active,token,role_id)
          values (:firstName, :lastName, :username, :email, :password,0,:token,2)";
        $statement = $conn->prepare($upit);
        $statement->bindParam(":firstName", $firstName);
        $statement->bindParam(":lastName", $lastName);
        $statement->bindParam(":username", $username);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        
        $token = md5(time() . $email);
        $statement->bindParam(":token", $token);
        try {
            $code = $statement->execute() ? 201 : 500;

            if($code == 201) {
                $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'ictphp1@gmail.com';                 // SMTP username
                    $mail->Password = 'sitephp1';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                 // TCP port to connect to

              /*      $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );
*/
                    //Recipients
                    $mail->setFrom('ictphp1@gmail.com', 'Registration Form');
                    $mail->addAddress($email);     // Add a recipient

                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Activate your account';
                    $href = "https://techhblogg.000webhostapp.com/activate.php?a=" . $token;
                    $mail->Body    = 'To activate your account please follow <a href="' . $href . '">this</a> link';

                    $mail->send();
                    echo 'Message has been sent';
                    http_response_code(200);

                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                    http_response_code(500);
                }
            }

        } catch(PDOException $e) {
            $code = 409;
            $data = $e->getMessage();
        }
    }


}

http_response_code($code);
if($data) {
    echo json_encode($data);
}

