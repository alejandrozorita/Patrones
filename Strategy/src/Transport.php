<?php

namespace Patrones\Strategy;

use PHPMailer\PHPMailer\PHPMailer;

/**
 * Class Transport
 *
 * @package Patrones\Strategy
 */
class Transport
{
    /**
     * @var string
     */
    private $type;


    public function __construct($type = 'smtp')
    {
        $this->type = $type;
    }
    
    public function send($recipient, $subjetc, $body, Mailer $mailer)
    {
        if ($this->type == 'smtp') {
            $mail = new PHPMailer(true);         // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = $mailer->host;                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = $mailer->username;                     // SMTP username
            $mail->Password = $mailer->password;                       // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 25;

            $mail->setFrom($mailer->sender);
            $mail->addAddress($recipient);     // Add a recipient
            $mail->Subject = $subjetc;
            $mail->Body = $body;
            $mail->AltBody = $body;

            return $mail->send();
        }

        if ($this->type == 'array') {
            $mailer->sent[] = compact('recipient', 'subjetc', 'body');
            return true;
        }

        if ($this->type == 'file') {
            $data = [
              'New Email',
              "Recipient: {$recipient}",
              "Subject: {$subjetc}",
              "Body: {$body}",
            ];

            file_put_contents($mailer->filename, "\n\n" . implode("\n", $data), FILE_APPEND);
        }
    }
}