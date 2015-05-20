<?php

namespace Beelab\PhoneVerificationBundle\Event;

use Beelab\PhoneVerificationBundle\SMS\Exception;
use Symfony\Component\EventDispatcher\Event;

/**
 * Event related to SMS sending failure.
 */
class SMSEvent extends Event
{
    /**
     * @var Exception
     */
    protected $exception;

    /**
     * @param Exception $exception
     */
    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
    }

    /**
     * @return Exception
     */
    public function getException()
    {
        return $this->exception;
    }
}
