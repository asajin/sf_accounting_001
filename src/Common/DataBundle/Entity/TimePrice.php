<?php
// src/Common/DataBundle/Entity/Product.php
namespace Common\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Common\DataBundle\Entity\Product;
use Common\DataBundle\Entity\Supplier;

/**
 * @ORM\Table(name="time_price")
 * @ORM\Entity()
 */
class TimePrice
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
     * @ORM\ManyToOne(targetEntity="Supplier", inversedBy="time_prices")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id", onDelete="set null")
     */
    protected $supplier;

    /**
     * @var Common\DataBundle\Entity\Product $product
     *
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="time_prices")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="set null")
     */
    protected $product;

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
     * @var decimal $stock
     *
     * @ORM\Column(name="stock", type="decimal", scale=2)
     */
    protected $stock;


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
     * @return TimePrice
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
     * @return TimePrice
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
     * @return TimePrice
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
     * Set stock
     *
     * @param float $stock
     * @return TimePrice
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    
        return $this;
    }

    /**
     * Get stock
     *
     * @return float 
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set price_date
     *
     * @param \DateTime $priceDate
     * @return TimePrice
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
     * @return TimePrice
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
     * @return TimePrice
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
     * Set supplier
     *
     * @param Common\DataBundle\Entity\Supplier $supplier
     * @return TimePrice
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
     * Set product
     *
     * @param Common\DataBundle\Entity\Product $product
     * @return TimePrice
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
     * Set sale_price
     *
     * @param float $salePrice
     * @return TimePrice
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
}