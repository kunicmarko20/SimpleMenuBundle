<?php

namespace KunicMarko\SimpleMenuBundle\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Menu
 *
 * @package KunicMarko\SimpleMenuBundle\Entity
 */
class Menu
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $machineName;

    /**
     * @var ArrayCollection
     */
    private $menuItem;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Menu
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set Machine Name
     *
     * @param string $machineName
     * @return Menu
     */
    public function setMachineName($machineName)
    {
        $this->machineName = strtolower($machineName);

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getMachineName()
    {
        return $this->machineName;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->menuItem = new ArrayCollection();
    }

    /**
     * Add menuItem
     *
     * @param MenuItem $menuItem
     * @return Menu
     */
    public function addMenuItem(MenuItem $menuItem)
    {
        $menuItem->setMenu($this);
        $this->menuItem->add($menuItem);

        return $this;
    }

    /**
     * Remove menuItem
     *
     * @param MenuItem $menuItem
     */
    public function removeMenuItem(MenuItem $menuItem)
    {
        $this->menuItem->removeElement($menuItem);
    }

    /**
     * Get menuItem
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenuItem()
    {
        return $this->menuItem;
    }

    public function addFirstMenuChild()
    {
        if ($this->menuItem->count() === 0) {
            $menuItem = new MenuItem();
            $menuItem->setTitle($this->title);
            $this->addMenuItem($menuItem);
        }
    }

    public function __toString()
    {
        return $this->title === null ? 'Menu' : $this->title;
    }
}
