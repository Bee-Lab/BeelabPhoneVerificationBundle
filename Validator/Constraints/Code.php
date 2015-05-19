<?php

namespace Beelab\PhoneVerificationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Code constraint.
 *
 * @Annotation
 */
class Code extends Constraint
{
    public $message = 'Invalid code.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    public function validatedBy()
    {
        return 'beelab_verify_code';
    }
}
