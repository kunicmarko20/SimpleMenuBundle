<?php
/**
 * Created by PhpStorm.
 * User: Marko Kunic
 * Date: 8/20/17
 * Time: 4:43 PM
 */

namespace KunicMarko\SimpleMenuBundle\Twig;

use Doctrine\ORM\EntityManager;
use KunicMarko\SimpleMenuBundle\Entity\Menu;
use KunicMarko\SimpleMenuBundle\Entity\MenuItem;

class RenderMenu extends \Twig_Extension
{
    private $menuItemRepository;
    private $menuRepository;

    public function __construct(EntityManager $entityManager)
    {
        $this->menuItemRepository = $entityManager->getRepository(MenuItem::class);
        $this->menuRepository = $entityManager->getRepository(Menu::class);
    }

    public function getName()
    {
        return 'simple_menu.render_menu.twig';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'simple_menu_render',
                [$this, 'renderMenu'],
                ['needs_environment' => true, 'is_safe' => ['html']]
            ),
            new \Twig_SimpleFunction(
                'simple_menu_fetch',
                [$this, 'fetchMenu']
            ),
        ];
    }

    public function fetchMenu($machineName)
    {
        $menu = $this->menuRepository->findOneBy(['machineName' => $machineName]);

        return $this->menuItemRepository->getTreeListByMenu($menu);
    }

    public function renderMenu(\Twig_Environment $environment, $machineName, $level = 1)
    {
        $menuItems = $this->fetchMenu($machineName);

        return $environment->render(
            'SimpleMenuBundle:Menu:render.html.twig',
            [
                'items' => $menuItems,
                'level' => $level
            ]
        );
    }
}
