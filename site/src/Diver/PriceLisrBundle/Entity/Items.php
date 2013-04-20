<?php

namespace Diver\PriceLisrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Diver\PriceLisrBundle\Entity\Categories;

/**
 * Items
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Diver\PriceLisrBundle\Entity\ItemsRepository")
 */
class Items
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
     * @var string
     *
     * @ORM\Column(name="fullname", type="text", nullable=true)
     */
    private $fullname;

    /**
     * @var string
     *
     * @ORM\Column(name="partnumber", type="string", length=255, nullable=true)
     */
    private $partnumber;

    /**
     * @var string
     *
     * @ORM\Column(name="manufacturer", type="string", length=255, nullable=true)
     */
    private $manufacturer;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer", nullable=true)
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="garant", type="integer", nullable=true)
     */
    private $garant;

    /**
     * @var integer
     *
     * @ORM\Column(name="ostatok_lviv", type="integer", nullable=true)
     */
    private $ostatok_lviv;

    /**
     * @var integer
     *
     * @ORM\Column(name="ostatok_kyyiv", type="integer", nullable=true)
     */
    private $ostatok_kyyiv;

    /**
     * @var integer
     *
     * @ORM\Column(name="ostatok_odesa", type="integer", nullable=true)
     */
    private $ostatok_odesa;

    /**
     * @ORM\ManyToOne(targetEntity="Categories", inversedBy="items")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;


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
     * @return Items
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
     * Set price
     *
     * @param integer $price
     * @return Items
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->category = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set name_ru
     *
     * @param string $nameRu
     * @return Items
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

    /**
     * Set fullname
     *
     * @param string $fullname
     * @return Items
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    
        return $this;
    }

    /**
     * Get fullname
     *
     * @return string 
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set partnumber
     *
     * @param string $partnumber
     * @return Items
     */
    public function setPartnumber($partnumber)
    {
        $this->partnumber = $partnumber;
    
        return $this;
    }

    /**
     * Get partnumber
     *
     * @return string 
     */
    public function getPartnumber()
    {
        return $this->partnumber;
    }

    /**
     * Set manufacturer
     *
     * @param string $manufacturer
     * @return Items
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    
        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return string 
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Set garant
     *
     * @param integer $garant
     * @return Items
     */
    public function setGarant($garant)
    {
        $this->garant = $garant;
    
        return $this;
    }

    /**
     * Get garant
     *
     * @return integer 
     */
    public function getGarant()
    {
        return $this->garant;
    }

    /**
     * Set ostatok_lviv
     *
     * @param integer $ostatokLviv
     * @return Items
     */
    public function setOstatokLviv($ostatokLviv)
    {
        $this->ostatok_lviv = $ostatokLviv;
    
        return $this;
    }

    /**
     * Get ostatok_lviv
     *
     * @return integer 
     */
    public function getOstatokLviv()
    {
        return $this->ostatok_lviv;
    }

    /**
     * Set ostatok_kyyiv
     *
     * @param integer $ostatokKyyiv
     * @return Items
     */
    public function setOstatokKyyiv($ostatokKyyiv)
    {
        $this->ostatok_kyyiv = $ostatokKyyiv;
    
        return $this;
    }

    /**
     * Get ostatok_kyyiv
     *
     * @return integer 
     */
    public function getOstatokKyyiv()
    {
        return $this->ostatok_kyyiv;
    }

    /**
     * Set ostatok_odesa
     *
     * @param integer $ostatokOdesa
     * @return Items
     */
    public function setOstatokOdesa($ostatokOdesa)
    {
        $this->ostatok_odesa = $ostatokOdesa;
    
        return $this;
    }

    /**
     * Get ostatok_odesa
     *
     * @return integer 
     */
    public function getOstatokOdesa()
    {
        return $this->ostatok_odesa;
    }

    /**
     * Set category
     *
     * @param \Diver\PriceLisrBundle\Entity\Categories $category
     * @return Items
     */
    public function setCategory(\Diver\PriceLisrBundle\Entity\Categories $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \Diver\PriceLisrBundle\Entity\Categories 
     */
    public function getCategory()
    {
        return $this->category;
    }
}