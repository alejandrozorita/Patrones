<?php

namespace Patrones\Observer\Testing;

use Patrones\Observer\Log\Logger;
use PHPUnit\Framework\Assert as PHPUnit;

class LoggerFake extends Logger
{
    /**
     * @param $content
     */
    public function assertFileEquals($content)
    {
        PHPUnit::assertStringContainsString($content, file_get_contents($this->filename));
    }

}