<?php

namespace Starter\BillingBundle\Service;

use Doctrine\ORM\EntityManager;
use Starter\UserBundle\Entity\Account;
use Starter\PlanBundle\Entity\Plan;
use Starter\PlanBundle\Entity\Period;
use Starter\BillingBundle\Entity\Billing as EntityBilling;
use Starter\BillingBundle\Entity\BillingStatus;
use DateTime;
use InvalidArgumentException;

class Billing
{
    private $em;
    private $encoder;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function create(Account $account)
    {
        $em = $this->em;
        $billing = $em->getRepository('StarterBillingBundle:Billing')->findOneBy(['account' => $account]);

        if (!$billing) {
            $billing = new EntityBilling;
        }

        $price = $em->getRepository('StarterPlanBundle:Price')->findOneBy(['isDefault' => 1]);
        $billingStatus = $em->getRepository('StarterBillingBundle:BillingStatus')->findOneBy(['name' => 'New']);

        $billing
            ->setStatus($billingStatus)
            ->setAccount($account)
            ->setPlan($price->getPlan())
            ->setPeriod($price->setPeriod())
            ->setCreatedat(new DateTime);

    }
}
