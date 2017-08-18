<?php

namespace KunicMarko\SimpleMenuBundle\Repository;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use KunicMarko\SimpleMenuBundle\Entity\Menu;
use KunicMarko\SimpleMenuBundle\Entity\MenuItem;

class MenuItemRepository extends NestedTreeRepository
{
    public function getChildrenOfMenu(Menu $menu)
    {
        $qb = $this->getEntityManager()->createQueryBuilder()
            ->select('mi')
            ->from(MenuItem::class, 'mi')
            ->where('mi.menu = :menu')
            ->setParameter('menu', $menu);

        return $qb;
    }
}
