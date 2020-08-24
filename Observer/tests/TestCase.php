<?php

namespace Patrones\Observer\Tests;

use Patrones\Observer\Mail\ArrayTransport;
use Patrones\Observer\Testing\LoggerFake;
use Patrones\Observer\Testing\MailerFake;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function loggerFake($filename)
    {
        $filename = storage_path($filename);
        @unlink($filename);

        return new LoggerFake($filename);

    }


    /**
     * @return array
     */
    protected function mailerFake()
    {
        $mailer = new MailerFake($transport = new ArrayTransport);
        $mailer->setSender('contacto@alejandrozorita.me');
        return $mailer;
    }
}