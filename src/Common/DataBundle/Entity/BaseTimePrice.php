<?php
// src/Common/DataBundle/Entity/Product.php
namespace Common\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 
 */
class BaseTimePrice
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
     * @var decimal $local_price
     *
     * @ORM\Column(name="local_price", type="decimal", scale=2)
     */
    protected $local_price;

    /**
     * @var decimal $currency_price
     *
     * @ORM\Column(name="currency_price", type="decimal", scale=2)
     */
    protected $currency_price;

    /**
     * @var decimal $currency_rate
     *
     * @ORM\Column(name="currency_rate", type="decimal", scale=2)
     */
    protected $currency_rate;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set local_price
     *
     * @param float $localPrice
     * @return BaseTimePrice
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
     * @return BaseTimePrice
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
     * @return BaseTimePrice
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
     * Set price_date
     *
     * @param \DateTime $priceDate
     * @return BaseTimePrice
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
     * @return BaseTimePrice
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
     * @return BaseTimePrice
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
}