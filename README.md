Starter admin for Symfony2
==========================

Starter is a set of Symfony Bundles that helps you to easily 
create simple SaaS administration.


Installation
------------

1) Add the dependencie on composer.json file:

```
    "require": {
        "nobru/starter": "dev-master"
    }

```


2) Add the Starter bundles on app/AppKernel.php:

```php

    public function registerBundles()
    {
        $bundles = array(

            ...

            new Starter\DashboardBundle\StarterDashboardBundle(),
            new Starter\BaseBundle\StarterBaseBundle(),
            new Starter\BillingBundle\StarterBillingBundle(),
            new Starter\PlanBundle\StarterPlanBundle(),
            new Starter\UserBundle\StarterUserBundle(),
        );

        ...
    }

```

3) Add the starter route on app/config/routing.yml

```
main:
    resource: "@StarterDashboardBundle/Resources/config/routing.yml"
    prefix: /starter
```


4) Add the StarterBaseBundle to the asstic config on app/config.yml 

```
assetic:
    debug:          "%kernel.debug%"
    use_controller: false
    bundles:        ["StarterBaseBundle"]
 
```