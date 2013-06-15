<?php
// src/Common/DataBundle/Entity/Product.php
namespace Common\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Common\DataBundle\Entity\Supplier;
use Common\DataBundle\Entity\TimePrice;

/**
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="Common\DataBundle\Entity\ProductRepository")
 */
class Product
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Common\DataBundle\Entity\Supplier $supplier
     *
     * @ORM\ManyToOne(targetEntity="Supplier", inversedBy="products")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id")
     */
    protected $supplier;

    /**
     * @var string $code
     *
     * @ORM\Column(name="code", type="string", length=100)
     */
    protected $code;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    protected $name;

    /**
     * @var decimal $last_price
     *
     * @ORM\Column(name="last_price", type="decimal", scale=2)
     */
    protected $last_price;

    /**
     * @var decimal $last_stock
     *
     * @ORM\Column(name="last_stock", type="decimal", scale=2)
     */
    protected $last_stock;

    /**
     * @var date $last_add_date
     *
     * @ORM\Column(name="last_add_date", type="date")
     */
    protected $last_add_date;

    /**
     * @var string $unit
     *
     * @ORM\Column(name="unit", type="string", length=15)
     */
    protected $unit;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @var TimePrice $time_prices
     *
     * @ORM\OneToMany(targetEntity="TimePrice", mappedBy="product")
     */
    protected $time_prices;

    /**
     * Return name of product
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
     * Set code
     *
     * @param string $code
     * @return Product
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Product
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
     * Set last_price
     *
     * @param float $lastPrice
     * @return Product
     */
    public function setLastPrice($lastPrice)
    {
        $this->last_price = $lastPrice;

        return $this;
    }

    /**
     * Get last_price
     *
     * @return float
     */
    public function getLastPrice()
    {
        return $this->last_price;
    }

    /**
     * Set last_stock
     *
     * @param float $lastStock
     * @return Product
     */
    public function setLastStock($lastStock)
    {
        $this->last_stock = $lastStock;

        return $this;
    }

    /**
     * Get last_stock
     *
     * @return float
     */
    public function getLastStock()
    {
        return $this->last_stock;
    }

    /**
     * Set last_add_date
     *
     * @param \DateTime $lastAddDate
     * @return Product
     */
    public function setLastAddDate($lastAddDate)
    {
        $this->last_add_date = $lastAddDate;

        return $this;
    }

    /**
     * Get last_add_date
     *
     * @return \DateTime
     */
    public function getLastAddDate()
    {
        return $this->last_add_date;
    }

    /**
     * Set unit
     *
     * @param string $unit
     * @return Product
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Product
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
     * Set supplier
     *
     * @param Common\DataBundle\Entity\Supplier $supplier
     * @return Product
     */
    public function setSupplier(\Common\DataBundle\Entity\Supplier $supplier = null)
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * Get supplier
     *
     * @return Common\DataBundle\Entity\Supplier
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

    /**
     * Add time_prices
     *
     * @param Common\DataBundle\Entity\TimePrice $timePrices
     * @return Product
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
}