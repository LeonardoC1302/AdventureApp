<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    public $email;
    public $name;
    public $token;

    public function __construct($email, $name, $token){
        $this->email = $email;
        $this->name = $name;
        $this->token = $token;
    }

    public function sendConfirmation(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->SMTPSecure = 'ssl';

        $mail->setFrom($_ENV['EMAIL_USER'], 'CRAdventures.com');
        $mail->addAddress($this->email); // Email from user
        $mail->Subject = 'Confirm your account';
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $content = "<html>";
        $content .= "<p><strong>Hi " . $this->name . "!</strong>";
        $content .= " Thanks for creating an account on 
        CRAdventures. Please verify your account with the following link</p>";
        $content .= "<p>Click Here: <a href='" . $_ENV['APP_URL'] . "/verify?token=" . $this->token . "'>Verify Account</a></p>";
        $content .= "<p> If you didn't create an account, please ignore this email.</p>";
        $content .= "</html>";

        $mail->Body = $content;
        $mail->send();
    }

    public function sendRecover(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->SMTPSecure = 'ssl';

        $mail->setFrom($_ENV['EMAIL_USER'], 'CRAdventures.com');
        $mail->addAddress($this->email); // Email from user
        $mail->Subject = 'Reset your password';
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $content = "<html>";
        $content .= "<p><strong>Hi " . $this->name . "!</strong>";
        $content .= " Your request to reset your password has been processed, click the following link to set a new password.</p>";
        $content .= "<p>Click Here: <a href='" . $_ENV['APP_URL'] . "/recover?token=" . $this->token . "'>Reset Password</a></p>";
        $content .= "<p> If you didn't request this change, please ignore this email.</p>";
        $content .= "</html>";

        $mail->Body = $content;
        $mail->send();
    }


}