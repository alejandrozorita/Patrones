<?php

namespace Patrones\Strategy;

class FileTransport extends Transport
{

    /**
     * @param $recipient
     * @param $subjetc
     * @param $body
     * @param  \Patrones\Strategy\Mailer  $mailer
     *
     * @return bool|int
     */
    public function send($recipient, $subjetc, $body, Mailer $mailer)
    {
        $data = [
          'New Email',
          "Recipient: {$recipient}",
          "Subject: {$subjetc}",
          "Body: {$body}",
        ];

        return file_put_contents($mailer->filename, "\n\n" . implode("\n", $data), FILE_APPEND);
    }

}