<?php

namespace KunicMarko\SimpleMenuBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MenuScope extends Constraint
{
    public $message = 'simple_menu.constraint.menu_scope';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    public function validatedBy()
    {
        return MenuScopeValidator::class;
    }
}
