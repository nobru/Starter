<?php

namespace Starter\BillingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice
 *
 * @ORM\Table(name="invoice")
 * @ORM\Entity
 */
class Invoice
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pay_date", type="date", nullable=true)
     */
    private $payDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="paid_at", type="date", nullable=true)
     */
    private $paidAt;

    /**
     * @var InvoiceStatus
     *
     * @ORM\ManyToOne(targetEntity="InvoiceStatus")
     * @ORM\JoinColumn(name="status", referencedColumnName="id", nullable=false)
     */
    private $status;

    /**
     * @var Billing
     *
     * @ORM\ManyToOne(targetEntity="Billing", inversedBy="invoices")
     * @ORM\JoinColumn(name="billing", referencedColumnName="id", nullable=false)
     */
    private $billing;

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
     * Set description
     *
     * @param string $description
     * @return Invoice
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
     * Set price
     *
     * @param float $price
     * @return Billing
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set payday
     *
     * @param \DateTime $payday
     * @return Invoice
     */
    public function setPayday($payday)
    {
        $this->payday = $payday;
    
        return $this;
    }

    /**
     * Get payday
     *
     * @return \DateTime 
     */
    public function getPayday()
    {
        return $this->payday;
    }

    /**
     * Set status
     *
     * @param \Starter\BillingBundle\Entity\InvoiceStatus $status
     * @return Invoice
     */
    public function setStatus(\Starter\BillingBundle\Entity\InvoiceStatus $status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return \Starter\BillingBundle\Entity\InvoiceStatus 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set billing
     *
     * @param \Starter\BillingBundle\Entity\Billing $billing
     * @return Invoice
     */
    public function setBilling(\Starter\BillingBundle\Entity\Billing $billing)
    {
        $this->billing = $billing;
    
        return $this;
    }

    /**
     * Get billing
     *
     * @return \Starter\BillingBundle\Entity\Billing 
     */
    public function getBilling()
    {
        return $this->billing;
    }

    /**
     * Set payDate
     *
     * @param \DateTime $payDate
     * @return Invoice
     */
    public function setPayDate($payDate)
    {
        $this->payDate = $payDate;
    
        return $this;
    }

    /**
     * Get payDate
     *
     * @return \DateTime 
     */
    public function getPayDate()
    {
        return $this->payDate;
    }

    /**
     * Set paidAt
     *
     * @param \DateTime $paidAt
     * @return Invoice
     */
    public function setPaidAt($paidAt)
    {
        $this->paidAt = $paidAt;
    
        return $this;
    }

    /**
     * Get paidAt
     *
     * @return \DateTime 
     */
    public function getPaidAt()
    {
        return $this->paidAt;
    }
}