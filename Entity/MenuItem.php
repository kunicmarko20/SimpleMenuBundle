<?php

namespace KunicMarko\SimpleMenuBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class MenuItem
 *
 * @package KunicMarko\SimpleMenuBundle\Entity
 */
class MenuItem
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
    private $path;

    /**
     * @var Menu
     */
    private $menu;

    /**
     * @var integer
     */
    private $lft;

    /**
     * @var integer
     */
    private $lvl;

    /**
     * @var integer
     */
    private $rgt;

    /**
     * @var MenuItem
     */
    private $root;

    /**
     * @var MenuItem
     */
    private $parent;

    /**
     * @var ArrayCollection
     */
    private $children;

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
     * @return MenuItem
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
     * Set path
     *
     * @param string $path
     * @return MenuItem
     */
    public function setPath($path)
    {
        $this->path = '/' . ltrim($path, '/');

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    /**
     * Set menu
     *
     * @param Menu $menu
     * @return MenuItem
     */
    public function setMenu(Menu $menu = null)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set parent
     *
     * @param MenuItem $parent
     * @return MenuItem
     */
    public function setParent(MenuItem $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return MenuItem
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param MenuItem $children
     * @return MenuItem
     */
    public function addChild(MenuItem $children)
    {
        $children->setParent($this);
        $this->children->add($children);

        return $this;
    }

    /**
     * Remove children
     *
     * @param MenuItem $children
     */
    public function removeChild(MenuItem $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    public function __toString()
    {
        return $this->title === null ? 'Menu Item' : $this->title;
    }

    /**
     * Set lft
     *
     * @param integer $lft
     * @return MenuItem
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft
     *
     * @return integer
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     * @return MenuItem
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     * @return MenuItem
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set root
     *
     * @param MenuItem $root
     * @return MenuItem
     */
    public function setRoot(MenuItem $root = null)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Get root
     *
     * @return MenuItem
     */
    public function getRoot()
    {
        return $this->root;
    }
}
