<?php

namespace KunicMarko\SimpleMenuBundle\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Menu
 * @package KunicMarko\SimpleMenuBundle\Entity
 * @ORM\Entity()
 * @UniqueEntity(fields="machineName", message="Machine Name is already taken.")
 * @UniqueEntity(fields="title", message="Title is already taken.")
 * @ORM\Table(name="simple_menu")
 * @ORM\HasLifecycleCallbacks()
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
     * @var string
     * @Assert\Regex("/^[a-zA-Z0-9_]+$/")
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Machine Name cannot be longer than {{ limit }} characters"
     * )
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $machineName;

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


    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function onPersistUpdate()
    {
        if ($this->machineName === null) {
            $slugify = new Slugify();
            $this->machineName = $slugify->slugify($this->title);
        }

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
