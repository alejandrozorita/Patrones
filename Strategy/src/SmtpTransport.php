<?php

namespace Patrones\Strategy;

use PHPMailer\PHPMailer\PHPMailer;

class SmtpTransport extends Transport
{
    /**
     * @param $recipient
     * @param $subjetc
     * @param $body
     * @param  \Patrones\Strategy\Mailer  $mailer
     *
     * @return bool
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function send($recipient, $subjetc, $body, Mailer $mailer)
    {
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

}