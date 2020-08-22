<?php

namespace Patrones\Strategy\Tests;

use Patrones\Strategy\Mailer;
use StephaneCoinon\Mailtrap\Client;
use StephaneCoinon\Mailtrap\Inbox;
use StephaneCoinon\Mailtrap\Model;

/**
 * Class MailerTest
 *
 * @package Patrones\Strategy\Test
 */
class MailerTest extends TestCase
{

    /** @test */
    public function it_stores_the_sent_emails_in_an_array()
    {
        $mailer = new Mailer('array');
        $mailer->setSender('contacto@alejandrozorita.me');

        $mailer->send('alzort@gmail.com', "Asunto del mensaje", "Cuerpo del mensaje");

        $sent = $mailer->sent();
        $this->assertCount(1, $sent);
        $this->assertSame('alzort@gmail.com', $sent[0]['recipient']);
        $this->assertSame('Asunto del mensaje', $sent[0]['subjetc']);
        $this->assertSame('Cuerpo del mensaje', $sent[0]['body']);
    }


    /** @test */
    public function it_store_the_sent_emails_in_a_log_file()
    {

    }

        /** @test
         */
    public function it_sends_emails_using_smtp()
    {
        // - Give / Setup

        // Instantiate Mailtrap API client
        $client = new Client('686b71c5d4181bb5c5c3342047b71a46');

        // Boot API models
        Model::boot($client);

        // Fetch an inbox by its id
        $inbox = Inbox::find(1033255);

        //$inbox->empty();

        // - When

        $mailer = new Mailer('smtp');
        $mailer->setSender('contacto@alejandrozorita.me');

        $sent = $mailer->send('alzort@gmail.com', "Asunto del mensaje", "Cuerpo del mensaje");

        // - Then / Asserts
        // Get the last (newest) message in an inbox
        $newestMessage = $inbox->lastMessage();

        $this->assertNotNull($newestMessage);
        $this->assertSame(['alzort@gmail.com'], $newestMessage->recipientEmails());
        $this->assertSame('Asunto del mensaje', $newestMessage->subject());
        $this->assertSame('Cuerpo del mensaje', trim($newestMessage->htmlBody()));
        $this->assertTrue($sent);
    }

}