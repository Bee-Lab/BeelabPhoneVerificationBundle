<?php

namespace Beelab\PhoneVerificationBundle\Event;

use Beelab\PhoneVerificationBundle\Entity\Phone;
use Symfony\Component\EventDispatcher\Event;

/**
 * Phone-related event.
 */
class PhoneEvent extends Event
{
    /**
     * @var Phone
     */
    protected $phone;

    /**
     * @param Phone $phone
     */
    public function __construct(Phone $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return Phone
     */
    public function getPhone()
    {
        return $this->phone;
    }
}
