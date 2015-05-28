<?php

namespace Starter\BaseBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class StarterBaseBundle extends Bundle
{
    public function registerDependencies()
    {
        return array(
            new Starter\BillingBundle\StarterBillingBundle(),
            new Starter\PlanBundle\StarterPlanBundle(),
            new Starter\UserBundle\StarterUserBundle()
        );
    }
}
