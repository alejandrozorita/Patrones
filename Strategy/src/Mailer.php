<?php

namespace Patrones\Strategy;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{

    private $sender;
    private $sent = [];
    /**
     * @var mixed|string
     */
    private $transport;


    public function __construct($transport = 'smtp')
    {
        $this->transport = $transport;
    }


    public function setSender($email)
    {
        $this->sender = $email;
    }


    public function send($recipient, $subjetc, $body)
    {
        if($this->transport == 'smtp') {
            $mail = new PHPMailer(true);         // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'smtp.mailtrap.io';                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = 'bd21d8648628c1';                     // SMTP username
            $mail->Password = '916c2f94ab4b8b';                       // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 25;

            $mail->setFrom($this->sender);
            $mail->addAddress($recipient);     // Add a recipient
            $mail->Subject = $subjetc;
            $mail->Body = $body;
            $mail->AltBody = $body;

            return $mail->send();
        }

        if($this->transport == 'array') {
            $this->sent[] = compact('recipient', 'subjetc', 'body');
        }

    }


    public function sent()
    {
        return $this->sent;
    }

}