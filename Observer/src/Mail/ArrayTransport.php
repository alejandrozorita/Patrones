<?php

namespace Patrones\Observer\Mail;

/**
 * Class ArrayTransport
 *
 * @package Patrones\Strategy
 */
class ArrayTransport extends Transport
{
    protected $sent = [];


    /**
     * @param $recipient
     * @param $subjetc
     * @param $body
     * @param $sender
     *
     * @return bool
     */
    public function send($recipient, $subjetc, $body, $sender)
    {
        $this->sent[] = compact('recipient','subjetc', 'body');
        return true;
    }


    /**
     * @return array
     */
    public function sent()
    {
        return $this->sent;
    }

}