<?php
namespace Common\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="monthly_time_price")
 * @ORM\Entity()
 */
class MonthlyTimePrice
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
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="monthly_time_price")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="set null")
     */
    protected $product;

    /**
     * @var decimal $supply_quantity
     *
     * @ORM\Column(name="supply_quantity", type="decimal", scale=2)
     */
    protected $supply_quantity;

    /**
     * @var decimal $supply_amount
     *
     * @ORM\Column(name="supply_amount", type="decimal", scale=2)
     */
    protected $supply_amount;

    /**
     * @var decimal $sale_quantity
     *
     * @ORM\Column(name="sale_quantity", type="decimal", scale=2)
     */
    protected $sale_quantity;

    /**
     * @var decimal $sale_amount
     *
     * @ORM\Column(name="sale_amount", type="decimal", scale=2)
     */
    protected $sale_amount;

    /**
     * @var decimal $stock
     *
     * @ORM\Column(name="stock", type="decimal", scale=2)
     */
    protected $stock;

    /**
     * @var decimal $amount
     *
     * @ORM\Column(name="amount", type="decimal", scale=2)
     */
    protected $amount;

    /**
     * @var string $amount_date
     *
     * @ORM\Column(name="amount_date", type="datetime")
     */
    protected $amount_date;

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
     * Set supply_quantity
     *
     * @param float $supplyQuantity
     * @return MonthlyTimePrice
     */
    public function setSupplyQuantity($supplyQuantity)
    {
        $this->supply_quantity = $supplyQuantity;
    
        return $this;
    }

    /**
     * Get supply_quantity
     *
     * @return float 
     */
    public function getSupplyQuantity()
    {
        return $this->supply_quantity;
    }

    /**
     * Set supply_amount
     *
     * @param float $supplyAmount
     * @return MonthlyTimePrice
     */
    public function setSupplyAmount($supplyAmount)
    {
        $this->supply_amount = $supplyAmount;
    
        return $this;
    }

    /**
     * Get supply_amount
     *
     * @return float 
     */
    public function getSupplyAmount()
    {
        return $this->supply_amount;
    }

    /**
     * Set sale_quantity
     *
     * @param float $saleQuantity
     * @return MonthlyTimePrice
     */
    public function setSaleQuantity($saleQuantity)
    {
        $this->sale_quantity = $saleQuantity;
    
        return $this;
    }

    /**
     * Get sale_quantity
     *
     * @return float 
     */
    public function getSaleQuantity()
    {
        return $this->sale_quantity;
    }

    /**
     * Set sale_amount
     *
     * @param float $saleAmount
     * @return MonthlyTimePrice
     */
    public function setSaleAmount($saleAmount)
    {
        $this->sale_amount = $saleAmount;
    
        return $this;
    }

    /**
     * Get sale_amount
     *
     * @return float 
     */
    public function getSaleAmount()
    {
        return $this->sale_amount;
    }

    /**
     * Set stock
     *
     * @param float $stock
     * @return MonthlyTimePrice
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
     * Set amount
     *
     * @param float $amount
     * @return MonthlyTimePrice
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    
        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set amount_date
     *
     * @param \DateTime $amountDate
     * @return MonthlyTimePrice
     */
    public function setAmountDate($amountDate)
    {
        $this->amount_date = $amountDate;
    
        return $this;
    }

    /**
     * Get amount_date
     *
     * @return \DateTime 
     */
    public function getAmountDate()
    {
        return $this->amount_date;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return MonthlyTimePrice
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
     * @return MonthlyTimePrice
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
     * @return MonthlyTimePrice
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
}