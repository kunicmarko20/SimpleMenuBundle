<?php

namespace KunicMarko\SimpleMenuBundle\Repository;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use KunicMarko\SimpleMenuBundle\Entity\Menu;
use KunicMarko\SimpleMenuBundle\Entity\MenuItem;

class MenuItemRepository extends NestedTreeRepository
{
    public function getChildrenOfMenu(Menu $menu)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder()
            ->select('mi')
            ->from(MenuItem::class, 'mi')
            ->where('mi.menu = :menu')
            ->setParameter('menu', $menu);

        return $queryBuilder;
    }

    public function getTreeListByMenu($menu, $level)
    {
        $queryBuilder = $this->getNodesHierarchyQueryBuilder();

        /**
         * Need to think about this part with joins, maybe remove it/find a better option
         * Maybe go with some caching
         */
        $queryBuilder
            ->leftJoin('node.children', 'c1')
            ->addSelect('c1');

        for ($i = 1; $i < $level;) {
            $queryBuilder
                ->leftJoin('c' . $i . '.children', 'c' . ++$i)
                ->addSelect('c' . $i);
        }

        $queryBuilder
            ->where('node.menu = :menu')
            ->andWhere('node.parent IS NOT NULL')
            ->andWhere('node.lvl = 1')
            ->setParameter('menu', $menu)
        ;

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }
}
