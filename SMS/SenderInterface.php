<?php

namespace Beelab\PhoneVerificationBundle\SMS;

interface SenderInterface
{
    /**
     * @param string $recipient
     * @param string $text
     */
    public function send($recipient, $text);
}
