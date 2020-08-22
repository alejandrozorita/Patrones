<?php

namespace Patrones\Strategy;

/**
 * Class ArrayTransport
 *
 * @package Patrones\Strategy
 */
class ArrayTransport extends Transport
{
    /**
     * @param $recipient
     * @param $subjetc
     * @param $body
     * @param  \Patrones\Strategy\Mailer  $mailer
     *
     * @return bool
     */
    public function send($recipient, $subjetc, $body, Mailer $mailer)
    {
        $mailer->sent[] = compact('recipient', 'subjetc', 'body');
        return true;
    }

}