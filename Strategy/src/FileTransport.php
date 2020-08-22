<?php

namespace Patrones\Strategy;

class FileTransport extends Transport
{
    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }


    /**
     * @param $recipient
     * @param $subjetc
     * @param $body
     * @param $sender
     *
     * @return bool|int
     */
    public function send($recipient, $subjetc, $body, $sender)
    {
        $data = [
          'New Email',
          "Recipient: {$recipient}",
          "Subject: {$subjetc}",
          "Body: {$body}",
        ];

        return file_put_contents($this->filename, "\n\n" . implode("\n", $data), FILE_APPEND);
    }

}