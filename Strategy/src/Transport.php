<?php

namespace Patrones\Strategy;

/**
 * Class Transport
 *
 * @package Patrones\Strategy
 */
abstract class Transport
{
    abstract public function send($recipient, $subjetc, $body, $sender);
}