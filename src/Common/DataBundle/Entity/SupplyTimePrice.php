<?php
// src/Common/DataBundle/Entity/Product.php
namespace Common\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Common\DataBundle\Entity\Product;
use Common\DataBundle\Entity\Supplier;
use Common\DataBundle\Entity\BaseTimePrice2;

/**
 * @ORM\Table(name="supply_time_price")
 * @ORM\Entity()
 */
class SupplyTimePrice extends BaseTimePrice2
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
     * @var decimal $supply_price
     *
     * @ORM\Column(name="supply_price", type="decimal", scale=2)
     */
    protected $supply_price;

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
     * Set supply_price
     *
     * @param float $supplyPrice
     * @return TimePrice
     */
    public function setSupplyPrice($supplyPrice)
    {
        $this->supply_price = $supplyPrice;
    
        return $this;
    }

    /**
     * Get supply_price
     *
     * @return float 
     */
    public function getSupplyPrice()
    {
        return $this->supply_price;
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
}