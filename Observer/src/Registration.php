<?php

namespace Patrones\Observer;

use Patrones\Observer\Log\Logger;
use Patrones\Observer\Mail\Mailer;

class Registration
{

    /**
     * @var \Patrones\Observer\Log\Logger
     */
    private $logger;
    /**
     * @var \Patrones\Observer\Mail\Mailer
     */
    private $mailer;


    public function __construct(Logger $logger, Mailer $mailer)
    {
        $this->logger = $logger;
        $this->mailer = $mailer;
    }


    public function create(array $data)
    {
        // $user = User::create($data);
        $this->logger->log("User {$data['name']} <{$data['email']}> was created");
        $this->mailer->send('alzort@gmail.com', 'Welcome', "Hello {$data['name']}, welcome to bytecode.es");

        return true;
    }

}