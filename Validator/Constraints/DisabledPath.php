<?php

namespace KunicMarko\SimpleMenuBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DisabledPath extends Constraint
{
    public $message = 'simple_menu.constraint.disabled_path';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    public function validatedBy()
    {
        return DisabledPathValidator::class;
    }
}
