<?php
// src/Common/DataBundle/Entity/Customer.php
namespace Common\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="customer")
 * @ORM\Entity()
 */
class Customer
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    protected $name;

    /**
     * @var string $address
     *
     * @ORM\Column(name="address", type="string", length=200)
     */
    protected $address;

    /**
     * @var string $telephone
     *
     * @ORM\Column(name="telephone", type="string", length=100)
     */
    protected $telephone;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=100)
     */
    protected $email;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @var SaleTimePrice $sale_time_prices
     *
     * @ORM\OneToMany(targetEntity="SaleTimePrice", mappedBy="product")
     */
    protected $sale_time_prices;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sale_time_prices = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Customer
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
     * @return Customer
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
     * Set telephone
     *
     * @param string $telephone
     * @return Customer
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    
        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Customer
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
     * Add sale_time_prices
     *
     * @param Common\DataBundle\Entity\SaleTimePrice $saleTimePrices
     * @return Customer
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