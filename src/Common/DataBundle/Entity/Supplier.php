<?php

namespace Common\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Common\DataBundle\Entity\Product;
use Common\DataBundle\Entity\TimePrice;
use Common\DataBundle\Entity\SaleTimePrice;

/**
 * Common\DataBundle\Entity\Supplier
 *
 * @ORM\Table(name="supplier")
 * @ORM\Entity(repositoryClass="Common\DataBundle\Entity\SupplierRepository")
 */
class Supplier
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string $address
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var Product $products
     *
     * @ORM\OneToMany(targetEntity="Product", mappedBy="supplier")
     */
    protected $products;

    /**
     * @var TimePrice $time_prices
     *
     * @ORM\OneToMany(targetEntity="TimePrice", mappedBy="supplier")
     */
    protected $time_prices;

    /**
     * @var SaleTimePrice $sale_time_prices
     *
     * @ORM\OneToMany(targetEntity="SaleTimePrice", mappedBy="supplier")
     */
    protected $sale_time_prices;

    /**
     * Return name of supplier
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
        $this->time_prices = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * @return Supplier
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
     * Set address
     *
     * @param string $address
     * @return Supplier
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Supplier
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add products
     *
     * @param Common\DataBundle\Entity\Product $products
     * @return Supplier
     */
    public function addProduct(\Common\DataBundle\Entity\Product $products)
    {
        $this->products[] = $products;
    
        return $this;
    }

    /**
     * Remove products
     *
     * @param Common\DataBundle\Entity\Product $products
     */
    public function removeProduct(\Common\DataBundle\Entity\Product $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Add time_prices
     *
     * @param Common\DataBundle\Entity\TimePrice $timePrices
     * @return Supplier
     */
    public function addTimePrice(\Common\DataBundle\Entity\TimePrice $timePrices)
    {
        $this->time_prices[] = $timePrices;
    
        return $this;
    }

    /**
     * Remove time_prices
     *
     * @param Common\DataBundle\Entity\TimePrice $timePrices
     */
    public function removeTimePrice(\Common\DataBundle\Entity\TimePrice $timePrices)
    {
        $this->time_prices->removeElement($timePrices);
    }

    /**
     * Get time_prices
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTimePrices()
    {
        return $this->time_prices;
    }

    /**
     * Add sale_time_prices
     *
     * @param Common\DataBundle\Entity\SaleTimePrice $saleTimePrices
     * @return Supplier
     */
    public function addSaleTimePrice(\Common\DataBundle\Entity\SaleTimePrice $saleTimePrices)
    {
        $this->sale_time_prices[] = $saleTimePrices;
    
        return $this;
    }

    /**
     * Remove sale_time_prices
     *
     * @param Common\DataBundle\Entity\SaleTimePrice $saleTimePrices
     */
    public function removeSaleTimePrice(\Common\DataBundle\Entity\SaleTimePrice $saleTimePrices)
    {
        $this->sale_time_prices->removeElement($saleTimePrices);
    }

    /**
     * Get sale_time_prices
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSaleTimePrices()
    {
        return $this->sale_time_prices;
    }
}