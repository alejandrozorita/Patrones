<?php

namespace Patrones\Observer\Testing;

use Patrones\Observer\Mail\Mailer;
use PHPUnit\Framework\Assert as PHPUnit;

class MailerFake extends Mailer
{
    public function assertSentTimes($total)
    {
        $sent = $this->transport->sent();

        PHPUnit::assertCount($total, $sent);

        return $this;
    }

    public function assertSentTo($mail)
    {
        $sent = $this->transport->sent();

        PHPUnit::assertSame($mail, $sent[0]['recipient']);

        return $this;
    }

    public function assertSubjectEquals($subjetc)
    {
        $sent = $this->transport->sent();

        PHPUnit::assertSame($subjetc, $sent[0]['subjetc']);

        return $this;
    }

    public function assertBodyEquals($body)
    {
        $sent = $this->transport->sent();

        PHPUnit::assertSame($body, $sent[0]['body']);

        return $this;
    }
}