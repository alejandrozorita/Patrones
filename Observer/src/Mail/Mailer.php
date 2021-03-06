<?php

namespace Patrones\Observer\Mail;

class Mailer
{

    /**
     * @var
     */
    protected $sender;


    /**
     * @var mixed|string
     */
    protected $transport;


    public function __construct(Transport $transport)
    {
        $this->transport = $transport;
    }


    public function setSender($email)
    {
        $this->sender = $email;
    }


    public function send($recipient, $subjetc, $body)
    {
        return $this->transport->send($recipient, $subjetc, $body, $this);
    }

}