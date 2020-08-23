<?php

namespace Patrones\Observer\Tests;

use StephaneCoinon\Mailtrap\{Client, Inbox, Model};
use Patrones\Observer\Mail\{ArrayTransport, FileTransport, Mailer, SmtpTransport};


class MailerTest extends TestCase
{
    /** @test */
    function it_stores_the_sent_emails_in_an_array()
    {
        $mailer = new Mailer($transport = new ArrayTransport);
        $mailer->setSender('contacto@alejandrozorita.me');

        $mailer->send('alzort@gmail.com', 'An example message', 'The content of the message');

        $sent = $transport->sent();

        $this->assertCount(1, $sent);
        $this->assertSame('alzort@gmail.com', $sent[0]['recipient']);
        $this->assertSame('An example message', $sent[0]['subject']);
        $this->assertSame('The content of the message', $sent[0]['body']);
    }


    /** @test */
    function it_stores_the_sent_emails_in_a_log_file()
    {
        $filename = __DIR__ . '/../storage/mailer-test.txt';
        @unlink($filename);

        $mailer = new Mailer(new FileTransport($filename));
        $mailer->setSender('contacto@alejandrozorita.me');

        $mailer->send('alzort@gmail.com', 'An example message', 'The content of the message');

        $content = file_get_contents($filename);

        $this->assertContains('Recipient: alzort@gmail.com', $content);
        $this->assertContains('Subject: An example message', $content);
        $this->assertContains('Body: The content of the message', $content);
    }


    /** @test */
    public function it_sends_emails_using_smtp()
    {
        // - Give / Setup

        // Instantiate Mailtrap API client
        $client = new Client('686b71c5d4181bb5c5c3342047b71a46');
        // Boot API models
        Model::boot($client);
        // Fetch an inbox by its id
        $inbox = Inbox::find(1033255);

        $inbox->empty();

        // - When
        $mailer = new Mailer(new SmtpTransport('smtp.mailtrap.io', 'bd21d8648628c1', '916c2f94ab4b8b', 25));
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