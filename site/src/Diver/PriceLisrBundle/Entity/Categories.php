<?php

namespace Diver\PriceLisrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Diver\PriceLisrBundle\Entity\Items;

/**
 * Categories
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Diver\PriceLisrBundle\Entity\CategoriesRepository")
 */
class Categories
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="name_ru", type="string", length=255)
     */
    private $name_ru;

    /**
     * @ORM\OneToMany(targetEntity="Categories", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="Categories", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Items", mappedBy="category")
     */
    private $items;

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
     * Set name
     *
     * @param string $name
     * @return Categories
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add children
     *
     * @param \Diver\PriceLisrBundle\Entity\Categories $children
     * @return Categories
     */
    public function addChildren(\Diver\PriceLisrBundle\Entity\Categories $children)
    {
        if($children == $this)
            throw new \Exception('Operation not allowed');
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \Diver\PriceLisrBundle\Entity\Categories $children
     */
    public function removeChildren(\Diver\PriceLisrBundle\Entity\Categories $children)
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

    /**
     * Set parent
     *
     * @param \Diver\PriceLisrBundle\Entity\Categories $parent
     * @return Categories
     */
    public function setParent(\Diver\PriceLisrBundle\Entity\Categories $parent = null)
    {
        if($parent == $this)
            throw new \Exception('Operation not allowed');
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \Diver\PriceLisrBundle\Entity\Categories 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set name_ru
     *
     * @param string $nameRu
     * @return Categories
     */
    public function setNameRu($nameRu)
    {
        $this->name_ru = $nameRu;
    
        return $this;
    }

    /**
     * Get name_ru
     *
     * @return string 
     */
    public function getNameRu()
    {
        return $this->name_ru;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Add items
     *
     * @param \Diver\PriceLisrBundle\Entity\Items $items
     * @return Categories
     */
    public function addItem(\Diver\PriceLisrBundle\Entity\Items $items)
    {
        $this->items[] = $items;
    
        return $this;
    }

    /**
     * Remove items
     *
     * @param \Diver\PriceLisrBundle\Entity\Items $items
     */
    public function removeItem(\Diver\PriceLisrBundle\Entity\Items $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }
}