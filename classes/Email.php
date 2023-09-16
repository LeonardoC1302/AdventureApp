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
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'd4b1e27352a262';
        $mail->Password = '1d64f440bc252f';

        $mail->setFrom('accounts@cradventures.com');
        $mail->addAddress('accounts@cradventures.com', 'CRAdventures.com');
        $mail->Subject = 'Confirm your account';
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $content = "<html>";
        $content .= "<p><strong>Hi " . $this->name . "!</strong>";
        $content .= " Thanks for creating an account on 
        CRAdventures. Please verify your account with the following link</p>";
        $content .= "<p>Click Here: <a href='http://localhost:3000/verify?token=" . $this->token . "'>Verify Account</a></p>";
        $content .= "<p> If you didn't create an account, please ignore this email.</p>";
        $content .= "</html>";

        $mail->Body = $content;
        $mail->send();
    }


}