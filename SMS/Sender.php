<?php

namespace Beelab\PhoneVerificationBundle\SMS;

class Sender
{
    /**
     * @var SenderInterface
     */
    private $adapter;

    /**
     * @param SenderInterface $adapter
     */
    public function __construct(SenderInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param string $recipient
     * @param string $text
     */
    public function send($recipient, $text)
    {
        $this->adapter->send($recipient, $text);
    }
}
