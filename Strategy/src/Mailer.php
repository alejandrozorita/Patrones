<?php

namespace Patrones\Strategy;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{

    /**
     * @var
     */
    public $sender;

    /**
     * @var array
     */
    public $sent = [];

    /**
     * @var mixed|string
     */
    private $transport;

    /**
     * @var string
     */
    public $filename;

    /**
     * @var
     */
    public $host;

    /**
     * @var
     */
    public $username;

    /**
     * @var
     */
    public $password;


    public function __construct($transport = 'smtp')
    {
        $this->transport = (new Transport($transport));
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
        return $this->transport->send($recipient, $subjetc, $body, $this);
    }


    public function sent()
    {
        return $this->sent;
    }

}