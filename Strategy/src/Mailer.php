<?php

namespace Patrones\Strategy;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{

    /**
     * @var
     */
    private $sender;

    /**
     * @var array
     */
    private $sent = [];

    /**
     * @var mixed|string
     */
    private $transport;

    /**
     * @var string
     */
    private $filename;

    /**
     * @var
     */
    private $host;

    /**
     * @var
     */
    private $username;

    /**
     * @var
     */
    private $password;


    public function __construct($transport = 'smtp')
    {
        $this->transport = $transport;
    }


    /**
     * @param  mixed  $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }


    /**
     * @param  mixed  $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }


    /**
     * @param  mixed  $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param  string  $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }


    public function setSender($email)
    {
        $this->sender = $email;
    }


    public function send($recipient, $subjetc, $body)
    {
        if ($this->transport == 'smtp') {
            $mail = new PHPMailer(true);         // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = $this->host;                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = $this->username;                     // SMTP username
            $mail->Password = $this->password;                       // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 25;

            $mail->setFrom($this->sender);
            $mail->addAddress($recipient);     // Add a recipient
            $mail->Subject = $subjetc;
            $mail->Body = $body;
            $mail->AltBody = $body;

            return $mail->send();
        }

        if ($this->transport == 'array') {
            $this->sent[] = compact('recipient', 'subjetc', 'body');
        }

        if ($this->transport == 'file') {
            $data = [
              'New Email',
              "Recipient: {$recipient}",
              "Subject: {$subjetc}",
              "Body: {$body}",
            ];

            file_put_contents($this->filename, "\n\n" . implode("\n", $data), FILE_APPEND);
        }
    }


    public function sent()
    {
        return $this->sent;
    }

}