<?php

namespace KunicMarko\SimpleMenuBundle\Repository;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use KunicMarko\SimpleMenuBundle\Entity\Menu;
use KunicMarko\SimpleMenuBundle\Entity\MenuItem;
use Doctrine\ORM\Query;

/**
 * Class MenuItemRepository
 *
 * @package KunicMarko\SimpleMenuBundle\Repository
 */
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

    public function getTreeListByMenu(Menu $menu)
    {
        $queryBuilder = $this->getNodesHierarchyQueryBuilder();

        $queryBuilder
            ->where('node.menu = :menu')
            ->andWhere('node.parent IS NOT NULL')
            ->setParameter('menu', $menu);

        $result =  $queryBuilder
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

        return $this->buildTree($result);
    }
}
