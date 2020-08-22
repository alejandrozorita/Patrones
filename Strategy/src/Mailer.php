<?php

namespace Patrones\Strategy;

class Mailer
{

    private $sender;


    public function setSender($email)
    {
        $this->sender = $email;
    }

    public function send($email, $asunto, $mensaje)
    {
        return true;
    }
}