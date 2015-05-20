<?php

namespace Beelab\PhoneVerificationBundle\SMS\Adapter;

use Beelab\PhoneVerificationBundle\SMS\Exception;
use Beelab\PhoneVerificationBundle\SMS\SenderInterface;
use Zen\Bundle\SkebbyBundle\Util\Skebby;

/**
 * Adapter for Skebby.
 */
class SkebbyAdapter implements SenderInterface
{
    /**
     * @var Skebby
     */
    private $skebby;

    /**
     * @param Skebby $skebby
     */
    public function __construct(Skebby $skebby)
    {
        $this->skebby = $skebby;
    }

    /**
     * {@inheritdoc}
     */
    public function send($recipient, $text)
    {
        $array = $this->skebby->sendSMS([$recipient], $text);
        if ($this->skebby->isResultError($array)) {
            throw new Exception($this->skebby->getResultErrorMessage($array));
        }
    }
}
