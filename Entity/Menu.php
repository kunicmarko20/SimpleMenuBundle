<?php

namespace KunicMarko\SimpleMenuBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Menu
 * @package KunicMarko\SimpleMenuBundle\Entity
 * @ORM\Entity()
 * @UniqueEntity(fields="title", message="Title is already taken.")
 * @ORM\Table(name="simple_menu")
 */

class Menu
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
     * @ORM\OneToMany(targetEntity="MenuItem", mappedBy="menu", cascade={"persist","remove"}, orphanRemoval=true)
     **/
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
}
