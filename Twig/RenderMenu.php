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

/**
 * Class RenderMenu
 *
 * @package KunicMarko\SimpleMenuBundle\Twig
 */
class RenderMenu extends \Twig_Extension
{
    private $menuItemRepository;
    private $menuRepository;
    /** @var string */
    private $renderTemplate;

    public function __construct(EntityManager $entityManager, $renderTemplate)
    {
        $this->menuItemRepository = $entityManager->getRepository(MenuItem::class);
        $this->menuRepository = $entityManager->getRepository(Menu::class);
        $this->renderTemplate = $renderTemplate;
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

    /**
     * @param $machineName
     * @param int $level
     * @return mixed
     */
    public function fetchMenu($machineName, $level = 1)
    {
        $menu = $this->menuRepository->findOneBy(['machineName' => $machineName]);

        return $this->menuItemRepository->getTreeListByMenu($menu, $level);
    }

    /**
     * @param \Twig_Environment $environment
     * @param $machineName
     * @param int $level
     * @return string
     */
    public function renderMenu(\Twig_Environment $environment, $machineName, $level = 1)
    {
        $menuItems = $this->fetchMenu($machineName, $level);

        return $environment->render(
            $this->renderTemplate,
            ['items' => $menuItems]
        );
    }
}
