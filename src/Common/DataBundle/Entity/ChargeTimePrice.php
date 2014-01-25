<?php

namespace Common\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Common\DataBundle\Entity\BaseTimePrice;
use Common\DataBundle\Entity\Charge;

/**
 * @ORM\Table(name="charge_time_price")
 * @ORM\Entity()
 */
class ChargeTimePrice extends BaseTimePrice
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
     * @var Common\DataBundle\Entity\Charge $charge
     *
     * @ORM\ManyToOne(targetEntity="Charge", inversedBy="charge_time_prices")
     * @ORM\JoinColumn(name="charge_id", referencedColumnName="id", onDelete="set null")
     */
    protected $charge;

    /**
     * @var decimal $quantity
     *
     * @ORM\Column(name="quantity", type="decimal", scale=2)
     */
    protected $quantity;

    /**
     * @var decimal $local_price
     *
     * @ORM\Column(name="local_price", type="decimal", scale=2)
     */
    protected $local_price;

    /**
     * @var decimal $buy_amount
     *
     * @ORM\Column(name="buy_amount", type="decimal", scale=2)
     */
    protected $buy_amount;

    /**
     * @var string $price_date
     *
     * @ORM\Column(name="price_date", type="datetime")
     */
    protected $price_date;

    /**
     * @var string $created_at
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $created_at;

    /**
     * @var string $updated_at
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updated_at;

    /**
     * @var float $currency_price
     */
    protected $currency_price;

    /**
     * @var float $currency_rate
     */
    protected $currency_rate;


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
     * Set quantity
     *
     * @param float $quantity
     * @return ChargeTimePrice
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    
        return $this;
    }

    /**
     * Get quantity
     *
     * @return float 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set buy_price
     *
     * @param float $buyPrice
     * @return ChargeTimePrice
     */
    public function setBuyPrice($buyPrice)
    {
        $this->buy_price = $buyPrice;
    
        return $this;
    }

    /**
     * Get buy_price
     *
     * @return float 
     */
    public function getBuyPrice()
    {
        return $this->buy_price;
    }

    /**
     * Set buy_amount
     *
     * @param float $buyAmount
     * @return ChargeTimePrice
     */
    public function setBuyAmount($buyAmount)
    {
        $this->buy_amount = $buyAmount;
    
        return $this;
    }

    /**
     * Get buy_amount
     *
     * @return float 
     */
    public function getBuyAmount()
    {
        return $this->buy_amount;
    }

    /**
     * Set price_date
     *
     * @param \DateTime $priceDate
     * @return ChargeTimePrice
     */
    public function setPriceDate($priceDate)
    {
        $this->price_date = $priceDate;
    
        return $this;
    }

    /**
     * Get price_date
     *
     * @return \DateTime 
     */
    public function getPriceDate()
    {
        return $this->price_date;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return ChargeTimePrice
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return ChargeTimePrice
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set local_price
     *
     * @param float $localPrice
     * @return ChargeTimePrice
     */
    public function setLocalPrice($localPrice)
    {
        $this->local_price = $localPrice;
    
        return $this;
    }

    /**
     * Get local_price
     *
     * @return float 
     */
    public function getLocalPrice()
    {
        return $this->local_price;
    }

    /**
     * Set currency_price
     *
     * @param float $currencyPrice
     * @return ChargeTimePrice
     */
    public function setCurrencyPrice($currencyPrice)
    {
        $this->currency_price = $currencyPrice;
    
        return $this;
    }

    /**
     * Get currency_price
     *
     * @return float 
     */
    public function getCurrencyPrice()
    {
        return $this->currency_price;
    }

    /**
     * Set currency_rate
     *
     * @param float $currencyRate
     * @return ChargeTimePrice
     */
    public function setCurrencyRate($currencyRate)
    {
        $this->currency_rate = $currencyRate;
    
        return $this;
    }

    /**
     * Get currency_rate
     *
     * @return float 
     */
    public function getCurrencyRate()
    {
        return $this->currency_rate;
    }

    /**
     * Set charge
     *
     * @param Common\DataBundle\Entity\Charge $charge
     * @return ChargeTimePrice
     */
    public function setCharge(\Common\DataBundle\Entity\Charge $charge = null)
    {
        $this->charge = $charge;
    
        return $this;
    }

    /**
     * Get charge
     *
     * @return Common\DataBundle\Entity\Charge 
     */
    public function getCharge()
    {
        return $this->charge;
    }
}