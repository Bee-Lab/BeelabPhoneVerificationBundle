<?php

namespace Beelab\PhoneVerificationBundle\SMS;

interface SenderInterface
{
    /**
     * @param string $recipient
     * @param string $text
     *
     * @throws Exception
     */
    public function send($recipient, $text);
}
