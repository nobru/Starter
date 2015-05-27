<?php

namespace Starter\PlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Price
 *
 * @ORM\Table(name="price")
 * @ORM\Entity
 */
class Price
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
     * @var Plan
     *
     * @ORM\ManyToOne(targetEntity="Plan", inversedBy="prices")
     * @ORM\JoinColumn(name="plan", referencedColumnName="id", nullable=false)
     */
    private $plan;

    /**
     * @var Period
     *
     * @ORM\ManyToOne(targetEntity="Period")
     * @ORM\JoinColumn(name="period", referencedColumnName="id", nullable=false)
     */
    private $period;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_default", type="boolean")
     */
    private $isDefault;

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
     * Set price
     *
     * @param float $price
     * @return Price
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
     * Set plan
     *
     * @param \Starter\PlanBundle\Entity\Plan $plan
     * @return Price
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
     * @return Price
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
     * Set isDefault
     *
     * @param boolean $isDefault
     * @return Price
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    /**
     * Get isDefault
     *
     * @return boolean
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }
}