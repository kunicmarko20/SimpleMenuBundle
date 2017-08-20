<?php

namespace KunicMarko\SimpleMenuBundle\Admin;

use KunicMarko\SimpleMenuBundle\Entity\MenuItem;
use KunicMarko\SimpleMenuBundle\Repository\MenuItemRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MenuItemAdmin extends AbstractAdmin
{

    protected $parentAssociationMapping = 'menu';

    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by'    => 'p.root, p.lft'
    );

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', 'string', array(
                'template' => 'SimpleMenuBundle:CRUD:list_field_indented_tree_node_identifier.html.twig'
            ))
            ->add('path', 'url', ['label' => 'URL'])
            ->add('_action', null, array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                ),
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $object = $this->getSubject();

        $formMapper
            ->add('title')
            ->add('path')
            ->add('parent', EntityType::class, [
                'class' => MenuItem::class,
                'query_builder' => function (MenuItemRepository $mir) use ($object) {
                    return $mir->getChildrenOfMenu($object->getMenu());
                }
            ])
        ;
    }

    /**
     * @param string $context
     * @return ProxyQuery
     */
    public function createQuery($context = 'list')
    {
        $proxyQuery = parent::createQuery('list');

        $proxyQuery
            ->where('o.parent IS NOT NULL');
        ;

        return $proxyQuery;
    }

    /**
     * @param string $name
     * @return string
     */
    public function getTemplate($name)
    {
        if ($name === 'list') {
            return 'SimpleMenuBundle:CRUD:list.html.twig';
        }

        return parent::getTemplate($name);
    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);

        $collection->add('tree_up', $this->getRouterIdParameter().'/up');
        $collection->add('tree_down', $this->getRouterIdParameter().'/down');
    }
}
