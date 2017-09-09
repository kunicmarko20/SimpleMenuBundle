<?php
/**
 * Created by PhpStorm.
 * User: Marko Kunic
 * Date: 8/18/17
 * Time: 6:49 PM.
 */

namespace KunicMarko\SimpleMenuBundle\Validator\Constraints;

use KunicMarko\SimpleMenuBundle\Entity\MenuItem;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class DisabledPathValidator.
 */
class DisabledPathValidator extends ConstraintValidator
{
    /**
     * @param Menuitem   $menuItem
     * @param Constraint $constraint
     */
    public function validate($menuItem, Constraint $constraint)
    {
        if (!$menuItem->isDisabled() && $menuItem->getPath() === null) {
            $this->context->buildViolation($constraint->message)
                ->atPath('path')
                ->addViolation();
        }
    }
}
