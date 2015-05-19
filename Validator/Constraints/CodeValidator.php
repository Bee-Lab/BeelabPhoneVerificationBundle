<?php

namespace Beelab\PhoneVerificationBundle\Validator\Constraints;

use Beelab\PhoneVerificationBundle\Manager\PhoneManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Code validator.
 */
class CodeValidator extends ConstraintValidator
{
    /**
     * @var PhoneManager
     */
    private $manager;

    /**
     * @param PhoneManager $manager
     */
    public function __construct(PhoneManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param array      $data
     * @param Constraint $constraint
     */
    public function validate($data, Constraint $constraint)
    {
        if (!isset($data['number']) || !isset($data['code'])) {
            throw new \RuntimeException('Missing data.');
        }
        if (!$this->manager->verify($data['number'], $data['code'])) {
            $this->context->addViolationAt('code', $constraint->message);
        }
    }
}
