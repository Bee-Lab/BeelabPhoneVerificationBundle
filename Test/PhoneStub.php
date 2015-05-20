<?php

namespace Beelab\PhoneVerificationBundle\Test;

use Beelab\PhoneVerificationBundle\Entity\Phone;

/**
 * PhoneStub
 */
class PhoneStub extends Phone
{
    public function __construct($number)
    {
        parent::__construct($number);
        $this->id = 42;
    }
}
