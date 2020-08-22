<?php

namespace Patrones\Strategy;

use PHPMailer\PHPMailer\PHPMailer;

class SmtpTransport extends Transport
{
    /**
     * @var
     */
    protected $host;

    /**
     * @var
     */
    protected $username;

    /**
     * @var
     */
    protected $password;

    /**
     * @var
     */
    protected $port;

    public function __construct($host, $username, $password, $port)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->port = $port;
    }


    /**
     * @param $recipient
     * @param $subjetc
     * @param $body
     * @param $sender
     *
     * @return bool
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function send($recipient, $subjetc, $body, $sender)
    {
        $mail = new PHPMailer(true);         // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host = $this->host;                    // Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
        $mail->Username = $this->username;                     // SMTP username
        $mail->Password = $this->password;                       // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = $this->port;

        $mail->setFrom($mailer->sender);
        $mail->addAddress($recipient);     // Add a recipient
        $mail->Subject = $subjetc;
        $mail->Body = $body;
        $mail->AltBody = $body;

        return $mail->send();
    }

}