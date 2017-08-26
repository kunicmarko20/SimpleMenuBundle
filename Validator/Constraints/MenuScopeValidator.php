<?php
/**
 * Created by PhpStorm.
 * User: Marko Kunic
 * Date: 8/18/17
 * Time: 6:49 PM
 */

namespace KunicMarko\SimpleMenuBundle\Validator\Constraints;

use KunicMarko\SimpleMenuBundle\Entity\MenuItem;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

/**
 * Class MenuScopeValidator
 *
 * @package KunicMarko\SimpleMenuBundle\Validator\Constraints
 */
class MenuScopeValidator extends ConstraintValidator
{
    /**
     * @param Menuitem $menuItem
     * @param Constraint $constraint
     */
    public function validate($menuItem, Constraint $constraint)
    {
        $parent = $menuItem->getParent();

        if ($menuItem->getMenu() !== $parent->getMenu()) {
            $this->context->buildViolation($constraint->message)
                ->atPath('parent')
                ->setParameter('%menu%', (string)$menuItem->getMenu())
                ->addViolation();
        }
    }
}
