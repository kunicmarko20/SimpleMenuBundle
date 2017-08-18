<?php

namespace KunicMarko\SimpleMenuBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MenuScope extends Constraint
{
    public $message = 'Parent must be in {{ menu }} menu scope.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    public function validatedBy()
    {
        return MenuScopeValidator::class;
    }
}
