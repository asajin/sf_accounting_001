<?php

namespace Common\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Common\DataBundle\Entity\ChargeTimePrice;

/**
 * @ORM\Table(name="charge")
 * @ORM\Entity()
 */
class Charge
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
     * @ORM\ManyToOne(targetEntity="Supplier", inversedBy="charges")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id", onDelete="set null")
     */
    protected $supplier;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    protected $name;

    /**
     * @var decimal $last_local_price
     *
     * @ORM\Column(name="last_local_price", type="decimal", scale=2)
     */
    protected $last_buy_price;

    /**
     * @var decimal $last_quantity
     *
     * @ORM\Column(name="last_quantity", type="decimal", scale=2)
     */
    protected $last_quantity;

    /**
     * @var date $last_add_date
     *
     * @ORM\Column(name="last_add_date", type="date")
     */
    protected $last_add_date;

    /**
     * @var Common\DataBundle\Entity\Unit $unit
     *
     * @ORM\ManyToOne(targetEntity="Unit", inversedBy="charges")
     * @ORM\JoinColumn(name="unit_id", referencedColumnName="id", onDelete="set null")
     */
    protected $unit;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @var ChargeTimePrice $charge_time_prices
     *
     * @ORM\OneToMany(targetEntity="ChargeTimePrice", mappedBy="charge")
     */
    protected $charge_time_prices;

    /**
     * Return name of charge
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
        $this->charge_time_prices = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Charge
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
     * Set last_buy_price
     *
     * @param float $lastBuyPrice
     * @return Charge
     */
    public function setLastBuyPrice($lastBuyPrice)
    {
        $this->last_buy_price = $lastBuyPrice;
    
        return $this;
    }

    /**
     * Get last_buy_price
     *
     * @return float 
     */
    public function getLastBuyPrice()
    {
        return $this->last_buy_price;
    }

    /**
     * Set last_quantity
     *
     * @param float $lastQuantity
     * @return Charge
     */
    public function setLastQuantity($lastQuantity)
    {
        $this->last_quantity = $lastQuantity;
    
        return $this;
    }

    /**
     * Get last_quantity
     *
     * @return float 
     */
    public function getLastQuantity()
    {
        return $this->last_quantity;
    }

    /**
     * Set last_add_date
     *
     * @param \DateTime $lastAddDate
     * @return Charge
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
     * Set description
     *
     * @param string $description
     * @return Charge
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
     * @return Charge
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
     * Set unit
     *
     * @param Common\DataBundle\Entity\Unit $unit
     * @return Charge
     */
    public function setUnit(\Common\DataBundle\Entity\Unit $unit = null)
    {
        $this->unit = $unit;
    
        return $this;
    }

    /**
     * Get unit
     *
     * @return Common\DataBundle\Entity\Unit 
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Add charge_time_prices
     *
     * @param Common\DataBundle\Entity\ChargeTimePrice $chargeTimePrices
     * @return Charge
     */
    public function addChargeTimePrice(\Common\DataBundle\Entity\ChargeTimePrice $chargeTimePrices)
    {
        $this->charge_time_prices[] = $chargeTimePrices;
    
        return $this;
    }

    /**
     * Remove charge_time_prices
     *
     * @param Common\DataBundle\Entity\ChargeTimePrice $chargeTimePrices
     */
    public function removeChargeTimePrice(\Common\DataBundle\Entity\ChargeTimePrice $chargeTimePrices)
    {
        $this->charge_time_prices->removeElement($chargeTimePrices);
    }

    /**
     * Get charge_time_prices
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChargeTimePrices()
    {
        return $this->charge_time_prices;
    }
}