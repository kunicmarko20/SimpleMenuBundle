<?php

namespace KunicMarko\SimpleMenuBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class MenuItem
 * @package KunicMarko\SimpleMenuBundle\Entity
 * @ORM\Entity()
 * @ORM\Table(name="simple_menu_item")
 */

class MenuItem
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Title cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Url cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="menuItem")
     */
    private $menu;

    /**
     * @ORM\ManyToOne(targetEntity="MenuItem", inversedBy="children")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="MenuItem", mappedBy="parent")
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
        $this->path = $path;

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
        $this->children[] = $children;

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
}
