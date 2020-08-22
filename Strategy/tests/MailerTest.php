<?php

namespace Patrones\Strategy\Test;

class MailerTest extends TestCase
{

    /** @test */
    function it_sends_emails_using_smtp()
    {
        $mailer = new Mailer;
        $mailer->setSender('contacto@alejandrozorita.me');

        $sent = $mailer->send('alzort@gmail.com', "Asunto del mensaje", "Cuerpo del mensaje");

        $this->assertTrue($sent);
    }
}