<?php

namespace Starter\BillingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Billing
 *
 * @ORM\Table(name="billing")
 * @ORM\Entity
 */
class Billing
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
     * @var BillingStatus
     *
     * @ORM\ManyToOne(targetEntity="BillingStatus")
     * @ORM\JoinColumn(name="status", referencedColumnName="id", nullable=true)
     */
    private $status;

    /**
     * @var float
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var Account
     * 
     * @ORM\ManyToOne(targetEntity="Starter\UserBundle\Entity\Account", inversedBy="billings")
     * @ORM\JoinColumn(name="account", referencedColumnName="id", nullable=false)
     */
    private $account;

    /**
     * @var Plan
     * 
     * @ORM\ManyToOne(targetEntity="Starter\PlanBundle\Entity\Plan")
     * @ORM\JoinColumn(name="plan", referencedColumnName="id", nullable=false)
     */
    private $plan;

    /**
     * @var Period
     *
     * @ORM\ManyToOne(targetEntity="Starter\PlanBundle\Entity\Period")
     * @ORM\JoinColumn(name="period", referencedColumnName="id", nullable=false)
     */
    private $period;

    /**
     * @ORM\OneToMany(targetEntity="Invoice", mappedBy="billing", cascade={"persist", "remove"})
     */
    private $invoices;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->invoices = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->getAccount()->getOwner()->getName();
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
     * Set status
     *
     * @param \Starter\BillingBundle\Entity\BillingStatus $status
     * @return Billing
     */
    public function setStatus(\Starter\BillingBundle\Entity\BillingStatus $status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return \Starter\BillingBundle\Entity\BillingStatus 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Billing
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set account
     *
     * @param \Starter\UserBundle\Entity\Account $account
     * @return Billing
     */
    public function setAccount(\Starter\UserBundle\Entity\Account $account)
    {
        $this->account = $account;
    
        return $this;
    }

    /**
     * Get account
     *
     * @return \Starter\UserBundle\Entity\Account 
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set plan
     *
     * @param \Starter\PlanBundle\Entity\Plan $plan
     * @return Billing
     */
    public function setPlan(\Starter\PlanBundle\Entity\Plan $plan)
    {
        $this->plan = $plan;
    
        return $this;
    }

    /**
     * Get plan
     *
     * @return \Starter\PlanBundle\Entity\Plan 
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * Set period
     *
     * @param \Starter\PlanBundle\Entity\Period $period
     * @return Billing
     */
    public function setPeriod(\Starter\PlanBundle\Entity\Period $period)
    {
        $this->period = $period;
    
        return $this;
    }

    /**
     * Get period
     *
     * @return \Starter\PlanBundle\Entity\Period 
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Add invoices
     *
     * @param \Starter\BillingBundle\Entity\Invoice $invoices
     * @return Billing
     */
    public function addInvoice(\Starter\BillingBundle\Entity\Invoice $invoices)
    {
        $this->invoices[] = $invoices;
    
        return $this;
    }

    /**
     * Remove invoices
     *
     * @param \Starter\BillingBundle\Entity\Invoice $invoices
     */
    public function removeInvoice(\Starter\BillingBundle\Entity\Invoice $invoices)
    {
        $this->invoices->removeElement($invoices);
    }

    /**
     * Get invoices
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvoices()
    {
        return $this->invoices;
    }
}