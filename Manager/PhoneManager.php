<?php

namespace Beelab\PhoneVerificationBundle\Manager;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * Manages phone entities.
 */
class PhoneManager
{
    /**
     * @var ObjectManager
     */
    protected $manager;

    /**
     * @var string
     */
    protected $className;

    /**
     * @param ObjectManager $manager
     * @param string        $className
     */
    public function __construct(ObjectManager $manager, $className)
    {
        $this->manager = $manager;
        $this->className = $className;
    }

    /**
     * Find a phone by its number.
     *
     * @param string $number
     *
     * @return mixed
     */
    public function find($number)
    {
        return $this->manager->getRepository($this->className)->findOneByNumber($number);
    }

    /**
     * Verify that a given code is matching a phone's code.
     *
     * @param string $number
     * @param string $code
     *
     * @return bool
     */
    public function verify($number, $code)
    {
        $phone = $this->manager->getRepository($this->className)->findOneByNumber($number);
        if (is_null($phone) || $phone->getCode() !== $code) {
            return false;
        }

        return true;
    }

    /**
     * Save Phone.
     *
     * @param Phone $phone
     * @param bool  $andFlush
     */
    public function save($phone, $andFlush = true)
    {
        $phone->setVerified(true)->setFinished(new \DateTime());
        if ($andFlush) {
            $this->manager->flush();
        }
    }

    /**
     * Create a phone.
     *
     * @param string $number
     * @param bool   $andFlush
     *
     * @return mixed
     */
    public function create($number, $andFlush = true)
    {
        $phone = $this->manager->getRepository($this->className)->findOneByNumber($number);
        if (is_null($phone)) {
            $phone = new $this->className($number);
            $this->manager->persist($phone);
        } else {
            $phone->instance($number);
        }
        if ($andFlush) {
            $this->manager->flush();
        }

        return $phone;
    }
}
