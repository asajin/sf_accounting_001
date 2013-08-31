<?php
// src/Common/DataBundle/Entity/Product.php
namespace Common\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Common\DataBundle\Entity\BaseTimePrice;
use Common\DataBundle\Entity\Product;

/**
 * @ORM\Table(name="sale_time_price")
 * @ORM\Entity()
 */
class SaleTimePrice extends BaseTimePrice
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
     * @var Common\DataBundle\Entity\Product $product
     *
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="sale_time_prices")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;

    /**
     * @var Common\DataBundle\Entity\Customer $customer
     *
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="sale_time_prices")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    protected $customer;

    /**
     * @var decimal $quantity
     *
     * @ORM\Column(name="quantity", type="decimal", scale=2)
     */
    protected $quantity;

    /**
     * @var decimal $sale_price
     *
     * @ORM\Column(name="sale_price", type="decimal", scale=2)
     */
    protected $sale_price;

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
     * Set quantity
     *
     * @param float $quantity
     * @return SaleTimePrice
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
     * Set sale_price
     *
     * @param float $salePrice
     * @return SaleTimePrice
     */
    public function setSalePrice($salePrice)
    {
        $this->sale_price = $salePrice;
    
        return $this;
    }

    /**
     * Get sale_price
     *
     * @return float 
     */
    public function getSalePrice()
    {
        return $this->sale_price;
    }

    /**
     * Set local_price
     *
     * @param float $localPrice
     * @return SaleTimePrice
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
     * @return SaleTimePrice
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
     * @return SaleTimePrice
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
     * @return SaleTimePrice
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
     * @return SaleTimePrice
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
     * @return SaleTimePrice
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
     * Set product
     *
     * @param Common\DataBundle\Entity\Product $product
     * @return SaleTimePrice
     */
    public function setProduct(\Common\DataBundle\Entity\Product $product = null)
    {
        $this->product = $product;
    
        return $this;
    }

    /**
     * Get product
     *
     * @return Common\DataBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set customer
     *
     * @param Common\DataBundle\Entity\Customer $customer
     * @return SaleTimePrice
     */
    public function setCustomer(\Common\DataBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;
    
        return $this;
    }

    /**
     * Get customer
     *
     * @return Common\DataBundle\Entity\Customer 
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}