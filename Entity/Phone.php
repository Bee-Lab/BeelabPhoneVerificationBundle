<?php

namespace Beelab\PhoneVerificationBundle\Entity;

use Beelab\PhoneVerificationBundle\Validator\Constraints as PhoneAssert;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Phone.
 *
 * @ORM\MappedSuperclass
 * @PhoneAssert\Code()
 */
abstract class Phone
{
    const VERIFY_STARTED  = 1;
    const VERIFY_FINISHED = 2;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(length=16, unique=true)
     * @Assert\Length(min=7, max=16)
     */
    protected $number;

    /**
     * @var string
     *
     * @ORM\Column(length=6)
     * @Assert\Length(min=6, max=6)
     */
    protected $code;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", options={"default": 0})
     */
    protected $verified = false;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     * @Assert\Date()
     */
    protected $started;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\Date()
     */
    protected $finished;

    /**
     * Constructor.
     *
     * @param string $number
     */
    public function __construct($number)
    {
        $this->instance($number);
    }

    /**
     * @param string $number
     */
    public function instance($number)
    {
        $this->number = $number;
        $this->started = new DateTime();
        $this->code = substr(str_shuffle('0123456789'), 0, 6);
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param bool
     *
     * @return Phone
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * @return bool
     */
    public function isVerified()
    {
        return $this->verified;
    }

    /**
     * @return DateTime
     */
    public function getStarted()
    {
        return $this->started;
    }

    /**
     * @param DateTime
     *
     * @return Finished
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getCodeMessage()
    {
        return 'Verification code: '.$this->code;
    }
}
